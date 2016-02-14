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
                    'url' => Url::to(['/person/update','id'=>Yii::$app->user->id])
                ],
            ],
        ],
        [
            'label' => 'Proyectos',
            'items' => [
                ['label' => 'Busqueda', 'url' => '#'],
            ],
        ],
        [
            'label'=>'Avances',
            'url'=>Url::to('')
        ],
        [
            'label'=>'Documentos',
            'items'=>[
                [
                    'label'=>'Preregistro',
                    'url'=>Url::to(['/student/default/print-preregistration-p-d-f'])
                ]
            ]
        ],
    ]
]);