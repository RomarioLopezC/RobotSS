<?php

namespace app\models;

use Yii;
use dektrium\user\models\User as BaseUser;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $person_id
 *
 * @property Profile $profile
 * @property ProjectManager[] $projectManagers
 * @property SocialAccount[] $socialAccounts
 * @property SocialServiceManager[] $socialServiceManagers
 * @property Student[] $students
 * @property Token[] $tokens
 * @property Person $person
 */
class User extends BaseUser {
    /**
     * @inheritdoc
     */
    public static function tableName (){
        return 'user';
    }

    function scenarios (){
        return [
            'default' => ['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules (){
        return [
            [['username', 'email'], 'required'],
            ['password_hash', 'required', 'message' => 'Password no puede estar vacío.'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'person_id'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels (){
        return [
            'id' => 'ID',
            'username' => 'Nombre de usuario',
            'email' => 'Correo electrónico',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile (){
        return $this->hasOne (Profile::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectManagers (){
        return $this->hasMany (ProjectManager::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts (){
        return $this->hasMany (SocialAccount::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialServiceManagers (){
        return $this->hasMany (SocialServiceManager::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents (){
        return $this->hasMany (Student::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens (){
        return $this->hasMany (Token::className (), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson (){
        return $this->hasOne (Person::className (), ['id' => 'person_id']);
    }

    /**
     * Figure it out the person role and returns an
     * object of that type.
     */
    public function getUserRole(){
        $rol = null;
        if (Yii::$app->user->can('projectManager')) {
            return $rol = ProjectManager::findOne(['user_id' => $this->id]);
        }

        if (Yii::$app->user->can('socialServiceManager')) {
            return $rol = SocialServiceManager::findOne(['user_id' => $this->id]);
        }

        if (Yii::$app->user->can('student')) {
            return $rol = Student::findOne(['user_id' => $this->id]);
        }
        return $rol;
    }
}
