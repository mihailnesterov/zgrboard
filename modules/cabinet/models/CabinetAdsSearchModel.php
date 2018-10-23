<?php

namespace app\modules\cabinet\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\cabinet\models\CabinetAds;

/**
 * CabinetAdsSearchModel represents the model behind the search form of `app\modules\cabinet\models\CabinetAds`.
 */
class CabinetAdsSearchModel extends CabinetAds
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id', 'vip', 'premium', 'visits'], 'integer'],
            [['title', 'text', 'price', 'photo1', 'photo2', 'photo3', 'photo4', 'type', 'date_begin', 'date_end', 'created'], 'safe'],
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
        // add conditions that should always apply here
        
        $query = CabinetAds::find();

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
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'vip' => $this->vip,
            'premium' => $this->premium,
            'created' => $this->created,
            'visits' => $this->visits,
        ]);
        
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            /*->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'photo1', $this->photo1])
            ->andFilterWhere(['like', 'photo2', $this->photo2])
            ->andFilterWhere(['like', 'photo3', $this->photo3])
            ->andFilterWhere(['like', 'photo4', $this->photo4])*/
            ->andFilterWhere(['like', 'type', $this->type]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            //->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}