<?php

namespace app\modules\cabinet\models;

use Yii;

/* 
 * Users model for the `cabinet` module
 */

class CabinetUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [            
            ['login', 'string', 'min' => 2, 'max' => 255],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['auth_key', 'string', 'max' => 255],
            [[ 'avatar', 'created'], 'safe'],
            ['role', 'string', 'max' => 50],
            ['avatar', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 20],
            ['password', 'required', 'message' => 'Пароль не может быть пустым'],
            ['email', 'required', 'message' => 'Email не может быть пустым'],
            ['password', 'string', 'min' => 8, 'max' => 255, 'tooShort' => 'Длина пароля не минее 8 символов'],
            //['login', 'unique', 'targetClass' => \app\models\Users::className(), 'message' => 'Пользователь с таким логином уже существует'],            
            //['email', 'unique', 'targetClass' => \app\models\Users::className(), 'message' => 'Пользователь с таким email уже существует'],
        ];
    }

    
    /*
     * Generate Hash Password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /*
     * Validates password
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
    
    
}