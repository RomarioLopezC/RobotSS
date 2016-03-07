<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SocialServiceManager;

/**
 * SocialServiceManagerSearch represents the model behind the search form about `app\models\SocialServiceManager`.
 */
class SocialServiceManagerSearch extends SocialServiceManager {
    /**
     * @inheritdoc
     */
    public function rules () {
        return [
            [['id', 'user_id', 'faculty_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios () {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios ();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search ($params) {
        $query = SocialServiceManager::find ();

        $dataProvider = new ActiveDataProvider ([
            'query' => $query,
        ]);

        $this->load ($params);

        if (!$this->validate ()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere ([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'faculty_id' => $this->faculty_id,
        ]);

        return $dataProvider;
    }
}
