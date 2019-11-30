<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = $lang_arr['ctradd'];
$this->params['breadcrumbs'][] = ['label' => $lang_arr['ctr'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
