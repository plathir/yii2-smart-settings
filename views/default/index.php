<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');

$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="settings-index">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    foreach ($models as $i => $model) {
          eval(plathir\settings\helpers\SettingsHelper::getHtmlforFormField($model));
      //  echo $form->field($model, "[$i]value")->textInput(['maxlength' => true])->label($model->key_name);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
