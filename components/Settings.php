<?php

namespace plathir\settings\components;

use yii\base\Component;
use Yii;
use yii\base\InvalidParamException;
use plathir\settings\models\Settings as SettingsHelper;
use yii\caching\Cache;

/**
 *  @property \plathir\settings\Module $module
 */
class Settings extends Component {

    public $modelClass = 'plathir\settings\models\Setting';
    protected $model;
    public $cacheKey = 'plathir/settings';
    public $modulename = '';
    public $cache = 'cache';
    public $frontCache;

    public function init() {
        parent::init();

        if ($this->modulename == null) {
            throw new InvalidParamException('modulename parameter for plathir\settings\components cannot set.');
        }

    }

    public function test() {
        return 'Hello !! i am test function from component settings for module <b> ' . $this->modulename . ' </b>';
    }

    public function getSettings($key) {
        $setting = SettingsHelper::find()->where(['module_name' => $this->modulename, 'key_name' => $key])->one();
        if ($setting == null) {
            throw new InvalidParamException('Setting key with value ' . $key . ' cannot exist !');
        }

        return $setting->value;
    }

    public function setSettings($key, $value) {
       $setting = SettingsHelper::find()->where(['module_name' => $this->modulename, 'key_name' => $key])->one();
       $setting->value = $value; 
       if ($setting->validate() && $setting->save()) {
           return true;
           
       } else {
           return false;
       }
       
    }

    public function getAllSettings() {
        $settings = SettingsHelper::find()->where(['module_name' => $this->modulename])->all();
        $settingsOut = null;
        foreach ($settings as $setting) {
            $settingsOut[] = ['key' => $setting->key_name, 'value' => $setting->value];
        }
        return $settingsOut;
    }

}
