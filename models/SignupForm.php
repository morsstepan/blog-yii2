<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $password;
    //public $new_password;


    public function rules()
    {
        return [
            [['username', 'name', 'surname', 'patronymic', 'email', 'password' ], 'required'],
            [['username', 'name', 'surname', 'patronymic'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],

        ];
    }

    public function signup()
    {
        if($this->validate())
        {
            $user = new User();
            $user->attributes = $this->attributes;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            return $user->create();
        }
    }
}
