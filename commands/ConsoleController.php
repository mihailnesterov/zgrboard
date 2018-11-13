<?php

/* 
 * console commands controller
 */

namespace app\commands;

use yii\console\Controller;
use Yii;
use app\modules\cabinet\models\CabinetPayments;
use app\modules\cabinet\models\CabinetAds;
use app\modules\cabinet\models\CabinetAdsPrice;

class ConsoleController extends Controller
{

    public function actionIndex()
    {
        echo "test running...";
    }
    
    public function actionPaymentsUpdate()
    {
        date_default_timezone_set('Asia/Krasnoyarsk');
        $ads_vip = CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['vip' => 1])->all();
        $ads_premium = CabinetAds::find()->where(['>', 'date_end', date('Y.m.d H:i:s')])->andWhere(['premium' => 1])->all();
        $price_vip = CabinetAdsPrice::find()->where(['id' => 1])->one();
        $price_premium = CabinetAdsPrice::find()->where(['id' => 2])->one();
        
        echo date('d-m-Y H:i:s')." start daily payment's update ...\n";
        
        foreach ($ads_vip as $vip):
            $payment = new CabinetPayments();
            $payment->user_id = $vip->user_id;
            $payment->sum = '-'.$price_vip->price;
            $payment->source = 'vip-тариф';
            $payment->comment = '('.$vip->id.') '.$vip->title;
            $payment->save();
        endforeach;
        echo "update vip success...\n";
        
        foreach ($ads_premium as $premium):
            $payment = new CabinetPayments();
            $payment->user_id = $premium->user_id;
            $payment->sum = '-'.$price_premium->price;
            $payment->source = 'premium-тариф';
            $payment->comment = '('.$premium->id.') '.$premium->title;
            $payment->save();
        endforeach;
        echo "update premium success...\n";
    }

}