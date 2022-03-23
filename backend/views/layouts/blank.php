<?php

/** @var yii\web\View $this */
/** @var string $content */

$this->beginContent('@backend/views/layouts/base.php');
?>

    <main>
        <div class="m-2">
            <?= $content ?>
        </div>
    </main>

<?php $this->endContent();