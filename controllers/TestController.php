<?php

namespace app\controllers;


use app\models\tables\Users;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{
    public function actionIndex()
    {
       Yii::$app->mailer->compose()
           ->setFrom('test@testmail.org')
           ->setTo('marchao@mail.ru')
           ->setSubject('Test message')
           ->setTextBody('Body of mail message')
           ->send();
    }
}