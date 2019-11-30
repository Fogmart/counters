<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'arr_adrs')->widget(\kartik\select2\Select2::classname(), [
        'data' =>
            \yii\helpers\ArrayHelper::map(\app\models\Addr::slctLst(), 'id', 'name'),
        'language' => 'ru',
        'options' => ['placeholder' => 'Выбрать адрес', 'multiple'=> true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton($lang_arr['save'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
