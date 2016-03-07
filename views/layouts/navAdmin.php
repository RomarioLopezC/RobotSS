<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: David Cocom
 * Date: 27/01/2016
 * Time: 03:43 AM
 */
echo Nav::widget ([
    'options' => ['class' => 'navbar-nav navbar-left'],
    'items' => [
        [
            'label' => 'Usuarios',
            'items' => [
                ['label' => 'Eliminar Responsables de Proyecto', 'url' => Url::to (['/admin/project-manager/index'])],
                ['label' => 'Eliminar Responsables de SS', 'url' => Url::to (['/admin/social-service-manager/index'])],
                ['label' => 'Eliminar Alumnos', 'url' => Url::to (['/admin/student/index'])],
                ['label' => 'Aprobación de proyectos', 'url' => Url::to (['/admin/project/view-projects'])],
                ['label' => 'Registrar encargado de servicio social',
                    'url' => Url::to (['/admin/social-service-manager/create'])],
            ],
        ],
        [
            'label' => 'Cuenta',
            'items' => [
                ['label' => 'Modificar cuenta',
                    'url' => Url::to (['/person/update', 'id' => Yii::$app->user->id])
                ],
            ],
        ],
    ]
]);