<?php

namespace plathir\settings\backend\controllers;

use Yii;
use plathir\settings\backend\models\Settings;
use plathir\settings\backend\models\SettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * AdminController implements the CRUD actions for Settings model.
 *  @property \plathir\settings\backend\Module $module
 */
class AdminController extends Controller {

    public function __construct($id, $module) {
        parent::__construct($id, $module);
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Settings models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new SettingsSearch(['module_name'=> $this->module->modulename]);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'module' => $this->module
        ]);
    }

    /**
     * Displays a single Settings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Settings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Settings();
        $model->module_name = $this->module->modulename;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Settings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->module_name = $this->module->modulename;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Settings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        //find()->where(['module_name' => $this->module->modulename])->all()
        if (($model = Settings::find()->where(['id'=>$id,'module_name' => $this->module->modulename])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
