<?php

namespace plathir\settings;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'plathir\settings\controllers';
    public $defaultRoute = 'default';
    public $modulename = '';

    public function init() {

        parent::init();
    }

}
