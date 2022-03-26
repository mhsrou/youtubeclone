<?php

/** @var $model \common\models\Video */

use yii\helpers\Html;
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
            <p><?= Html::a($model->createdBy->username,[
                    '/channel/view','username'=>$model->createdBy->username,
                ]) ?></p>
            <p><?= \yii\helpers\Html::encode($model->description) ?></p>
        </div>
    </div>
    <div class="col-sm-4">

    </div>
</div>
