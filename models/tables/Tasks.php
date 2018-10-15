<?php

namespace app\models\tables;

use app\models\User;
use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $task_name
 * @property int $task_creater_id
 * @property int $task_owner_id
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property string $date_created
 * @property User $owner
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_creater_id', 'task_owner_id'], 'integer'],
            [['description'], 'string'],
            [['date_start', 'date_end', 'date_created'], 'safe'],
            [['task_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_name' => 'Task Name',
            'task_creater_id' => 'Task Creater ID',
            'task_owner_id' => 'Task Owner ID',
            'description' => 'Description',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'date_created' => 'Date Created',
        ];
    }

}
