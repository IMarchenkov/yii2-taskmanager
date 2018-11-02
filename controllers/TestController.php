<?php

namespace app\controllers;


use app\components\EventsComponent;
use app\models\tables\Users;
use app\models\tables\Tasks;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{
    public function actionIndex()
    {
        $tasks = Tasks::getDeadlineTasks();
        foreach ($tasks as $task){
//            echo .PHP_EOL;
            $user = $task->user;
            Yii::$app->mailer->compose()
                ->setFrom('test@testmail.org')
                ->setTo($user->email)
                ->setSubject('Deadline for  ' . $task->name)
                ->setTextBody('yo!')
                ->send();
        }
    }
}