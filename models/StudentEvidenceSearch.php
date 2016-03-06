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
    /**
     * @var string
     */
    public $task_name;
    /**
     * @var string
     */
    public $task_delivery_date;
    /**
     * @var string
     */
    public $evidence_updated_at;
    /**
     * @var string
     */
    public $student_asign;
    /**
     * @var string
     */
    public $evidence_accepted_date;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['task_id', 'project_id', 'evidence_id', 'student_id'], 'integer'],
            [['status', 'task_name', 'task_delivery_date', 'evidence_updated_at', 'evidence_accepted_date', 'student_asign'], 'safe'],
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
    public function search($params, $studentEvidenceStatus, $student = true) {

        $dataArray = [
            'student_evidence.status' => $studentEvidenceStatus,
            'task.name' => $this->task_name,
            'task.delivery_data' => $this->task_delivery_date,
        ];

        if($student){
            $dataArray['student.user_id'] = Yii::$app->user->id;
        }else{
            $dataArray['project.manager_id'] = 2;
        }

        $query = StudentEvidence::find();

        $query->joinWith(['evidence', 'task', 'project', 'student']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere($dataArray);

        return $dataProvider;
    }


}
