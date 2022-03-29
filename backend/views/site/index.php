<?php

/** @var yii\web\View $this */
/** @var  $latestVideo \common\models\Video */
/** @var  $numberOfViews integer */
/** @var  $numberOfSubscribers integer */
/** @var  $subscribers \common\models\Subscriber[] */

$this->title = 'My Yii Application';
?>
<div class="d-flex">
    <div class="card m-2" style="width: 14rem;">
        <?php if ($latestVideo) : ?>
        <div class="ratio ratio-16x9 mb-3">
            <video src="<?= $latestVideo->getVideoLink() ?>" title="YouTubeClone video"
                   poster="<?= $latestVideo->getThumbnailLink() ?>"></video>
        </div>
        <div class="card-body">
            <h6 class="card-title"><?= $latestVideo->title ?></h6>
            <p class="card-text">
                Likes : <?= $latestVideo->getLikes()->count() ?><br>
                Views : <?= $latestVideo->getViews()->count() ?>
            </p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        <?php else: ?>
        <div class="card-body">
            <?= "You don`t have anything uploaded" ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Views</h6>
            <p class="card-text" style="font-size:48px">
                <?= $numberOfViews ?>
            </p>
        </div>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Total Subscribers</h6>
            <p class="card-text" style="font-size:48px">
                <?= $numberOfSubscribers ?>
            </p>
        </div>
    </div>
    <div class="card m-2" style="width: 14rem;">
        <div class="card-body">
            <h6 class="card-title">Latest Subscribers</h6>
            <p class="card-text">
                <?php foreach ($subscribers as $subscriber): ?>
            <div>
                <?= $subscriber->user->username ?>
            </div>
            <?php endforeach; ?>
            </p>
        </div>
    </div>
</div>
