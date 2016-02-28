<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "task".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $delivery_date
 * @property string $created_at
 * @property string $updated_at
 * @property string $status
 * @property integer $project_id
 *
 * @property StudentEvidence[] $studentEvidences
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord{
    public $students;

    const NEWTASK = 'Nuevo';
    const PENDING = 'Pendiente';
    const ACCEPTED = 'Aceptado';

    /**
     * @inheritdoc
     */
    public static function tableName (){
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules (){
        return [
            [['description'], 'string'],
            [['delivery_date', 'created_at', 'updated_at'], 'safe'],
            [['project_id'], 'integer'],
            [['name', 'status'], 'string', 'max' => 255],


        ];
    }

    public function validateDate ($attribute, $params){
        if (strtotime ($this->$attribute) < strtotime (Yii::$app->formatter->asDate ('now', 'yyyy-MM-dd'))) {
            $this->addError ($attribute, 'La fecha de entrega no puede ser anterior a la fecha actual');

        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels (){
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'description' => 'Descripción',
            'delivery_date' => 'Fecha límite de entrega',
            'created_at' => 'Fecha de creación',
            'updated_at' => 'Fecha de última edición',
            'status' => 'Estado',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEvidences (){
        return $this->hasMany (StudentEvidence::className (), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject (){
        return $this->hasOne (Project::className (), ['id' => 'project_id']);
    }

    public function behaviors (){
        return [
            [
                'class' => TimestampBehavior::className (),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
}
