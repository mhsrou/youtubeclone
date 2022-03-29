<?php
/** @var $dataProvider ActiveDataProvider */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'pager' =>[
        'class'=> \yii\bootstrap5\LinkPager::class,
    ],
    'itemView' => '_video_item',
    'layout'=>'<div class="d-flex flex-wrap"> {items} </div>{pager}',
    'itemOptions' => [
        'tag' =>false,
    ]
]) ?>
