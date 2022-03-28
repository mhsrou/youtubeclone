<?php

/** @var $model \common\models\Video */

/** @var $similarVideos \common\models\Video[] */

use common\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<div class="row">
    <div class="col-sm-8">
        <div class="ratio ratio-16x9">
            <video src="<?= $model->getVideoLink() ?>" title="YouTubeClone video"
                   poster="<?= $model->getThumbnailLink() ?>"
                   controls></video>
        </div>
        <h6 class="mt-2"><?= $model->title ?></h6>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?= $model->getViews()->count() ?>
                views • <?= Yii::$app->formatter->asDate($model->created_at) ?>
            </div>
            <div>
                <?php Pjax::begin() ?>
                <?= $this->render('_buttons', ['model' => $model]) ?>
                <?php Pjax::end() ?>
            </div>
        </div>
        <div>
            <p><?= Html::channelLink($model->createdBy) ?></p>
            <p><?= \yii\helpers\Html::encode($model->description) ?></p>
        </div>
    </div>
    <div class="col-sm-4">
        <?php foreach ($similarVideos as $similarVideo) : ?>
            <!-- Media object -->
            <div class="d-flex mb-2">
                <!-- Image -->
                <a href="<?= Url::to(['/video/view', 'video_id' => $similarVideo->video_id]) ?>">
                    <div class="ratio ratio-16x9" style="width:120px">
                        <video src="<?= $similarVideo->getVideoLink() ?>" title="YouTubeClone video"
                               poster="<?= $similarVideo->getThumbnailLink() ?>"></video>
                    </div>
                </a>
                <!-- Body -->
                <div class="ms-2">
                    <h6>
                        <div class="fw-bold">
                            <?= $similarVideo->title ?>
                        </div>
                        <small class="text-muted">
                            <p class="m-0">
                                <?= Html::channelLink($similarVideo->createdBy, true) ?>
                            </p>
                            <p>
                                <?= $similarVideo->getViews()->count() ?> views •
                                <?= Yii::$app->formatter->asRelativeTime($similarVideo->created_at) ?>
                            </p>
                        </small>
                    </h6>
                </div>
            </div>
            <!-- Media object -->
        <?php endforeach; ?>
    </div>
</div>
