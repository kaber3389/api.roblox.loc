<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int id
 * @property string email
 * @property string full_name
 * @property string role
 * @property string password
 * @property string created_at
 * @property string updated_at
 * @property boolean is_confirm_email
 */
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
            ['password', 'string', 'length' => [4, 24]],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}