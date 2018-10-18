<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "zb_banners".
 *
 * @property int $id id баннера
 * @property int $position_id id позиции
 * @property int $user_id id пользователя
 * @property string $name Название баннера
 * @property string $image Картинка баннера
 * @property string $link Ссылка баннера
 * @property int $shows Количество показов
 * @property int $clicks Количество кликов
 * @property string $created Дата создания
 *
 * @property CabinetBannerPositions $position
 * @property Users $user
 */
class CabinetBanners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position_id', 'user_id', 'name', 'image', 'link', 'shows', 'clicks'], 'required'],
            [['position_id', 'user_id', 'shows', 'clicks'], 'integer'],
            [['created'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 500],
            [['active'], 'boolean'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => CabinetBannerPositions::className(), 'targetAttribute' => ['position_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => CabinetUsers::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id баннера',
            'position_id' => 'id позиции',
            'user_id' => 'id пользователя',
            'name' => 'Название',
            'image' => 'Картинка',
            'link' => 'Ссылка',
            'shows' => 'Кол-во показов',
            'clicks' => 'Кол-во кликов',
            'created' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(CabinetBannerPositions::className(), ['id' => 'position_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
