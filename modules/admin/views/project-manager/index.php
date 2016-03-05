<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Eliminar responsables de proyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-manager-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>



    <?= GridView::widget ([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'Nombre',
                'value' => function ($dataProvider) {
                    $user = \app\models\User::findOne (['id' => $dataProvider->user_id]);
                    $person = \app\models\Person::findOne (['id' => $user->person_id]);

                    return $person->name . ' ' . $person->lastname;
                }
            ],
            'organization',

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
