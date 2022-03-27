<?php
/**
 *User : Mohsen Roustapour
 *Date : 3/25/2022
 *Time : 12:57 PM
 */

/** @var $channel \common\models\User */

/** @var $profile common\models\Profile */

/** @var $this \yii\web\View */

/** @var $dataProvider ActiveDataProvider */

use yii\bootstrap5\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;
use yii\widgets\Pjax;

?>
<div class="d-flex justify-content-between" style="background-image:url(<?= $profile->getAvatarLink($channel->id) ?>) ">
    <div class="jumbotron">
        <h1 class="display-4"><?= $channel->username; ?></h1>
        <hr class="my-4">
        <?php Pjax::begin() ?>
        <?= $this->render('_subscribe', [
            'channel' => $channel
        ]) ?>
        <?php Pjax::end(); ?>
    </div>
    <?php if ($channel->id == Yii::$app->user->id) { ?>
        <div>
            <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data']
            ]) ?>
            <button class="btn btn-warning btn-file">
                select avatar
                <input type="file" id="avatar" name="avatar">
            </button>
            <?php ActiveForm::end() ?>
        </div>
    <?php } ?>

</div>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@frontend/views/video/_video_item',
    'layout' => '<div class="d-flex flex-wrap"> {items} </div>{pager}',
    'itemOptions' => [
        'tag' => false,
    ]
]) ?>
