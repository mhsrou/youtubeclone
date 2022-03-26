<?php
/**
 *User : Mohsen Roustapour
 *Date : 3/25/2022
 *Time : 12:57 PM
 */

/** @var $channel \common\models\User */

/** @var $this \yii\web\View */

use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="jumbotron">
    <h1 class="display-4"><?= $channel->username; ?></h1>
    <hr class="my-4">
    <?php Pjax::begin() ?>
    <?= $this->render('_subscribe', [
        'channel' => $channel
    ]) ?>
    <?php Pjax::end(); ?>
</div>
