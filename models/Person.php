<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property integer $id
 * @property string $name
 * @property string $lastname
 * @property string $phone
 *
 * @property User[] $users
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $email;
    public $faculty_id;

    public static function tableName()
    {
        return 'person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lastname', 'phone', 'email', 'faculty_id'], 'required'],
            ['email', 'email'],
            [['name', 'lastname', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'lastname' => 'Apellido',
            'phone' => 'Teléfono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['person_id' => 'id']);
    }
}
