<?php

namespace app\modules\cabinet\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "zb_ads".
 *
 * @property int $id id объявления
 * @property int $user_id id пользователя
 * @property int $category_id id категории
 * @property string $title заголовок объявления
 * @property string $text текст объявления
 * @property string $price цена
 * @property string $photo1 фото 1
 * @property string $photo2 фото 2
 * @property string $photo3 фото 3
 * @property string $photo4 фото 4
 * @property string $type тип объявления
 * @property string $date_begin дата начала
 * @property string $date_end дата окончания
 * @property int $vip vip объявление
 * @property int $premium premium объявление
 * @property string $created дата/время создания
 * @property int $visits количество визитов
 *
 * @property ZbCategory $category
 * @property ZbUsers $user
 */
class CabinetAds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_ads';
    }
    
    /**
     * @var UploadedPhoto1
     * @var UploadedPhoto2
     * @var UploadedPhoto3
     * @var UploadedPhoto4
     */
    public $photoFile1;
    public $photoFile2;
    public $photoFile3;
    public $photoFile4;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'title', 'text', 'type'], 'required'],
            [['user_id', 'category_id', 'vip', 'premium', 'visits'], 'integer'],
            [['text'], 'string'],
            [['date_begin', 'date_end', 'created'], 'safe'],
            [['title', 'price', 'photo1', 'photo2', 'photo3', 'photo4', 'type'], 'string', 'max' => 255],
            [['photoFile1', 'photoFile2', 'photoFile3', 'photoFile4'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true, 'maxSize' => 2048 * 1024, 'tooBig' => 'Максимальный размер файла 2 MB'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Выбор категории',
            'title' => 'Заголовок объявления',
            'text' => 'Текст объявления',
            'price' => 'Цена',
            'photo1' => 'Фото 1',
            'photo2' => 'Фото 2',
            'photo3' => 'Фото 3',
            'photo4' => 'Фото 4',
            'type' => 'Тип объявления',
            'date_begin' => 'Дата начала публикации',
            'date_end' => 'Дата окончания публикации',
            'vip' => 'VIP объявление',
            'premium' => 'Premium объявление',
            'created' => 'Дата создания',
            'visits' => 'Количество просмотров',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
    
    /**
     * @return uploaded image file
     */
    public function upload($file){
        if($this->validate()){
            date_default_timezone_set('Asia/Krasnoyarsk');
            $date = date('YmdHis');
            $length = 8;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $filename = $date.$randomString;
            //$file->saveAs('images/users/'.Yii::$app->user->identity->login.'/'.$file->baseName.'.'.$file->extension);
            $file->saveAs('images/users/'.Yii::$app->user->identity->login.'/'.$filename.'.'.$file->extension);
            return true;
        } else {
            return false;
        }
    }
    
}
