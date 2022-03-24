<?php
/** @var $model \common\models\Video */

use yii\helpers\Url; ?>
<a href="<?= Url::to(['/video/like', 'video_id' => $model->video_id]) ?>"
   class="btn btn-sm <?= $model->isLikedBy(Yii::$app->user->id) ? 'btn-outline-primary': 'btn-outline-secondary'?>"
   data-method="post" data-pjax="1">
    <i class="fa-solid fa-thumbs-up"></i><?= $model->getLikes()->count() ?>
</a>
<a href="<?= Url::to(['/video/like', 'video_id' => $model->video_id]) ?>"
   class="btn btn-sm <?= $model->isDislikedBy(Yii::$app->user->id) ? 'btn-outline-primary': 'btn-outline-secondary'?>"
   data-method="post" data-pjax="1">
    <i class="fa-solid fa-thumbs-down"></i><?= $model->getDislikes()->count() ?>
</a>
