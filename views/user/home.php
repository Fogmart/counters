<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

    $lang_arr = Yii::$app->params['lang'][Yii::$app->language];
    $this->title = $lang_arr['home']
?>
<div class="user-form">
    <?php $form = ActiveForm::begin();?>
    <div class="row" style="margin-bottom: 30px">
        <div class="col-md-4">
            <?=$lang_arr['usrname']?>: <b><?=$model->username?></b>
        </div>
        <div class="col-md-4">
            Email: <b><?=$model->email?></b>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

    <h3><?=$lang_arr['ctr']?></h3>

    <div id="counters" >
        <?php foreach ($model->addr as $i=>$addr) {?>
            <div class="ctraddr">
                <div class="addr"> <?=$addr->address . ' / ' . $addr->apartment?> </div>
                <div class="ctrs">
                    <?php foreach ($addr->counters as $c) {?>
                        <div class="ctr">
                            <?=$c->num?>
                            <?php if ($c->typeN->image) {?>
                            <img src="<?=$c->typeN->image?>" class="ctimg">
                            <?php } ?>
                            <?=$c->typeN->namelang?> <a href="/counter/view?id=<?=$c->id?>" >...</a>
                        </div>
                    <?} ?>
                </div>
            </div>

        <?} ?>
    </div>

</div>
<script src="/js/jquery.js"></script>
<script>
    $(function () {
        $(".ctr").click( function () {
            window.open($("a", $(this)).attr("href"));
        })
        $(".ctraddr").click(function () {
            $(".ctrs", $(this)).slideToggle()
        })
        <?if ($i > 0) {?>
        $(".ctrs").hide()
        <?}?>
    })
</script>

<style>
    .ctimg {
        width: 50px;
    }

    .ctr {
        border: 1px solid;
        padding: 10px;

    }
    .ctr a {
        display: none;
    }

    .ctraddr{
        cursor: pointer;

    }
    .addr{
        font-weight: bold;
    }

</style>