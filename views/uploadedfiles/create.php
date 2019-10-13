<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Uploadedfiles */

$this->title = 'Create Uploadedfiles';
$this->params['breadcrumbs'][] = ['label' => 'Uploadedfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadedfiles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
