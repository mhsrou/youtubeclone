
<aside class="shadow">
    <?php echo \yii\bootstrap5\Nav::widget([
        'options' => [
            'class' => 'd-flex flex-column nav-pills'
        ],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => '<i class="fa-solid fa-gauge-high"></i> Dashboard',
                'url' => ['/site/index']
            ],
            [
                'label' => '<i class="fas fa-video"></i> Videos',
                'url' => ['/video/index']
            ],
            [
                'label' => '<i class="fa-solid fa-comment"></i> Comments',
                'url' => ['/comment/index']
            ]
        ]
    ]) ?>
</aside>
