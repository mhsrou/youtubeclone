<?php
/**
 *Author : Mohsen Roustapour
 *Date : 3/26/2022
 *Time : 3:24 PM
 */

namespace common\helpers;

use yii\helpers\Url;

class Html
{
    public static function channelLink($user, $schema = false)
    {
        return \yii\helpers\Html::a($user->username,
            Url::to(['/channel/view', 'username' => $user->username], $schema),
            ['class' => 'text-black-50']);
    }
}