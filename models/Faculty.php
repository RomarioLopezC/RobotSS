<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faculty".
 *
 * @property integer $id
 * @property integer $campus_id
 * @property string $code
 * @property string $name
 *
 * @property Degree[] $degrees
 * @property Campus $campus
 * @property SocialServiceManager[] $socialServiceManagers
 * @property Student[] $students
 */
class Faculty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faculty';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'campus_id', 'code', 'name'], 'required'],
            [['id', 'campus_id'], 'integer'],
            [['code'], 'string', 'max' => 10],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Facultad',
            'campus_id' => 'Campus',
            'code' => 'Code',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegrees()
    {
        return $this->hasMany(Degree::className(), ['faculty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampus()
    {
        return $this->hasOne(Campus::className(), ['id' => 'campus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialServiceManagers()
    {
        return $this->hasMany(SocialServiceManager::className(), ['faculty_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['faculty_id' => 'id']);
    }
}
