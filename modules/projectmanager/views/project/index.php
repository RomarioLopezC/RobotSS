<?php

use yii\bootstrap\Alert;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis proyectos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php
foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
    echo Alert::widget([
        'options' => [
            'class' => 'alert-' . $key,
        ],
        'body' => $message,
    ]);
}
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Registrar nuevo proyecto', ['create'], ['class' => 'btn btn-success']) ?>
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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model['id']] , [
                            'title' => Yii::t('app', 'Delete'), 'data-confirm' => Yii::t('app', '¿Estas seguro que deseas eliminar el proyecto?'),'data-method' => 'post']);
                    }
                ],
            ],
        ],
    ]); ?>

</div>
