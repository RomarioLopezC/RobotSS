<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "registration".
 *
 * @property integer $project_id
 * @property integer $student_id
 * @property string $student_status
 */
class Registration extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'registration';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'student_id', 'student_status'], 'required'],
            [['project_id', 'student_id'], 'integer'],
            [['student_status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'student_id' => 'Student ID',
            'student_status' => 'Student Status',
        ];
    }
}
