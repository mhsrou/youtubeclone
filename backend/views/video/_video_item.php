<?php
/** @var $model \common\models\Video */

use yii\helpers\StringHelper;

?>
<div class="d-flex">
    <div class="flex-shrink-0">
        <img src="..." alt="...">
    </div>
    <div class="flex-grow-1 ms-3">
        <h6><?= $model->title ?></h6>
        <?= StringHelper::truncateWords($model->description,10) ?>
         </div>
</div>
