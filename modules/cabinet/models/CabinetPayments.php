<?php

namespace app\modules\cabinet\models;

use Yii;

/**
 * This is the model class for table "zb_payments".
 *
 * @property int $id id платежа
 * @property int $user_id id пользователя
 * @property double $sum сумма платежа
 * @property string $source источник платежа
 * @property string $comment комментарий
 * @property string $created дата платежа
 *
 * @property ZbUsers $user
 */
class CabinetPayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'sum'], 'required'],
            [['user_id'], 'integer'],
            [['sum'], 'number'],
            [['created'], 'safe'],
            [['source', 'comment'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id платежа',
            'user_id' => 'id пользователя',
            'sum' => 'Сумма, руб.',
            'source' => 'Источник платежа',
            'comment' => 'Комментарий',
            'created' => 'Дата платежа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\Users::className(), ['id' => 'user_id']);
    }
}
