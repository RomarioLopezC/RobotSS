<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "evidence".
 *
 * @property integer $id
 * @property string $attachment_path
 * @property string $description
 * @property string $status
 * @property string $accepted_date
 * @property string $updated_at
 *
 * @property StudentEvidence[] $studentEvidences
 */
class Evidence extends \yii\db\ActiveRecord
{
    public $file;

    public static $NEW = 'Nuevo';
    public static $PENDING = 'Pendiente';
    public static $ACCEPTED = 'Aceptado';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['file'], 'file', 'skipOnEmpty' => false],
            [['description'], 'string'],
            [['accepted_date', 'updated_at'], 'safe'],
            [['attachment_path', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attachment_path' => 'Archivo',
            'description' => 'Descripción',
            'status' => 'Estatus',
            'accepted_date' => 'Fecha de aceptación',
            'updated_at' => 'Fecha de actualización',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvidences()
    {
        return $this->hasMany(StudentEvidence::className(), ['evidence_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'updated_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()')
            ]
        ];
    }
}
