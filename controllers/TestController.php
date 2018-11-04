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

        echo Yii::$app->request->referrer;
        echo 'Hello!';
    }
}