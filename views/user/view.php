<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if (!Yii::$app->authManager->checkAccess($model->id, 'admin')){?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'lname',
            'fname',
            'mname',
            'company',
        ],
    ]) ?>

    <div id="counters" style="margin-top: 50px">
        <?php
        foreach ($model->addr as $c) {?>
            <div>

            </div>

        <?} ?>
    </div>

</div>

<script>
    function add() {
        $.post('/usr-cntr/add',
            {
                "usrid":<?=$model->id?>,
                "num": $("[name=num]").val(),
                "type": $("[name=type]").val()
            },
            function( data ) {
                document.location.reload()
            });
    }

</script>