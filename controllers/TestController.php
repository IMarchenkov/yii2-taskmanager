<?php

namespace app\controllers;


use app\components\EventsComponent;
use app\models\tables\Users;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        $key = 'tasks_current_task_'.$userId;

//        $dependency = new DbDependency();
//        $dependency->sql = "SELECT COUNT(*) FROM tasks";

        $cache = Yii::$app->cache;

        $dataProvider = $cache->get($key);

        var_dump($dataProvider);
    }
}