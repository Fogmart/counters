<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
    $this->title = "Редактирование своей информации";
?>
<div class="user-form">
    <?php $form = ActiveForm::begin();?>
    <div class="row" style="margin-bottom: 30px">
        <div class="col-md-4">
            Имя пользователя: <b><?=$model->username?></b>
        </div>
        <div class="col-md-4">
            Email: <b><?=$model->email?></b>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'mname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <h3>Счетчики</h3>

    <?php \yii\bootstrap\Modal::begin([
        'id' => 'contact-modal',
        'header' => '<h3>Добавление счетчика</h3>',
        'closeButton' => ['tag' => 'button', 'label' => '&times;'],
        'toggleButton' => [
            'label' => 'Добавить',
            'data-target' => '#contact-modal',
            'class' => 'btn btn-success',
//            'href' => Url::toRoute(['add-contact', 'partyID'=> $model->id]),
        ],
        'clientOptions' => false,
    ]); ?>
        <?= Html::input('text','num','',
            ['class'=>'form-control']) ?>
        <?= Html::dropDownList('type', null,
            \yii\helpers\ArrayHelper::map(\app\models\CtTypes::find()->all(), "id", "name"),
            ['class'=>'form-control', 'prompt'=>'']
        )?>

        <?= Html::button("Добавить", [ 'class' => 'btn btn-primary', 'onclick' => 'add();' ])?>



    <?php \yii\bootstrap\Modal::end(); ?>

    <?php ActiveForm::end(); ?>

    <div id="counters" style="margin-top: 50px">
        <?php
        foreach ($model->usrCntrs as $c) {?>
            <div>
                <?if ($c->cntrid) {?>
                    <?=Html::a($c->num, \yii\helpers\Url::to('/counter/view?id='.$c->cntrid, true) )?>
                <?} else {?>
                    <?=$c->num?>
                <?} ?>
                <?if ( Yii::$app->user->can('admin') && $c->cnfrmed != 1) {?>

                    <?= Html::button("Подтвердить", [  'onclick' => 'cnfrm('.$c->id.');' ])?>
                <?} ?>

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

    function cnfrm( id ) {
        $.post('/usr-cntr/cnfrm',
            {
                "id": id
            },
            function( data ) {
                document.location.reload()
            });
    }
</script>