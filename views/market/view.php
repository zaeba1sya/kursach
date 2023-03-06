<?php

use app\models\Discount;
use app\models\Profile;
use yii\helpers\Html;
use app\models\User;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Nft $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nfts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nft-view">

    <div class="nft-view-wrapper">
        <img style="width: 30rem; height: 30rem; border-radius: 15px;" src="../../web/images/nfts/<?php echo $model->image ?>" alt="">
        <div class="view-content-wrapper">
            <div class="view-content-container">
                <h1 class="nft-view-text"><?= Html::encode($this->title) ?></h1>
                <p class="nft-view-about"><?php echo Yii::t('app', 'Description') ?>: <?php echo $model->description ?></p>
                <p class="nft-view-owner"><?php echo Yii::t('app', 'Owner') ?>: <?php echo Profile::findOne(["userId" => $model->ownerId])->username ?></p>
            </div>
            <div class="view-buy-content">
                <p class="view-amount"><?php echo Yii::t('app', 'Amount') ?>: <?php echo $model->amount ?> <?php echo Yii::t('app', 'items') ?></p>
                <p class="view-price"><?php echo Yii::t('app', 'Price') ?>: <?php echo $model["price"] * (100 - Discount::getUserDiscount()) / 100 ?> RUB</p>
                <a href="/market/buy?id=<?= $model->id ?>"><button class="view-buy-button"><?php echo Yii::t('app', 'Buy NFT') ?></button></a>
            </div>
        </div>
    </div>
    

</div>
