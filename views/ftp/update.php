<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ftp */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = $model->ip;
$this->params['breadcrumbs'][] = ['label' => 'Ftps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ftp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
