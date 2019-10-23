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


    <?php ActiveForm::end(); ?>

    <h3>Счетчики</h3>

    <div id="counters" >
        <?php foreach ($model->addr as $addr) {?>
            <div>
                <?=$addr->address . ' / ' . $addr->apartment?>
                <?php foreach ($addr->counters as $c) {?>
                    <div>
                        <?=$c->num?> <?=$c->typeN->name?> <a href="/counter/view?id=<?=$c->id?>" target="_blank">...</a>
                    </div>
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