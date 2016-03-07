<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property integer $project_id
 * @property integer $student_id
 * @property string $student_status
 * @property string $beginning_date
 * @property string $ending_date
 *
 * @property Project $project
 * @property Student $student
 */
class Registration extends \yii\db\ActiveRecord {
    const ASSIGNED = 'assigned';
    const UNASSIGNED = 'preregistered';
    const PREREGISTRATION_CANCELLED = 'cancelled';

    /**
     * @inheritdoc
     */
    public static function tableName () {
        return 'registration';
    }

    /**
     * @inheritdoc
     */
    public function rules () {
        return [
            [['project_id', 'student_id', 'student_status', 'begining_date', 'endind_date'], 'required'],
            [['project_id', 'student_id'], 'integer'],
            [['student_status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels () {
        return [
            'project_id' => 'Proyecto',
            'student_id' => 'Estudiante',
            'student_status' => 'Estatus',
            'beginning_date' => 'Fecha de inicio',
            'ending_date' => 'Fecha de término',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject () {
        return $this->hasOne(Project::className (), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent () {
        return $this->hasOne (Student::className (), ['id' => 'student_id']);
    }

    public function getStudentName () {
        return $this->student->user->person->name . ' ' . $this->student->user->person->lastname;
    }

    public function getProjectName () {
        return $this->project->name;
    }
}
