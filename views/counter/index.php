<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CounterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Счетчики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="counter-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'num',
            [
                'attribute' => 'typeN',
                'format' => 'raw',
                'value' => function($model) { return $model->typeN->name; },
            ],
            [
                'attribute' => 'typeN',
                'format' => 'raw',
                'value' => function($model) { return $model->typeN->name; },
            ],
            [
                'attribute' => 'adress',
                'format' => 'raw',
                'value' => function($model) { return $model->adress->address. "  ". $model->adress->apartment; },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}'
            ],
        ],
    ]); ?>


</div>
