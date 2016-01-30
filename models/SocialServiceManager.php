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
            [['id', 'user_id', 'faculty_id'], 'required'],
            [['id', 'user_id', 'faculty_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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
