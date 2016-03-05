<?php

use yii\grid\GridView;
use yii\helpers\Html;
use app\models\User;
use app\models\Person;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SocialServiceManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eliminar responsables de servicio social';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>


    <?= GridView::widget ([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute' => 'Nombre',
                'value' => function ($dataProvider) {
                    $user = User::findOne (['id' => $dataProvider->user_id]);
                    $person = Person::findOne (['id' => $user->person_id]);

                    return $person->name . ' ' . $person->lastname;
                }
            ],

            //'faculty_id',
            [
                'attribute' => 'Facultad',
                'value' => function ($dataProvider) {
                    $faculty = \app\models\Faculty::findOne (['id' => $dataProvider->faculty_id]);
                    //$person = Person::findOne (['id' => $user->person_id]);

                    return $faculty->name;
                }
            ],

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
