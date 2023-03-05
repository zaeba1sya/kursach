<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-site-about">
    <div class="container-about">
        <div class="dev-container-wrapper">
            <div class="dev-one"></div>
            <p class="heading-dev"><?php echo Yii::t("app", "Manager") ?></p>
            <p class="name-dev">Daniil "GodManager221"</p>
        </div>
        <div class="dev-container-wrapper">
            <div class="dev-two"></div>
            <p class="heading-dev"><?php echo Yii::t("app", "Designer") ?></p>
            <p class="name-dev">Daniil "d2Disgner"</p>
        </div>
        <div class="dev-container-wrapper">
            <div class="dev-three"></div>
            <p class="heading-dev"><?php echo Yii::t("app", "Developer") ?></p>
            <p class="name-dev">Daniil "dev@Man77"</p>
        </div>
    </div>
</div>
