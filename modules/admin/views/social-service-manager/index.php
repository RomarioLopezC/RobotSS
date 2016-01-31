<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SocialServiceManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Social Service Managers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-service-manager-index">

    <h1>Eliminar responsables de servicio social</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'faculty_id',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'],
        ],
    ]); ?>

</div>
