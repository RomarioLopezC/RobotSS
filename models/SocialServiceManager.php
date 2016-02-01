<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "social_service_manager".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $faculty_id
 *
 * @property User $user
 * @property Faculty $faculty
 */
class SocialServiceManager extends \yii\db\ActiveRecord
{
    public $name;
    public $lastName;
    public $email;
    public $phone;
    public $username;
    public $password;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_service_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faculty_id','name','lastName','username','password','email'], 'required','message'=>'El campo {attribute} está vacío'],
            ['email', 'email','message'=>'El campo Correo electrónico es inválido'],
            [['id', 'user_id', 'faculty_id'], 'integer'],
            ['password', 'string', 'min' => 6,'message'=>'Contraseña debe tener al menos 6 caracteres']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Nombre',
            'lastName' => 'Apellido',
            'email' => 'Correo electrónico',
            'phone' => 'Teléfono',
            'password' => 'Contraseña',
            'username' => 'Nombre de Usuario',
            'id' => 'ID',
            'user_id' => 'User ID',
            'faculty_id' => 'Facultad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }
}
