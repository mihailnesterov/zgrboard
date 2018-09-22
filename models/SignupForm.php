<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * Signup form
 */
class SignupForm extends Users
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['login', 'required', 'message' => 'Логин не может быть пустым'],
            ['password', 'required', 'message' => 'Пароль не может быть пустым'],
            ['email', 'required', 'message' => 'Email не может быть пустым'],
            ['password', 'string', 'min' => 8, 'max' => 255, 'tooShort' => 'Длина пароля не минее 8 символов'],
            ['login', 'unique', 'targetClass' => SignupForm::className(), 'message' => 'Пользователь с таким логином уже существует'],            
            ['email', 'unique', 'targetClass' => SignupForm::className(), 'message' => 'Пользователь с таким email уже существует'],
        ];
    }
   
}
