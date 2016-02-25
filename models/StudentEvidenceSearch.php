<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentEvidence;

/**
 * StudentEvidenceSearch represents the model behind the search form about `app\models\StudentEvidence`.
 */
class StudentEvidenceSearch extends StudentEvidence {
    public $task_name;
    public $task_delivery_date;
    public $evidence_updated_at;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['task_id', 'project_id', 'evidence_id', 'student_id'], 'integer'],
            [['task_name', 'task_delivery_date', 'evidence_updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function searchNews($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task']);

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
            'evidence.status' => Evidence::$NEW,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
            'evidence.updated_at' => $this->evidence_updated_at,
        ]);

        return $dataProvider;
    }

    public function searchPending($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task']);

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
            'evidence.status' => Evidence::$PENDING,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }

    public function searchAccepted($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task']);

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
            'evidence.status' => Evidence::$ACCEPTED,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }
}
