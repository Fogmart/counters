<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UploadedfilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = $lang_arr['arc'];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadedfiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'whn',
            [
                'attribute'=>'Resume',
                'format' => 'raw',
                'class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
                'value' => function ($data) {
                    $url =  \yii\helpers\Url::home(true) . "loaded/".$data->name;
                    return Html::a('<i class="glyphicon glyphicon-download-alt"></i>', $url);
                },
            ],

        ],
    ]); ?>


</div>
