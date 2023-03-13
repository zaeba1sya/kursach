<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MarketSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nft-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'title')->label(Yii::t("app", "Search by Name")) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', Yii::t("app", 'Search')), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), "/market", ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
