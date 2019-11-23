<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="counter-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'active')->checkbox(["value"=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
