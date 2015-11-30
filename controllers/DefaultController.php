<?php

namespace plathir\settings\controllers;

use yii\web\Controller;
use plathir\settings\models\Settings;
use plathir\settings\models\SettingsSearch;
use yii\base\Model;
use yii;
use yii\filters\VerbFilter;

/**
 * @property \plathir\settings\Module $module
 *
 */
class DefaultController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
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
