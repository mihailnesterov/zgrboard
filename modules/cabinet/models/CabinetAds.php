<?php

namespace app\modules\cabinet\models;

use Yii;

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
            'date_begin' => 'Дата начала срока',
            'date_end' => 'Дата окончания срока',
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
}
