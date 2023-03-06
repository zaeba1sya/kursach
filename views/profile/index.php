<?php

use app\models\Discount;
use app\models\Language;
use app\models\Nft;
use app\models\Purchases;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\Profile $profile */

$this->title = Yii::t('app', 'Purchases');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="purchases-index">

<div class="profile-view-wrapper">
        <div class="user-avatar" style="background-image: url('../../web/images/avatars/<?= $profile->avatar ?? 'default.jpg' ?>');"></div>
        <div class="view-content-wrapper">
            <div class="view-content-container">
                <h1 class="nft-view-text"><?= Html::encode($profile->username) ?></h1>
                <p class="nft-view-about"><?= Yii::t('app', 'Wallet') ?>: <?php echo $profile->wallet ?></p>
                <p class="nft-view-about"><?= Yii::t('app', 'Balance') ?>: <?php echo $balance ?> RUB</p>
            </div>
            <div class="view-buy-content">
                <a href="<?= $profile->website ?>"><p class="view-amount"><?= Yii::t('app', 'My Website') ?></p></a>
                <p class="view-price"><?= Yii::t('app', 'Language') ?>: <?= Language::findOne(['id' => $profile->languageId])->language ?></p>
                <p class="view-price"><?= Yii::t('app', 'Referal Code') ?>: <?= Discount::getUserCode(Yii::$app->user->id) ?></p>
            </div>
            <div>
                <a href="/profile/updateprofile" class="btn btn-secondary"><?= Yii::t("app", "Update Profile") ?></a>
            </div>
        </div>
    </div>

    <h1 class="nft-view-text"><?= Yii::t("app", 'My Showcase') ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'my-item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $nft = Nft::findOne(["id" => $model->nftId]);
            return "<div class='nft-wrapper-profile'>
            <div class='nft-container'>
                <div class='nft-image' style='background-image: url(../../images/nfts/{$nft["image"]})'></div>
                <div class='nft-content'>
                    <h3 class='nft-heading'>{$nft["title"]}</h3>
                    <p class='nft-item-description'>{$nft["description"]}</p>
                </div>
            </div>
        </div>";
        },
        'layout' => "<div class='profile-items-wrapper'>{items}</div>{pager}"
    ]) ?>


</div>
