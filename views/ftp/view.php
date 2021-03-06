<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ftp */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = $model->ip;
$this->params['breadcrumbs'][] = ['label' => 'FTP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ftp-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($lang_arr['edit'], ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a($lang_arr['del'], ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ip',
            'user_name',
            'user_pass',
            'active',
        ],
    ]) ?>

</div>
