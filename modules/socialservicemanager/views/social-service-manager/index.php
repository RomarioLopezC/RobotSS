<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SocialServiceManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Social Service Managers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-index">

    <div class="well well-sm">
        <h1><?= Html::encode ($this->title) ?></h1>
    </div>


    <?= GridView::widget ([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'faculty_id',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a ('<span class="glyphicon glyphicon-trash"></span>',
                            ['delete', 'user_id' => $model['user_id']], [
                                'title' => Yii::t ('app', 'Delete'),
                                'data-confirm' => Yii::t ('app', '¿Estas seguro que deseas eliminar?'),
                                'data-method' => 'post'
                            ]);
                    }
                ],

            ],
        ],
    ]); ?>

</div>
