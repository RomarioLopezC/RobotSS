<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $faculty_id
 * @property integer $current_semester
 * @property string $enrollment_id
 * @property integer $degree_id
 *
 * @property User $user
 * @property Faculty $faculty
 */
class Student extends \yii\db\ActiveRecord{
    /**
     * @inheritdoc
     */
    public static function tableName () {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules () {
        return [
            [['faculty_id', 'current_semester', 'enrollment_id'], 'required'],
            [['id', 'user_id', 'faculty_id', 'current_semester', 'degree_id'], 'integer'],
            [['enrollment_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels () {
        return [
            'id' => Yii::t ('app', 'ID'),
            'user_id' => Yii::t ('app', 'User ID'),
            'faculty_id' => Yii::t ('app', 'Faculty ID'),
            'current_semester' => Yii::t ('app', 'Current Semester'),
            'enrollment_id' => Yii::t ('app', 'Enrollment ID'),
            'degree_id' => Yii::t ('app', 'Degree ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser () {
        return $this->hasOne (User::className (), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaculty () {
        return $this->hasOne (Faculty::className (), ['id' => 'faculty_id']);
    }

    public function getDegree () {
        return $this->hasOne (Degree::className (), ['id' => 'degree_id']);
    }

    public function afterSave ($insert, $changedAttributes) {
        if ($insert) {
            //assign the role to the user
            $authManager = Yii::$app->getAuthManager ();
            $socialServiceMRole = $authManager->getRole ('student');
            $authManager->assign ($socialServiceMRole, $this->user_id);
        }
        parent::afterSave ($insert, $changedAttributes);
    }
}
