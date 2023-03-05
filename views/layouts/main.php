<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use app\models\Profile;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
$this->registerLinkTag(['rel' => "stylesheet", 'href' => "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title>NFT | Market</title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => "<img src='../../web/images/logo.png' />",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => Yii::t("app", "Home"), 'url' => ['/site/index'], "options" => ['class' => "my-nav-item my-mx"]],
            ['label' => Yii::t("app", "Market"), 'url' => ['/market'], "options" => ['class' => "my-nav-item my-mx"]],
            ['label' => Yii::t("app", "About"), 'url' => ['/site/about'], "options" => ['class' => "my-nav-item my-mx"]],
            !Yii::$app->user->isGuest && !Yii::$app->user->identity->isAdmin
                ? '<li class="nav-item my-nav-item my-nav-item my-left-m">
                <a class="nav-link btn btn-link logout" href="/profile">'.Yii::t("app", "Profile").'('
                .substr(Profile::getProfileData(Yii::$app->user->id)->wallet, 0, 5)
                ."..."
                .substr(Profile::getProfileData(Yii::$app->user->id)->wallet, 37, 5)
                .')</a></li>'
                : "",
            !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                ? ['label' => Yii::t("app", "Admin Panel"), 'url' => ['/admin'], "options" => ['class' => "my-nav-item my-left-m"]]
                : "",
            Yii::$app->user->isGuest
                ? ['label' => Yii::t("app", "Registration"), 'url' => ['/site/signup'], "options" => ['class' => "my-nav-item my-left-m"]]
                : '',
            Yii::$app->user->isGuest
                ? ['label' => Yii::t("app", "Sign In"), 'url' => ['/site/login'], "options" => ['class' => "my-nav-item"]]
                : '<li class="nav-item my-nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        Yii::t("app", "Logout"),
                        ['class' => 'nav-link btn btn-link logout my-nav-item']
                    )
                    . Html::endForm()
                    . '</li>'
        ]
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="my-container">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light my-footer">
    <div class="container">
        <div>
            <div class="text-center" style="font-size: 18px; color: #a3a3a3;"><?= date('Y') ?>. NFT | Market. All right Resolved</div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
