<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "zb_banner_positions".
 *
 * @property int $id id позиции
 * @property string $name Название позиции
 * @property string $text Описание позиции
 * @property string $image Картинка позиции
 * @property int $price цена за сутки
 *
 * @property Banners[] $Banners
 */
class CabinetBannerPositions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_banner_positions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['text'], 'string'],
            [['price'], 'integer'], 
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id позиции',
            'name' => 'Название',
            'text' => 'Текст',
            'image' => 'Картинка',
            'price' => 'Цена',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(Banners::className(), ['position_id' => 'id']);
    }
}
