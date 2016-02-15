<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:44 AM
 */
use yii\bootstrap\Nav;
use yii\helpers\Url;

/*
 *
•	Cuenta
    o	Modificar cuenta
•	Proyectos
    o	Búsqueda
•	Avances
•	Documentos

 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta',
                    'url' => Url::to(['/person/update', 'id' => Yii::$app->user->id])
                ],
            ],
        ],
        [
            'label' => 'Proyectos',
            'items' => [
                ['label' => 'Busqueda', 'url' => Url::to(['/project'])],
            ],
        ],
        [
            'label' => 'Avances',
            'url' => Url::to('')
        ],
        [

            'label'=>'Documentos',
            'items'=>[
                [
                    'label'=>'Imprimir hoja de preinscripción',
                    'url'=>Url::to(['/student/default/print-preregistration-p-d-f'])
                ],
                [
                    'label'=>'Imprimir carta de asignación.',
                    'url'=>Url::to(['/student/default/print-project-assignment-p-d-f'])
                ]
            ]
        ],
    ]
]);