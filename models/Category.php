<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "zb_category".
 *
 * @property int $id id категории
 * @property string $name название категории
 * @property string $title заголовок страницы категории
 * @property string $keywords ключевые слова категории
 * @property string $description описание категории
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'zb_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'title', 'keywords'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
        ];
    }
}
