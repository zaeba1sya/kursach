<?php

use yii\bootstrap5\ActiveField;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Nft $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nft-form">

    <?php $form = ActiveForm::begin(["options" => ["class" => "nft-creation-form", 'enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($uploadImage, 'imageFile')->fileInput(["class" => "form-control"])->label(Yii::t("app", "Image")) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
