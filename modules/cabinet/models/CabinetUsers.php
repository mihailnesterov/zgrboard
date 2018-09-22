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
            /*[['login', 'password', 'auth_key', 'email', 'phone', 'avatar'], 'required'],
            [['status'], 'integer'],
            [['created'], 'safe'],
            [['login', 'password', 'auth_key', 'email', 'avatar'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 20],
            [['role'], 'string', 'max' => 50],*/
            
            ['login', 'string', 'min' => 2, 'max' => 255],
            // password is validated by validatePassword()
            /*['password', 'validatePassword'],*/
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['auth_key', 'string', 'max' => 255],
            [[ 'avatar', 'created'], 'safe'],
            ['role', 'string', 'max' => 50],
            ['avatar', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Authentication Key',
            'status' => 'Статус (активен/неактивен)',
            'rememberMe' => 'Запомнить меня',
            'email' => 'Email',
            'phone' => 'Телефон',
            'avatar' => 'Аватар',
            'role' => 'Роль',
            'created' => 'Дата создания',
        ];
    }
}