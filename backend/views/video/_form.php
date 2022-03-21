<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\video */
/* @var $form yii\bootstrap5\ActiveForm */

\backend\assets\TagsInputAsset::register($this);
?>

<div class="video-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <?= $form->errorSummary($model) ?>

    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <label><?= $model->getAttributeLabel('thumbnail') ?></label>
                <div class="input-group">
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                    <label class="input-group-text" for="thumbnail">Choose thumbnail file</label>
                </div>
            </div>

            <?= $form->field($model, 'tags', [
                'inputOptions' => ['data-role' => 'tagsinput']
            ])->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-4">

            <div class="ratio ratio-16x9 mb-3">
                <video src="<?= $model->getVideoLink() ?>" title="YouTubeClone video"
                       poster="<?= $model->getThumbnailLink() ?>"
                       controls></video>
            </div>

            <div class="mb-3">
                <div class="text-muted">Video Link</div>
                <a href="<?= $model->getVideoLink() ?>">
                    Open Video
                </a>
            </div>

            <div class="mb-3">
                <div class="text-muted">Video Name</div>
                <?= $model->video_name ?>
            </div>

            <?= $form->field($model, 'status')->dropdownList($model->getStatusLabel()) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
