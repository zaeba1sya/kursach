<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Nft $model */

$this->title = Yii::t('app', 'Create NFT');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nfts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nft-create">

    <h1 style="margin-left: 15%;color: white;"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'uploadImage' => $uploadImage
    ]) ?>

</div>
