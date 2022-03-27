<?php
/**
 *User : Mohsen Roustapour
 *Date : 3/25/2022
 *Time : 2:53 PM
 */

/** @var $channel \common\models\User */

use yii\helpers\Url;

?>
<a class="btn <?= $channel->isSubscribed(Yii::$app->user->id)
    ? 'btn-secondary' : 'btn-danger' ?>"
   href="<?= Url::to(['channel/subscribe', 'username' => $channel->username]) ?>"
   data-method="post" data-pjax="1">subscribe
    <i class="fa-regular fa-bell"></i>
</a> <?= $channel->getSubscribers()->count() ?>
