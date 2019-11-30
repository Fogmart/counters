<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FtpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$lang_arr = Yii::$app->params['lang'][Yii::$app->language];
$this->title = 'FTP';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ftp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($lang_arr['addftp'], ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ip',
            'user_name',
            'user_pass',
            'active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
