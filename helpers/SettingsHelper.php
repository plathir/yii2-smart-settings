<?php

namespace plathir\settings\helpers;

use plathir\settings\backend\models\Settings;
use yii\base\View;

class SettingsHelper {

    public function getHtmlforFormField($model) {

//            'string' => 'string',
//            'integer' => 'integer',
//            'boolean' => 'boolean',
//            'float' => 'float',
//            'array' => 'array',
//            'object' => 'object',
//            'null' => 'null'

        switch ($model->type) {
            case 'string':
                return 'echo $form->field($model, "[$i]value")->textInput(["maxlength" => true])->label($model->key_name);';
            case 'integer';
                return '';
            case  'boolean';
                return 'echo $form->field($model, "[$i]value")->checkbox(["value" => 1,"label"=> ""])->label($model->key_name . "&nbsp");';
            case 'float';
                return '';
            case 'array';
                return '';
            case 'object';
                return '';
            case 'null';
                return '';
            default:
                break;
        }
    }

}
