<?php
/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:46 AM
 */
use yii\bootstrap\Nav;
use yii\helpers\Url;
/*
•	Cuenta
    o	Modificar cuenta
•	Alumnos
    o	Asignación de alumnos
•	Proyectos
    o	Búsqueda

 */
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta',
                    'url' => Url::to(['/person/update','id'=>Yii::$app->user->id])
                ],
            ],
        ],
        [
            'label' => 'Alumnos',
            'items' => [
                ['label' => 'Asignación de alumnos', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Proyectos',
            'items' => [
                ['label' => 'Busqueda', 'url' => '#'],
            ],
        ],
    ]
]);