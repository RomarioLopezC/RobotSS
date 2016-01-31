<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Managers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-manager-index">

    <h1>Eliminar responsables de proyecto</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'organization',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'

            ],
        ],
    ]); ?>

</div>
