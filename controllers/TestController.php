<?php

namespace app\controllers;


use app\models\tables\Users;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $users = Users::find()->select(['id', 'username'])->all();
        $res = ArrayHelper::map($users, 'id', 'username');
        var_dump($res);
    }
}