<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\web\User;
use app\models\ProjectManager;
use app\models\Project;
use yii\helpers\ArrayHelper;
use app\models\User;
use yii\bootstrap\Modal;
use app\models\Registration;
use yii\bootstrap\Alert;


/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
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



    <?php
    // ////////////////////////BOTON CREAR/////////////////////7
    $user = User::find()
        ->where("id=" . Yii::$app->user->id)
        ->one();
    $user_id = $user->id;
    $manager = ProjectManager::find()
        ->where("user_id=" . $user_id)
        ->one();
    $manager_id = $manager->id;
    $projects=Project::find()
        ->where("manager_id=" . $manager_id)
        ->all();

    Modal::begin([
        'header' => '<h2>Seleccione el proyecto</h2>',
        'toggleButton' => [
            'label' =>'Crear nueva petición',
            'class' => 'btn btn-success'
        ],
    ]);




    ?>

    <?= Html::beginForm(['select-project'], 'post') ?>
    <?= Html::dropDownList('list', null, ArrayHelper::map($projects, 'id', 'name'),['class' => 'form-control']) ?>
    <?= Html::submitButton('Crear', ['class' => 'btn btn-success']) ?>
    <?= Html::endForm() ?>

    <?php

    Modal::end();
    /////////////////////////////7 BOTON CREAR///////////////////////////////////7
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'delivery_date',
            'created_at',
            // 'updated_at',
            // 'status',
            // 'project_id',

////////////////////////////BOTON EDITAR
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
            ///////////////////////////////


//////////////////////////7BOTON RETROALIMENTACION
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}{edit}',
                'buttons'  => [
                    'view' => function($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-file"></span>', ['show-feedback-screen', 'id' => $model['id']]);
                    }
                ],

            ]
        ],
    ]);
    ///////////////
    ?>

</div>
