<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.10.2018
 * Time: 22:41
 */

namespace app\components;

use app\models\tables\Users;
use Yii;
use app\models\tables\Tasks;
use yii\base\Component;
use yii\base\Event;
use yii\web\YiiAsset;

class EventsComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, [self::class, 'handlerTaskCreate']);

        Event::on(Users::class, Users::EVENT_BEFORE_INSERT, [self::class, 'handlerUserCreate']);
    }

    public static function handlerTaskCreate(Event $event)
    {
        $model = $event->sender;
        $user = Users::findOne($model->user_id);

        $message = 'Hello there is a new task for you <b>' . $model->name . '</b> do it until ' . $model->date . ' plz. <a href="http://yii2basic.test/tasks/view?id=' . $model->id . '">Read more...</a>';

        Yii::$app->mailer->compose()
            ->setFrom('test@testmail.org')
            ->setTo($user->email)
            ->setSubject('Created new task for you ' . $model->name)
            ->setTextBody($message)
            ->send();
    }

    public static function handlerUserCreate(Event $event)
    {
        $model = $event->sender;

        $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
        $model->authKey = $model->username . random_int(100, 999) . 'key';
        $model->accessToken = random_int(100, 999) . '-token';
    }
}