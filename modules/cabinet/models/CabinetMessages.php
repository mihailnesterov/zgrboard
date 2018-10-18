<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "zb_messages".
 *
 * @property int $id id сообщения
 * @property int $sender_id id отправителя
 * @property int $receiver_id id получателя
 * @property string $type тип сообщения
 * @property string $theme тема сообщения
 * @property string $text текст сообщения
 * @property string $image картинка сообщения
 * @property int $is_read прочитано
 * @property int $blocked заблокировано
 * @property string $created дата создания
 *
 * @property Users $sender
 */
class CabinetMessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id', 'type', 'theme', 'text'], 'required'],
            [['sender_id', 'receiver_id', 'is_read', 'blocked'], 'integer'],
            [['type', 'theme', 'text', 'image'], 'string'],
            [['created'], 'safe'],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Users::className(), 'targetAttribute' => ['sender_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id сообщения',
            'sender_id' => 'id отправителя',
            'receiver_id' => 'id получателя',
            'type' => 'Тип сообщения',
            'theme' => 'Тема сообщения',
            'text' => 'Текст сообщения',
            'image' => 'Картинка сообщения',
            'is_read' => 'Прочитано',
            'blocked' => 'Заблокировано',
            'created' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(\app\models\Users::className(), ['id' => 'sender_id']);
    }
}
