<?php

namespace frontend\controllers;

use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class VideoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'like' => ['post'],
                    'dislike' => ['post'],
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->with('createdBy')->published()->latest(),
            'pagination' => [
                'pageSize' => 5,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($video_id)
    {
        $this->layout = 'blank';
        $video = $this->findVideo($video_id);

        $videoView = new VideoView();
        $videoView->video_id = $video_id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = Video::find()
            ->published()
            ->byKeyword($video->title)
            ->andWhere(['NOT', ['video_id' => $video_id]])
            ->limit(10)
            ->all();

        return $this->render('view', [
            'model' => $video,
            'similarVideos' => $similarVideos,
        ]);
    }

    public function actionLike($video_id)
    {
        $video = $this->findVideo($video_id);
        $user_id = Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()->userIdVideoId($user_id, $video_id)->one();

        if (!$videoLikeDislike)
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_LIKE);
        elseif ($videoLikeDislike->type == VideoLike::TYPE_LIKE)
            $videoLikeDislike->delete();
        else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_LIKE);
        }

        return $this->renderAjax('_buttons', ['model' => $video]);
    }

    public function actionDislike($video_id)
    {
        $video = $this->findVideo($video_id);
        $user_id = Yii::$app->user->id;

        $videoLikeDislike = VideoLike::find()->userIdVideoId($user_id, $video_id)->one();

        if (!$videoLikeDislike)
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_DISLIKE);
        elseif ($videoLikeDislike->type == VideoLike::TYPE_DISLIKE)
            $videoLikeDislike->delete();
        else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($video_id, $user_id, VideoLike::TYPE_DISLIKE);
        }

        return $this->renderAjax('_buttons', ['model' => $video]);
    }

    public function actionSearch($keyword)
    {
        $this->layout = 'main';
        $query = Video::find()
            ->published()
            ->latest();
        if ($keyword)
            $query->byKeyword($keyword);

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('search', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionHistory()
    {
        $this->layout = 'main';
        $query = Video::find()
            ->alias('v')
            ->innerJoin("(SELECT video_id, MAX(created_at) as max_date FROM video_view
            WHERE user_id = :userId
            GROUP BY video_id) vv", 'vv.video_id = v.video_id',
                ['userId' => Yii::$app->user->id
                ])
            ->OrderBy('vv.max_date DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('history', [
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findVideo($video_id)
    {
        $video = Video::findOne($video_id);
        if (!$video)
            throw new NotFoundHttpException('The video does not exist');
        return $video;
    }

    protected function saveLikeDislike($video_id, $user_id, $type)
    {
        $videoLike = new VideoLike();
        $videoLike->video_id = $video_id;
        $videoLike->user_id = $user_id;
        $videoLike->type = $type;
        $videoLike->created_at = time();
        $videoLike->save();
    }
}