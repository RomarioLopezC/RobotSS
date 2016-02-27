<?php

/* @var $this yii\web\View */

$this->title = 'Página principal';
$this->params['breadcrumbs'][] = $this->title;
Yii::$app->formatter->locale = 'es_ES';
if (Yii::$app->user->can('student')) {
    echo $this->render('../../modules/student/views/default/index');
}else{
    echo $this->render('../site/landing');
}
?>

