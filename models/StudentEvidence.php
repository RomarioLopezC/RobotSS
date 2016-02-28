<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_evidence".
 *
 * @property integer $task_id
 * @property integer $project_id
 * @property integer $evidence_id
 * @property integer $student_id
 *
 * @property Evidence $evidence
 * @property Project $project
 * @property Student $student
 * @property Task $task
 */
class StudentEvidence extends \yii\db\ActiveRecord {

    public static $NEW = 'Nuevo';
    public static $PENDING = 'Pendiente';
    public static $ACCEPTED = 'Aceptado';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'student_evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['task_id', 'project_id', 'evidence_id', 'student_id'], 'required'],
            [['task_id', 'project_id', 'evidence_id', 'student_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'task_id' => 'ID de tarea',
            'project_id' => 'ID de proyecto',
            'evidence_id' => 'ID de evidencia',
            'student_id' => 'ID de alumno',
            'task_name' => 'Nombre',
            'task_description' => 'Descripción',
            'task_delivery_date' => 'Fecha límite de entrega',
            'evidence_updated_at' => 'Fecha de última edición',
            'student_asign' => 'Alumno Asignado',
            'evidence_accepted_date' => 'Fecha de aceptación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvidence() {
        return $this->hasOne(Evidence::className(), ['id' => 'evidence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject() {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent() {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask() {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
