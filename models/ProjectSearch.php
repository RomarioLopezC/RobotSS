<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ammount'], 'integer'],
            [['name', 'dependency', 'objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestrcture', 'approved'], 'safe'],
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
        $query = Project::find();

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
            'ammount' => $this->ammount,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'dependency', $this->dependency])
            ->andFilterWhere(['like', 'objective', $this->objective])
            ->andFilterWhere(['like', 'goals', $this->goals])
            ->andFilterWhere(['like', 'actions_by_students', $this->actions_by_students])
            ->andFilterWhere(['like', 'induction', $this->induction])
            ->andFilterWhere(['like', 'materials_for_students', $this->materials_for_students])
            ->andFilterWhere(['like', 'economic_support', $this->economic_support])
            ->andFilterWhere(['like', 'human_resource', $this->human_resource])
            ->andFilterWhere(['like', 'infraestrcture', $this->infraestrcture])
            ->andFilterWhere(['like', 'approved', $this->approved]);

        return $dataProvider;
    }
}
