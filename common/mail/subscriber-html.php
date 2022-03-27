<?php
/**
 *User : Mohsen Roustapour
 *Date : 3/27/2022
 *Time : 2:56 PM
 */
/** @var $channel \common\models\User */
/** @var $user \common\models\User */
?>
<p>Hello <?= $channel->username?></p>
<p>User <?= \common\helpers\Html::channelLink($user,true) ?>
    has subscribed to you</p>
<p>YouTubeClone team</p>