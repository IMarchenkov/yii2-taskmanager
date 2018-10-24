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

class EventsComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function (Event $event) {

            $model = $event->sender;
            $user = Users::findOne($model->user_id);

            $message = 'Hello there is a new task for you ' . $model->name . ' do it until ' . $model->date . ' plz. <a href="http://yii2basic.test/tasks/view?id=' . $model->id . '">Read more...</a>';

            Yii::$app->mailer->compose()
                ->setFrom('test@testmail.org')
                ->setTo($user->email)
                ->setSubject('Created new task for you ' . $model->name)
                ->setTextBody($message)
                ->send();
        });
    }
}