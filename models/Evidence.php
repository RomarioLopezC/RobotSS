<?php

namespace app\models;

use Yii;

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

    public static $NEW = 'Nuevo';
    public static $PENDING = 'Pendiente';
    public static $ACCEPTED = 'Aceptado';

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
            [['description'], 'string'],
            [['accepted_date', 'updated_at'], 'safe'],
            [['attachment_path', 'status'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'attachment_path' => 'Archivo adjunto',
            'description' => 'Descripción',
            'status' => 'Status',
            'accepted_date' => 'Accepted Date',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvidences() {
        return $this->hasMany(StudentEvidence::className(), ['evidence_id' => 'id']);
    }
}
