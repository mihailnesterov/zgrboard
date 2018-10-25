<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "zb_ads_price".
 *
 * @property int $id id тарифа
 * @property string $name название тарифа
 * @property string $text описание тарифа
 * @property int $price цена
 */
class CabinetAdsPrice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_ads_price';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'text', 'price'], 'required'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id тарифа',
            'name' => 'Название тарифа',
            'text' => 'Описание тарифа',
            'price' => 'Цена',
        ];
    }
}
