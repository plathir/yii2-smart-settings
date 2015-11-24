<?php

namespace plathir\settings\controllers;

use yii\web\Controller;
use plathir\settings\models\Settings;
use yii\base\Model;
use yii;

/**
 * @property \plathir\settings\Module $module
 *
 */
class DefaultController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
    }

    public function actionIndex() {

        $models = Settings::find()->where(['module_name' => $this->module->modulename])->all();
        if (Model::loadMultiple($models, Yii::$app->request->post()) &&
                Model::validateMultiple($models)) {
            $count = 0;
            foreach ($models as $model) {
                // populate and save records for each model
                if ($model->save()) {
                    // do something here after saving
                    $count++;
                }
            }
            Yii::$app->session->setFlash('success', "Processed {$count} records successfully.");
           return $this->redirect(['index']); // redirect to your next desired page
        } else {
            return $this->render('index', [
                        'module' => $this->module,
                        'models' => $models,
            ]);
        }
    }

    protected function findModel($id) {
        if (($model = Settings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
