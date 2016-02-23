<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_vacancy".
 *
 * @property integer $project_id
 * @property integer $vacancy
 */
class ProjectVacancy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_vacancy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'vacancy'], 'required'],
            [['project_id', 'vacancy'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'vacancy' => 'Vacancy',
        ];
    }

    public function getPrimaryKey($asArray = false)
    {
        return 'project_id';
    }
}
