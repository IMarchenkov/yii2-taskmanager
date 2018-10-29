<?php

namespace app\models\tables;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $task_id
 * @property string $path
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Tasks $task
 * @property Users $user
 * @property UploadedFile $file
 */
class Files extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['file'], 'file', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task_id' => 'Task ID',
            'path' => 'Path',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
//                'createdAtAttribute' => 'create_time',
//                'updatedAtAttribute' => 'update_time',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::class, ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    public function uploadFile($task_id = null)
    {

        $filename = $this->file->getBaseName() . "." . $this->file->getExtension();
        if (self::isImage($this->file)) {
            $path = Yii::getAlias('@upload/images/') . $filename;
        } else {
            $path = Yii::getAlias('@upload/others/') . $filename;
        }

        $this->file->saveAs($path);
        $this->attributes = [
            'task_id' => $task_id,
            'path' => $path,
            'user_id' => Yii::$app->user->id,
        ];

        return $this->save(false);
    }

    public static function isImage($file)
    {
        return explode('/', $file->type)[0] == 'image';
    }

    public static function getThumbnail($filename)
    {
        if (!file_exists(Yii::getAlias('@upload/images/small/' . $filename))) {
            Image::thumbnail('@upload/images/' . $filename, 100, 100)
                ->save(Yii::getAlias('@upload/images/small/' . $filename));
        }
        return Yii::getAlias('/upload/images/small/' . $filename);
    }
}
