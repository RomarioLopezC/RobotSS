<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Managers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-manager-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project Manager', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'last_name',
            'user_id',
            'organization',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
