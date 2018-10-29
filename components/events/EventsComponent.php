<?php
/**
 * Created by PhpStorm.
 * User: Igor
 * Date: 24.10.2018
 * Time: 22:41
 */

namespace app\components\events;

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

        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, [OnCreate::class, 'handlerTaskCreate']);

        Event::on(Users::class, Users::EVENT_BEFORE_INSERT, [OnCreate::class, 'handlerUserCreate']);
    }
}