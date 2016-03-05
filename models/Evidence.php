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
class Evidence extends \yii\db\ActiveRecord {
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'evidence';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description'], 'required'],
            ['file', 'file', 'maxSize' => 1024 * 1024 * 10, 'tooBig' => 'El archivo ha superado el límite de 10MB.'],
            [['description'], 'string'],
            [['accepted_date', 'updated_at'], 'safe'],
            [['attachment_path', 'attachment_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'attachment_path' => 'Archivo',
            'description' => 'Descripción',
            'status' => 'Estatus',
            'accepted_date' => 'Fecha de aceptación',
            'updated_at' => 'Fecha de actualización',
            'attachment_name' => 'Nombre del archivo',
            'file' => 'Archivo'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvidences() {
        return $this->hasMany(StudentEvidence::className(), ['evidence_id' => 'id']);
    }

    public function behaviors() {
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
