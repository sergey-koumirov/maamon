<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\ApiKey;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Maamon <?= $_SERVER['SERVER_NAME'] ?></title>
    <?php $this->head() ?>
    <script src="js/main.js"></script>
    <script src="js/highcharts.js"></script>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);?>
    
    <?php if (!Yii::$app->user->isGuest) {?>
    <div class="col-md-3 api-selector" data-change-url="<?= Url::to(['users/change-api-key']) ?>">
        <select class="form-control">
            <option value="">---</option>
            <?php foreach(ApiKey::find()->all() as $api){ ?>
            <option value="<?= $api->id ?>" <?= $api->id == Yii::$app->user->getIdentity()->api_key_id ? 'selected' : '' ?> ><?= $api->name ?></option>
            <?php } ?>
        </select>
    </div>
    <?php } ?>
    
    
    <?php if (Yii::$app->user->isGuest) {?>
    
        <?php echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Login', 'url' => ['/site/login']]
            ],
        ]);
        NavBar::end();
        ?>
    
    <?php } else { ?>
        <?php echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Wallets', 'url' => ['/wallets/index']],
                ['label' => 'Transactions', 'url' => ['/w-transactions/index']],
                ['label' => 'API Keys', 'url' => ['/api-keys/index']],
                ['label' => 'Users', 'url' => ['/users/index']],
                (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>
    <?php } ?>
    

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
