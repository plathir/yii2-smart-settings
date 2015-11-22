<?php

namespace plathir\settings\helpers;

use plathir\settings\models\Settings;
use yii\base\View;

class SettingsHelper {

    public function getHtmlforFormField($model) {
        
       return  '$form->field($model, "[$i]value")->textInput(["maxlength" => true])->label($model->key_name);';
    }

}
