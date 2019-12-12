<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$lang_arr = Yii::$app->params['lang'][Yii::$app->language];

$this->title = $lang_arr['addusr'];

$this->params['breadcrumbs'][] = ['label' => $lang_arr['usr'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
