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
            // username and password are both required
            [['name', 'lastName', 'email', 'phone', 'password', 'organization'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
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