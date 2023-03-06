<?php

use app\models\Discount;
use app\models\Nft;
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;
// <?php echo $this->render('_search', ['model' => $searchModel]);
/** @var yii\web\View $this */
/** @var app\models\MarketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Nfts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="my-market-index">

    <?php echo !Yii::$app->user->isGuest ? "<div style='margin-bottom: 2rem;'>
        <a href='/market/create' class='btn btn-secondary'>".Yii::t('app', 'Create NFT')."</a>
    </div>" : "" ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'my-item'],
        'pager' => [
            'class' => LinkPager::class,
        ],
        'itemView' => function ($model, $key, $index, $widget) {
            $discount = Discount::getUserDiscount();
            $price = $model["price"] * (100 - $discount) / 100;
            return (
                "<div class='nft-wrapper'>
                    <div class='nft-container'>
                        <div class='nft-image' style='background-image: url(../../images/nfts/{$model["image"]})'></div>
                        <div class='nft-content'>
                            <h3 class='nft-heading'>{$model["title"]}</h3>
                            <p class='nft-item-description'>{$model["description"]}</p>
                            <p class='nft-item-description'>".Yii::t("app", "Price")." <span class='amount'>{$price} RUB</span></p>
                            <a href='/market/view?id={$model['id']}'><button class='nft-btn-show-more' type='button'>".Yii::t("app", 'Show More')."</button></a>
                        </div>
                    </div>
                </div>"
            );
        },
        'layout' => "<div class='market-items-wrapper'>{items}</div>{pager}"
    ]) ?>
</div>
