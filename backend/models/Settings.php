<?php

namespace plathir\settings\backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $module_name
 * @property string $key_name
 * @property string $description
 * @property string $value
 * @property string $type
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 *  @property \plathir\settings\Module $module
 */
class Settings extends \yii\db\ActiveRecord {
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           // [['module_name', 'key_name', 'description', 'value', 'type', 'active'], 'required'],
            [['value'], 'string'],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['module_name', 'key_name', 'description', 'type'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('settings', 'ID'),
            'module_name' => Yii::t('settings', 'Module Name'),
            'key_name' => Yii::t('settings', 'Key Name'),
            'description' => Yii::t('settings', 'Description'),
            'value' => Yii::t('settings', 'Value'),
            'type' => Yii::t('settings', 'Type'),
            'active' => Yii::t('settings', 'Active'),
            'created_at' => Yii::t('settings', 'Created At'),
            'updated_at' => Yii::t('settings', 'Updated At'),
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            return true;
        } else {
            return false;
        }
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

}
