<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear proyecto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'dependency',
            'objective',
            'goals',
            // 'actions_by_students',
            // 'induction',
            // 'materials_for_students',
            // 'economic_support',
            // 'human_resource',
            // 'infraestrcture',
            // 'ammount',
            // 'approved',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
