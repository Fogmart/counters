<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ftp */
/* @var $form yii\widgets\ActiveForm */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
?>

<div class="ftp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pass')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox(["value"=>1]) ?>

    <div class="form-group">
        <?= Html::submitButton($lang_arr['save'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
