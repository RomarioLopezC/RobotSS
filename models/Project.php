<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $id
 * @property string $name
 * @property string $dependency
 * @property string $objective
 * @property string $goals
 * @property string $actions_by_students
 * @property string $induction
 * @property string $materials_for_students
 * @property string $economic_support
 * @property string $human_resource
 * @property string $infraestructure
 * @property string $ammount
 * @property string $approved
 * @property integer $manager_id
 */
class Project extends \yii\db\ActiveRecord {
    public $vacancy;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'dependency', 'objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestructure', 'ammount', 'manager_id', 'vacancy', 'degrees'], 'required'],
            [['manager_id', 'vacancy', 'ammount'], 'integer'],
            [['name', 'dependency'], 'string', 'max' => 200],
            [['objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestructure', 'ammount', 'approved'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre del proyecto',

            'dependency' => 'Dependencia solicitante',
            'objective' => 'Objetivos del proyecto',
            'goals' => 'Metas del proyecto',
            'actions_by_students' => 'Acciones a realizar por los prestadores',
            'induction' => 'Inducción',
            'materials_for_students' => 'Recursos materiales',
            'economic_support' => 'Recursos economicos',
            'human_resource' => 'Recursos humanos',
            'infraestructure' => 'Infraestrctura',
            'ammount' => 'Monto',
            'approved' => 'Approved',
            'degrees' => 'Perfiles solicitados',
            'vacancy' => 'Cupo disponible',
        ];
    }

    public function getDegrees() {
        return $this->hasMany(Degree::className(), ['id' => 'degree_id'])
            ->viaTable('student_profile', ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectManager()
    {
        return $this->hasOne(ProjectManager::className(), ['id' => 'manager_id']);
    }

    public function getStudentProfiles() {
        $profiles = '| ';
        foreach($this->degrees as $degree){
            $profiles .= $degree->name ." | ";
        }
        return $profiles;
    }
}
