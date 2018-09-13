<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zb_users".
 *
 * @property int $id id пользователя
 * @property string $login логин пользователя
 * @property string $password пароль пользователя
 * @property string $email email пользователя
 * @property string $phone телефон пользователя
 * @property string $avatar аватар пользователя
 * @property string $role роль пользователя
 * @property string $created дата создания профиля
 */
class Users extends \yii\db\ActiveRecord
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
            //[['login', 'password', 'email', 'phone', 'avatar', 'created'], 'required'],
            [['login', 'password', 'email'], 'required', 'message' => 'Поле не может быть пустым'],
            [['login'], 'unique', 'targetClass' => Users::className(), 'message' => 'Пользователь с таким логином уже существует'],
            [['email'], 'unique', 'message' => 'Пользователь с таким email уже существует'],
            [['created'], 'safe'],
            [['login', 'role'], 'string', 'max' => 50],
            [['email', 'avatar'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
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
            'email' => 'Email',
            'phone' => 'Телефон',
            'avatar' => 'Аватар',
            'role' => 'Роль',
            'created' => 'Дата создания',
        ];
    }
    
    /*
     * Generate Hash Password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
}
