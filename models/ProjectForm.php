<?php
/**
 * Created by PhpStorm.
 * User: Carlos
 * Date: 11/02/2016
 * Time: 08:22 PM
 */


namespace app\models;


use yii\base\Model;

class ProjectForm extends Model {

    public $name;
    public $dependency;
    public $objective;
    public $goals;
    public $actions_by_students;
    public $induction;
    public $materials_for_students;
    public $economic_support;
    public $human_resource;
    public $infraestrcture;
    public $ammount;
    public $approved;
    public $profiles;


    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['name', 'dependency', 'objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestrcture', 'ammount', 'approved'], 'required'],
            [['ammount'], 'integer'],
            [['name', 'dependency'], 'string', 'max' => 200],
            [['objective', 'goals', 'actions_by_students', 'induction', 'materials_for_students', 'economic_support', 'human_resource', 'infraestrcture', 'approved'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre del proyecto',
            'studentProfiles' => 'Perfiles solicitados',
            'dependency' => 'Dependencia solicitante',
            'objective' => 'Objetivos del proyecto',
            'goals' => 'Metas del proyecto',
            'actions_by_students' => 'Acciones a realizar por los prestadores',
            'induction' => 'Inducción',
            'materials_for_students' => 'Recursos materiales',
            'economic_support' => 'Recursos economicos',
            'human_resource' => 'Recursos humanos',
            'infraestrcture' => 'Infraestrctura',
            'ammount' => 'Monto',
            'approved' => 'Approved',
        ];
    }

}