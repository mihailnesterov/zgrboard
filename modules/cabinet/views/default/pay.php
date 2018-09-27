<?php

/* 
 * payment page
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Пополнить счет';

$vip = 'VIP';
$premium = 'Premium';
?>

<main role="main">
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-8">
                <p class="bg-warning text-info">На вашем счету: 189,00 руб.</p>
                <!--
                <iframe src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=<?= $vip.'+'.$premium ?>&targets-hint=123&default-sum=300&button-text=12&payment-type-choice=on&mobile-payment-type-choice=on&mail=on&hint=&successURL=&quickpay=shop&account=410011442764960" width="100%" height="222" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                -->
                <form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml" class="row" style="margin: 1em 0; padding: 1em; border: 1px #ddd solid;">
                    <div class="form-group hidden">
                        <label for="receiver">Номер кошелька</label>
                        <input type="hidden1" name="receiver" value="410011442764960" class="form-control input-lg">
                    </div>
                    <div class="form-group hidden">
                        <label for="formcomment">Название перевода в истории отправителя</label>
                        <input type="hidden1" name="formcomment" class="form-control input-lg" value="Проект «Железный человек»: реактор холодного ядерного синтеза">
                    </div>
                    <div class="form-group hidden">
                        <label for="short-dest">Название перевода на странице подтверждения</label>
                        <input type="hidden1" name="short-dest" class="form-control input-lg" value="Проект «Железный человек»: реактор холодного ядерного синтеза">
                    </div>
                    <div class="form-group hidden">
                        <label for="label">Метка, которую сайт или приложение присваивает конкретному переводу</label>
                        <input type="hidden1" name="label" class="form-control input-lg" value="$order_id">
                    </div>
                    <div class="form-group hidden">
                        <label for="quickpay-form">Тип формы</label>
                        <input type="hidden1" name="quickpay-form" class="form-control input-lg" value="shop">
                    </div>
                    <div class="form-group hidden">
                        <label for="targets">№ заказа</label>
                        <input type="hidden1" name="targets" class="form-control input-lg" value="транзакция {order_id}">
                    </div>
                    <div class="form-group col-xs-12 col-sm-8 col-md-5" style="margin-top: 1em;">
                        <label for="sum" style="margin-bottom: 0.5em;">Сумма перевода:</label>
                        <input type="hidden1" name="sum" class="form-control input-lg" value="500" data-type="number">
                    </div>
                    <div class="form-group col-xs-12 hidden">
                        <label for="comment">Комментарий к заказу:</label>
                        <input type="hidden1" name="comment" class="form-control input-lg" value="">
                    </div>
                    <div class="form-group hidden">
                        <label for="need-fio">ФИО</label>
                        <input type="hidden1" class="form-control input-lg" name="need-fio" value="false">
                    </div>
                    <div class="form-group hidden">
                        <label for="need-email">Email</label>
                        <input type="hidden1" class="form-control input-lg" name="need-email" value="true">
                    </div>
                    <div class="form-group hidden">
                        <label for="need-phone">Телефон</label>
                        <input type="hidden1" class="form-control input-lg" name="need-phone" value="false">
                    </div>
                    <div class="form-group hidden">
                        <label for="need-address">Адрес</label>
                        <input type="hidden1" class="form-control input-lg" name="need-address" value="false">
                    </div>
                    <div class="form-group hidden">
                        <label for="successURL">URL редиректа после оплаты</label>
                        <input type="hidden1" class="form-control input-lg" name="successURL" value="cabinet/account">
                    </div>
                    <div class="form-group col-xs-12"  style="margin-top: 1em;">
                        <p>Выберите способ оплаты:</p>
                        <div class="radio">
                            <label><input type="radio" name="paymentType" value="PC">Яндекс.Деньги</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="paymentType" value="AC" checked="checked">Банковская карта (Visa, MasterCard, МИР)</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="paymentType" value="MC">С мобильного телефона</label>
                        </div>
                    </div>
                    
                    <div class="form-group col-xs-12"  style="border-top: 1px #ddd solid; padding: 1.8em 0 0 0;">
                        <input type="submit" value="Отправить" class="btn-orange">
                    </div>
                </form>
                
            </div>
            </article>
</main>
