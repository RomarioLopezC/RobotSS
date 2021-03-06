<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property string $role
 * @property string $created_at
 * @property integer $viewed
 * @property string $url
 *
 * @property User $user
 */
class Notification extends \yii\db\ActiveRecord {

    const ROLE_STUDENT = 'student';
    const ROLE_PROJECT_MANAGER = 'projectManager';
    //notification messages
    const NEW_TASK = 'Tienes una nueva tarea';
    const EDITED_TASK = 'Se modificó una tarea';
    const ACCEPTED_TASK = 'Tu avance fue aceptado';
    const REJECTED_TASK = 'Tu avance fue rechazado';
    const RECEIVED_TASK = 'Se registró un nuevo avance';
    const EDITED_RECEIVED_TASK = 'Se editó un avance';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'viewed'], 'integer'],
            [['description'], 'string'],
            [['created_at'], 'safe'],
            [['url'], 'required'],
            [['role', 'url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'description' => Yii::t('app', 'Description'),
            'role' => Yii::t('app', 'Role'),
            'created_at' => Yii::t('app', 'Created At'),
            'viewed' => Yii::t('app', 'Viewed'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
