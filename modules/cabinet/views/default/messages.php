<?php

/* 
 * Messages
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\cabinet\models\CabinetMessages;

date_default_timezone_set('Asia/Krasnoyarsk');

$this->title = 'Мои сообщения';
?>

<main role="main">    
        <article id="content" class="row">
            <div class="col-xs-12" style="margin-top: 1.5em;">
                <h1><?= Html::encode($this->title) ?></h1>
                <hr>
            </div>
            <div class="col-xs-12">

                <!--<table class='table table-bordered1 table-responsive table-striped text-center'>
                    <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Отправитель</th>
                            <th>Получатель</th>
                            <th>Тема</th>
                            <th>Текст</th>
                            <th>Ответить</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // вывод списка баннеров из БД
                            foreach ($model as $msg):
                                $created = new DateTime($msg->created);
                                $receiver = \app\models\Users::find($msg->receiver_id)->one();  // получатель сообщения
                                echo 
                                '<tr>'
                                .'<td>'.$created->format('d.m.Y').'</td>'
                                .'<td>'.$sender->login.'</td>'
                                .'<td>'.$receiver->login.'</td>'
                                .'<td><a href="'.Yii::$app->urlManager->createUrl(['messages/'.$msg->id]).'">'.$msg->theme.'</a></td>'
                                .'<td>'.$msg->text.'</td>'
                                .'<td>'.Html::button('Ответить', ['class' => 'btn btn-default']).'</td>'
                                .'</tr>';
                            endforeach;
                        ?>
                    </tbody>
                </table>-->
                
            </div> <!-- end-col -->
            
            <div class="col-xs-12">
                <div class="cabinet-message-list">
                    <ul>
                        <?php
                            // вывод списка баннеров из БД
                            foreach ($model as $msg):
                                $created = new DateTime($msg->created);
                                $receiver = \app\models\Users::find($msg->receiver_id)->one();  // получатель сообщения
                                if( $msg->is_read == 0 ) {
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