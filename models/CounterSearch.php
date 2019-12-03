<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Counter;

/**
 * CounterSearch represents the model behind the search form of `app\models\Counter`.
 */
class CounterSearch extends Counter
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['num'], 'safe'],
            [['typeN'], 'safe'],
            [['adress'], 'safe'],
            [['addrName'], 'safe'],
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
//        print_r($params);
//        print_r($params->num);
//        print_r($params["CounterSearch"]["num"]);
//        die();
        $query = Counter::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->sort->attributes['typeN'] = [
            'asc' => ['counters.type' => SORT_ASC],
            'desc' => ['counters.type' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['addrName'] = [
            'asc' => ['addrs.address' => SORT_ASC],
            'desc' => ['addrs.address' => SORT_DESC],
        ];

//        $this->load($params);
        $this->num = $params["CounterSearch"]["num"];
        $this->type = $params["CounterSearch"]["typeN"];
        $this->addrName = $params["CounterSearch"]["addrName"];

        if (!$this->validate()) {
            return $dataProvider;
        }
        $query->innerJoin('addrs', 'addrs.id = counters.addrid' );
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'counters.num', $this->num]);

        if (isset($params["CounterSearch"]["addrName"]))
            $query->andFilterWhere(['like', 'addrs.address', $params["CounterSearch"]["addrName"]]);

        return $dataProvider;
    }
}
