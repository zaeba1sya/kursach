<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Purchases;
use Yii;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Purchases`.
 */
class ProfileSearch extends Purchases
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nftId', 'userId'], 'integer'],
            [['timestamp'], 'safe'],
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
        $query = Purchases::find()->where(["userId" => Yii::$app->user->id]);

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
            'nftId' => $this->nftId,
            'userId' => $this->userId,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}
