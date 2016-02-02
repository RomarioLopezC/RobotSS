<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_manager".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $organization
 *
 * @property User $user
 */
class ProjectManager extends \yii\db\ActiveRecord {
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'project_manager';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['last_name', 'organization'], 'required'],
            [['id', 'user_id'], 'integer'],
            [['organization'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'organization' => 'Organization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


}
