<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 16.10.2018
 * Time: 0:46
 */

namespace app\controllers;

namespace app\controllers;

use app\models\tables\Users;
use app\models\User;
use yii\web\Controller;

class DatafillController extends Controller
{
    public function actionIndex()
    {
//        $user = new Users([
//            'username' => 'admin',
//            'password' =>\Yii::$app->getSecurity()->generatePasswordHash('qwerty'),
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ]);
//
//        $user->save();

        $user = new Users([
            'username' => 'manager',
            'password' =>\Yii::$app->getSecurity()->generatePasswordHash('12345'),
            'authKey' => 'manager100key',
            'accessToken' => 'manager-token',
            'role_id' => 2
        ]);

        $user->save();
    }
}