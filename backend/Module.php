<?php
namespace plathir\settings\backend;
use Yii;
use \common\helpers\ThemesHelper;


class Module extends \yii\base\Module {

    public $controllerNamespace = 'plathir\settings\backend\controllers';
    public $defaultRoute = 'default';
    public $modulename = '';
    public $Theme = 'smart';

    public function init() {
        parent::init();

       // $path = Yii::getAlias('@vendor') . '/plathir/yii2-smart-settings/backend/themes/' . $this->Theme . '/views';
        
        $helper = new ThemesHelper();
        $path = $helper->ModuleThemePath('settings', 'backend', dirname(__FILE__) . "/themes/$this->Theme");
        $path = $path . '/views';
        
        $this->setViewPath($path);
        $this->registerTranslations();
    }

    public function registerTranslations() {
        /*         * This registers translations for the widgets module * */
        Yii::$app->i18n->translations['settings'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en',
            'basePath' => Yii::getAlias('@vendor/plathir/yii2-smart-settings/messages'),
        ];
    }

}
