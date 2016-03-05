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
            [['organization'], 'required'],
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
            'organization' => 'Organización',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    public function afterSave($insert, $changedAttributes) {
        if ($insert) {
            //assign the role to the user
            $authManager = Yii::$app->getAuthManager();
            $socialServiceMRole = $authManager->getRole('projectManager');
            $authManager->assign($socialServiceMRole, $this->user_id);
        }
        parent::afterSave($insert, $changedAttributes);
    }

}
