<?php

namespace common\models;

use Imagine\Image\Box;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $avatar_pic
 * @property int|null $created_at
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $avatarPic;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['has_avatar'], 'string', 'max' => 512],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'has_avatar' => 'Has Avatar Pic',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $this->user_id = Yii::$app->user->id;
        $this->created_at = time();
        $this->has_avatar = 1;
        $saved = parent::save($runValidation, $attributeNames);

        $avatarPath = Yii::getAlias('@frontend/web/storage/avatars/' . $this->user_id . '.jpg');
        if (!is_dir(dirname($avatarPath)))
            FileHelper::createDirectory(dirname($avatarPath), '0755', true);
        $this->avatarPic->saveAs($avatarPath);
        Image::getImagine()
            ->open($avatarPath)
            ->thumbnail(new Box(1280, 1280))
            ->save();

        if (!$saved)
            return false;

        return true;
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $avatarPath = Yii::getAlias('@frontend/web/storage/avatars/' . Yii::$app->user->id . '.jpg');
        unlink($avatarPath);
    }

    public function getAvatarLink($id)
    {
        return Yii::$app->params['frontendUrl'] . 'storage/avatars/' . $id . '.jpg';
    }
}
