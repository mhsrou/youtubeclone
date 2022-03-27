<?php
/**
 *Author : Mohsen Roustapour
 *Date : 3/25/2022
 *Time : 10:11 AM
 */

namespace frontend\controllers;

use common\models\Profile;
use common\models\Subscriber;
use common\models\User;
use common\models\Video;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ChannelController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionView($username)
    {
        $channel = $this->findChannel($username);

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->creator($channel->id)->published(),
        ]);

        $profile = new Profile();
        $profile->avatarPic = UploadedFile::getInstanceByName('avatar');
        if (Yii::$app->request->isPost && $profile->avatarPic)
            $profile->save();

        return $this->render('view', [
            'channel' => $channel,
            'profile' => $profile,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSubscribe($username)
    {
        $channel = $this->findChannel($username);

        $userId = Yii::$app->user->id;
        $subscriber = $channel->isSubscribed($userId);

        if (!$subscriber) {
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = $userId;
            $subscriber->created_at = time();
            $subscriber->save();
            Yii::$app->mailer->compose([
                'html' => 'subscriber-html', 'text' => 'subscriber-text'
            ], [
                'channel' => $channel,
                'user' => Yii::$app->user->identity
            ])->setFrom(Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('You have a new subscriber')
                ->send();
        } else {
            $subscriber->delete();
        }

        return $this->renderAjax('_subscribe', [
            'channel' => $channel
        ]);
    }

    /**
     * @param $username
     * @return User
     * @throws NotFoundHttpException
     */
    public function findChannel($username)
    {
        $channel = User::findByUsername($username);
        if (!$channel)
            throw new NotFoundHttpException('channel does not exist');
        return $channel;
    }

}