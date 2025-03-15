<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['email', 'full_name', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'unique'],
            ['is_confirm_email', 'boolean'],
            ['role', 'string'],
        ];
    }
}