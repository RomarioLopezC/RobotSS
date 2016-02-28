<?php

namespace app\modules\admin\controllers;

use app\models\Project;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class ProjectController extends Controller {
    public function actionViewProjects() {
        $dataProvider = new ActiveDataProvider([
            'query' => Project::find()->where(['approved' => null]),
        ]);

        return $this->render('view_projects', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApproveProject($id) {
        if (($model = Project::findOne($id)) !== null) {
            if ($model->approved == null) {
                //Se registra como aprovado
                $model->approved = true;
                $model->update(false);

                //Se envia el correo al estudiante
                Yii::$app->mailer->compose()
                    ->setFrom('from@domain.com')
                    ->setTo($model->projectManager->user->email)
                    ->setSubject('Aprobación del proyecto' . ' ' . $model->name)
                    ->setTextBody('Su proyecto ha sido aprobado.')
                    ->setHtmlBody('<b>Su proyecto ha sido aprobado.</b>')
                    ->send();

                Yii::$app->getSession()->setFlash('success', 'El proyecto ha sido aprobado.');
                $this->redirect('view-projects');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'El proyecto ya ha sido aprobado previamente.');
                $this->redirect('view-projects');
            }
        } else {
            throw new NotFoundHttpException('El proyecto no ha sido encontrado.');
        }
    }

    public function actionCancelProject($id) {
        if (($model = Project::findOne($id)) !== null) {
            if ($model->approved == false) {
                //Se registra como cancelado
                $model->approved = false;
                $model->update(false);

                //Se envia el correo al estudiante
                Yii::$app->mailer->compose()
                    ->setFrom('from@domain.com')
                    ->setTo($model->projectManager->user->email)
                    ->setSubject('Proyecto' . ' ' . $model->name . ' rechazado.')
                    ->setTextBody('Su proyecto ha sido rechazado.')
                    ->setHtmlBody('<b>Su proyecto ha sido rechazado.</b>')
                    ->send();

                Yii::$app->getSession()->setFlash('success', 'El proyecto ha sido rechazado.');
                $this->redirect('view-projects');
            } else {
                Yii::$app->getSession()->setFlash('danger', 'El proyecto ya ha sido aprobado previamente.');
                $this->redirect('view-projects');
            }
        } else {
            throw new NotFoundHttpException('El proyecto no ha sido encontrado.');
        }
    }
}