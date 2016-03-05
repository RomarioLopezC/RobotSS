<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eliminar alumnos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>


    <?= GridView::widget ([
        'dataProvider' => $dataProvider,
        'columns' => [
            'enrollment_id',
            [
                'attribute' => 'Nombre',
                'value' => function ($dataProvider) {
                    $user = \app\models\User::findOne (['id' => $dataProvider->user_id]);
                    $person = \app\models\Person::findOne (['id' => $user->person_id]);

                    return $person->name . ' ' . $person->lastname;
                }
            ],
            [
                'attribute' => 'Licenciatura',
                'value' => function ($dataProvider) {
                    $student = \app\models\Student::findOne (['user_id' => $dataProvider->user_id]);
                    $degree = \app\models\Degree::findOne (['id' => $student->degree_id]);

                    return $degree->name;
                }
            ],
            [
                'attribute' => 'Facultad',
                'value' => function ($dataProvider) {
                    $faculty = \app\models\Faculty::findOne (['id' => $dataProvider->faculty_id]);

                    return $faculty->name;
                }
            ],

            'current_semester',



            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a ('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'user_id' => $model['user_id']], [
                            'title' => Yii::t ('app', 'Delete'), 'data-confirm' => Yii::t ('app', '¿Estas seguro que deseas eliminar?'), 'data-method' => 'post']);
                    }
                ],

            ],

        ],

    ]); ?>

</div>
