<?php

namespace app\models\form;

use app\models\User;

class LoginForm extends \yii\base\Model
{
    public $email;
    public $password;
    public ?User $user = null;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string'],
            ['email', 'email'],
            ['password', 'validatePassword'],
        ];
    }

    public function beforeValidate()
    {
        $this->user = User::findByEmail($this->email);
        if (!$this->user) {
            $this->addError('password', 'User not found');
        }
        return parent::beforeValidate();
    }

    public function validatePassword($attribute, $params, $validator)
    {
        if ($this->user && !\Yii::$app->security->validatePassword($this->password, $this->user->password_hash)) {
            $this->addError($attribute, 'Password incorrect.');
        }
    }
}