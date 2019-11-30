<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];

$this->title = $lang_arr['edtusr'].  ': ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => $lang_arr['usr'], 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
