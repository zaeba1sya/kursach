<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class Registration extends Model
{
    public $username;
    public $login;
    public $password;
    public $password_repeat;
    public $friend_code;
    public $rules;

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Username'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'password_repeat' => Yii::t('app', 'Password_repeat'),
            'friend_code' => Yii::t('app', 'Friend_code'),
            'rules' => Yii::t('app', 'Rules'),
        ];
    }



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'username', 'password', 'password_repeat'], 'required'],
            [['login', 'username', 'friend_code'], 'string'],
            [['login', 'password'], 'match', 'pattern' => "/^[a-zA-Z0-9\-]+$/u"],
            [['login'], 'unique', 'targetClass' => User::class],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => "password"],
            ['rules', "required", 'requiredValue' => 1]
        ];
    }
}
