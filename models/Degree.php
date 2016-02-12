<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "degree".
 *
 * @property integer $id
 * @property integer $faculty_id
 * @property integer $campus_id
 * @property string $name
 *
 * @property Faculty $faculty
 * @property StudentProfile[] $studentProfiles
 */
class Degree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'degree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'faculty_id', 'campus_id', 'name'], 'required'],
            [['id', 'faculty_id', 'campus_id'], 'integer'],
            [['name'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faculty_id' => 'Faculty ID',
            'campus_id' => 'Campus ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty()
    {
        return $this->hasOne(Faculty::className(), ['id' => 'faculty_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentProfiles()
    {
        return $this->hasMany(StudentProfile::className(), ['degree_id' => 'id']);
    }
}
