<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ftp */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = $lang_arr['addftp'];
$this->params['breadcrumbs'][] = ['label' => 'Ftps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ftp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
