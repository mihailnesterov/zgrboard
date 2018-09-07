<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\db\ActiveRecord;

class User extends \yii\db\ActiveRecord
{
    public static function tableName() {
        parent::tableName();
        return 'User';
    }
    
    public function rules() {
        parent::rules();
        return [
            ['id', 'number'],
            ['login', 'required'],
            ['login', 'string', 'max' => 256],
            ['role', 'required'],
            ['created', 'date', 'format' => 'Y-m-d'],
        ];
    }
}