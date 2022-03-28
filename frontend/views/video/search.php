<?php
/** @var $dataProvider ActiveDataProvider */

use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>
<h1>Found videos</h1>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_video_item',
    'layout'=>'<div class="d-flex flex-wrap"> {items} </div>{pager}',
    'itemOptions' => [
        'tag' =>false,
    ]
]) ?>
