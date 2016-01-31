<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 30/01/2016
 * Time: 11:39 AM
 */

namespace app\models;


use yii\base\Model;

class ProjectManagerForm extends Model {

    public $name;
    public $lastName;
    public $email;
    public $phone;
    public $password;
    public $organization;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            ['name', 'required', 'message' => 'El campo Nombre está vacío'],
            ['lastName', 'required', 'message' => 'El campo Apellido está vacío'],
            ['email', 'required', 'message' => 'El campo Correo electrónico está vacío'],
            ['phone', 'required', 'message' => 'El campo Teléfono está vacío'],
            ['password', 'required', 'message' => 'El campo Contraseña está vacío'],
            ['organization', 'required', 'message' => 'El campo Organización está vacío'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'name' => 'Nombre',
            'lastName' => 'Apellido',
            'email' => 'Correo electrónico',
            'phone' => 'Teléfono',
            'password' => 'Contraseña',
            'organization' => 'Organización'
        ];
    }


}