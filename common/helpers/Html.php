<?php
/**
 *Author : Mohsen Roustapour
 *Date : 3/26/2022
 *Time : 3:24 PM
 */

namespace common\helpers;

class Html
{
    public static function channelLink($user)
    {
        return \yii\helpers\Html::a($user->username, [
            '/channel/view', 'username' => $user->username],
            ['class' => 'text-black-50']);
    }
}