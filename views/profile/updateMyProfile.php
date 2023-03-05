<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = Yii::t('app', 'Update Profile: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formProfile', [
        'model' => $model,
        "uploadAvatar" => $uploadAvatar,
        "languages" => $languages
    ]) ?>

</div>
