<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">

    <div class="login-reg-wrapper">
        <div class="login-reg-form">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to registration:</p>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                "enableAjaxValidation" => true
            ]); ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'login')->textInput() ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                <?= $form->field($model, 'friend_code')->textInput() ?>

                <?= $form->field($model, 'rules')->checkbox([
                    'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>

                <div class="form-group">
                    <div class="offset-lg-1 col-lg-11">
                        <?= Html::submitButton('Sign Up', ['class' => 'btn btn-secondary', 'name' => 'login-button']) ?>
                    </div>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="login-reg-sidebar"></div>
    </div>

</div>
