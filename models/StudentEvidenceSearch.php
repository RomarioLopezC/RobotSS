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
    public $student_asign;
    public $evidence_accepted_date;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['task_id', 'project_id', 'evidence_id', 'student_id'], 'integer'],
            [['task_name', 'task_delivery_date', 'evidence_updated_at', 'evidence_accepted_date', 'student_asign'], 'safe'],
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

        $query->joinWith(['evidence', 'task', 'student']);

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
            'student.user_id' => Yii::$app->user->id,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
            'evidence.updated_at' => $this->evidence_updated_at,
        ]);

        return $dataProvider;
    }

    public function searchPending($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'student']);

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
            'student.user_id' => Yii::$app->user->id,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }

    public function searchAccepted($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'student']);

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
            'student.user_id' => Yii::$app->user->id,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }

    public function searchNewsByProjectManager($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'project', 'student']);

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
            'project.manager_id' => 2,
            'evidence.status' => Evidence::$NEW,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
            'evidence.updated_at' => $this->evidence_updated_at,
        ]);

        return $dataProvider;
    }

    public function searchPendingByProjectManager($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'project', 'student']);

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
            'project.manager_id' => 2,
            'evidence.status' => Evidence::$PENDING,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }

    public function searchAcceptedByProjectManager($params) {
        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'project', 'student']);

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
            'project.manager_id' => 2,
            'evidence.status' => Evidence::$ACCEPTED,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ]);

        return $dataProvider;
    }


}