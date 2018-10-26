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
 * @property string $email
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Roles $role
 * @property string $password_repeat
 */

class Users extends \yii\db\ActiveRecord
{
    const SCENARIO_SIGNUP = 'signup';
    public $password_repeat;

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
            [['username', 'password', 'email'], 'required'],
            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => 'app\models\tables\Users', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 50],
            ['username', 'match', 'pattern' => '/^[A-z][\w]+$/'],
            ['email', 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'app\models\tables\Users', 'message' => 'This email address has already been taken.'],
            [['role_id'], 'integer'],
            [['password', 'password_repeat', 'email'], 'string', 'min' => 5, 'max' => 100],
            ['password_repeat', 'required', 'on' => self::SCENARIO_SIGNUP],
            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'on' => self::SCENARIO_SIGNUP],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Repeat password',
            'role_id' => 'Role ID',
            'email' => 'Email'
        ];
    }

    public function getRole()
    {
        return $this->hasOne(Roles::class, ['id' => 'role_id']);
    }


    public static function getUserWithRole($id)
    {
        return static::find()
            ->where(['id' => $id])
            ->with('role')
            ->one();
    }
}
