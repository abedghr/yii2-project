<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsedVehicles;

/**
 * UsedVehiclesSearch represents the model behind the search form of `common\models\UsedVehicles`.
 */
class UsedVehiclesSearch extends UsedVehicles
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'v_id', 'v_city', 'v_mileage'], 'integer'],
            [['v_year'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = UsedVehicles::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'v_id' => $this->v_id,
            'v_city' => $this->v_city,
            'v_mileage' => $this->v_mileage,
        ]);

        $query->andFilterWhere(['like', 'v_year', $this->v_year]);

        return $dataProvider;
    }
}
