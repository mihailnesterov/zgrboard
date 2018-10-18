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
 *
 * @property ZbBanners[] $zbBanners
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
            [['name', 'image'], 'required'],
            [['text'], 'string'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanners()
    {
        return $this->hasMany(ZbBanners::className(), ['position_id' => 'id']);
    }
}
