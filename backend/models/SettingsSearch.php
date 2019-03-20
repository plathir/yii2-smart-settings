<?php

namespace plathir\settings\backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use plathir\settings\backend\models\Settings;

/**
 * SettingsSearch represents the model behind the search form about `app\models\Settings`.
 * 
 *  @property \plathir\settings\Module $module
 */
class SettingsSearch extends Settings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'active', 'created_at', 'updated_at'], 'integer'],
            [['module_name', 'key_name', 'description', 'value', 'type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Settings::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'active' => $this->active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'module_name', $this->module_name])
            ->andFilterWhere(['like', 'key_name', $this->key_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
