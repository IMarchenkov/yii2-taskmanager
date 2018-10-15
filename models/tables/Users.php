<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $role_id
 * @property string $authKey
 * @property string $accessToken
 * @property Roles $role
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['role_id'], 'integer'],
            [['username'], 'string', 'max' => 50],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 100],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login',
            'password' => 'Password',
            'role_id' => 'Role ID',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Roles::class, ['id' => 'role_id']);
    }
}
