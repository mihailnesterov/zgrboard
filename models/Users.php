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
 * @property boolean $status статус (активен/неактивен)
 * @property string $created дата создания профиля
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    
    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 10;
    
    private $_user; 
    
    public $rememberMe = true;
    
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
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['auth_key', 'string', 'max' => 255],
            [[ 'avatar', 'created'], 'safe'],
            ['role', 'string', 'max' => 50],
            ['avatar', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 20],
            ['status', 'boolean'],
            
            ['login', 'required', 'message' => 'Логин не может быть пустым'],
            ['password', 'required', 'message' => 'Пароль не может быть пустым'],
            ['email', 'required', 'message' => 'Email не может быть пустым'],
            ['password', 'string', 'min' => 8, 'max' => 255, 'tooShort' => 'Длина пароля не минее 8 символов'],
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
    
    /*
     * Generate Hash Password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    
    /*
     * IdentityInterface 5 abstract metods
     */
    public static function findIdentity($id)
    {
        // возвращает объект activerecord содержащий текущего пользователя.
        return static::findOne($id);
        //return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    
    public function getId()
    {
        // возвращает id текущего пользователя
        return $this->id;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
      // используется при авторизации через через OAuth2 или OpenID
        //return static::findOne(['access_token' => $token]);
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    public function getAuthKey()
    {
       // используется при авторизации через cookie
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
      // используется при авторизации через cookie
        return $this->getAuthKey() === $authKey;
    }
    
        /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /*
     * validate user and call $app->user->login($this->getUser())
     * where take user object from getUser()
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        else {
            return false;
        }
    }
    
    /**
     * Finds user by [[login]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Users::findByUsername($this->login);
        }

        return $this->_user;
    }
    
    /**
     * Finds user by username
     */
    public static function findByUsername($username)
    {
        //return static::findOne(['login' => $username, 'status' => self::STATUS_ACTIVE]);
        return static::findOne(['login' => $username]);
    }
   
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
