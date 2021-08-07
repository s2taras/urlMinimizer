<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * Class UrlRecordSearch
 * @package app\models
 */
class UrlRecordSearch extends UrlRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['counter',], 'number'],
            [['full_url', 'short_url',], 'string'],
            [['created_at', 'expired_at',], 'safe'],
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
        $query = UrlRecord::find();

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
            'counter'    => $this->counter,
            'created_at' => $this->created_at,
            'expired_at' => $this->expired_at,
        ]);

        $query->andFilterWhere(['like', 'full_url', $this->full_url])
            ->andFilterWhere(['like', 'short_url', $this->short_url]);

        return $dataProvider;
    }
}
