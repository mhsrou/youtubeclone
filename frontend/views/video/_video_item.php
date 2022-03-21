<?php
/** @var $model \common\models\Video */
?>

<div class="card m-3" style="width: 14rem;">
    <div class="ratio ratio-16x9">
        <video src="<?= $model->getVideoLink() ?>" title="YouTubeClone video"
               poster="<?= $model->getThumbnailLink() ?>"
        ></video>
    </div>
    <div class="card-body p-2">
        <h6 class="card-title m-0"><?= $model->title ?></h6>
        <p class="text-muted card-text m-0"><?= $model->createdBy->username ?></p>
        <p class="text-muted card-text m-0">140 views . <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?></p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>
