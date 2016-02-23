<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_profile".
 *
 * @property integer $project_id
 * @property integer $degree_id
 *
 * @property Project $project
 * @property Degree $degree
 */
class StudentProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'degree_id'], 'required'],
            [['project_id', 'degree_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'degree_id' => 'Degree ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegree()
    {
        return $this->hasOne(Degree::className(), ['id' => 'degree_id']);
    }
}
