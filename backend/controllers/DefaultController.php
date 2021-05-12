<?php

namespace plathir\settings\backend\controllers;

use yii\web\Controller;
use plathir\settings\backend\models\Settings;
use plathir\settings\backend\models\SettingsSearch;
use yii\base\Model;
use yii;
use yii\filters\VerbFilter;

/**
 * @property \plathir\settings\backend\Module $module
 *
 */
class DefaultController extends Controller {

    public $permissionName;

    public function __construct($id, $module) {
        parent::__construct($id, $module);
        $helper = new \plathir\settings\helpers\SettingsHelper();
        $this->permissionName = $helper->getSettingsPermissionName($this->module->modulename);
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                // 'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        
        if (\yii::$app->user->can($this->permissionName)) {
            $models = Settings::find()->where(['module_name' => $this->module->modulename])->all();
            if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {

                $count = 0;
                foreach ($models as $model) {
                    // populate and save records for each model
                    if ($model->save()) {
                        // do something here after saving
                        $count++;
                    }
                }
                Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
                return $this->goHome();
            } else {
                return $this->render('index', [
                            'module' => $this->module,
                            'models' => $models,
                ]);
            }
        } else {
            throw new \yii\web\NotAcceptableHttpException(Yii::t('settings', 'No Permission to View Settings '.$this->permissionName));
        }
    }

    public function actionMessage() {
        
    }

    protected function findModel($id) {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
