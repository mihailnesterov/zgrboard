<?php

/* 
 * Messages
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\models\Users;
use app\modules\cabinet\models\CabinetMessages;

date_default_timezone_set('Asia/Krasnoyarsk');

$this->title = 'Мои сообщения';
?>

<main role="main">    
        <article id="content" class="row">
            <header class="col-xs-12">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </header>
            
            <div class="col-xs-12">
                <div class="cabinet-message-list">
                    <ul>
                        <?php
                            // вывод списка баннеров из БД
                            foreach ($model as $msg):
                                $created = new DateTime($msg->created);
                                $sender = Users::find()->where(['id' => $msg->sender_id])->one();  // получатель сообщения
                                $receiver = Users::find()->where(['id' => $msg->receiver_id])->one();  // получатель сообщения
                                if( $msg->is_read == 0 && $msg->sender_id != Yii::$app->user->identity->id ) {
                                    $fa_comment = '<i class="fa fa-comment not-read flash animated" aria-hidden="true"></i>';
                                } else {
                                    $fa_comment = '<i class="fa fa-comment" aria-hidden="true"></i>';
                                }
                                echo 
                                '<li><a href="'.Yii::$app->urlManager->createUrl(['cabinet/view-message?id='.$msg->id]).'">'
                                .'<span>'.$fa_comment.' '.$sender->login.' &rArr; '.$receiver->login.' <span>( '.$created->format('d.m.Y H:i').' ): </span></span>'
                                .'<span>'.$msg->theme.'</span>'
                                .'</a></li>';
                            endforeach;
                        ?>
                    </ul>
                </div>
            </div> <!-- end-col -->
            
            <div class="col-xs-12">
                <?php       
                    echo LinkPager::widget([
                        'pagination' => $pages,
                        'registerLinkTags' => true
                    ]);
                ?>
            </div>
            
        </article>
</main>