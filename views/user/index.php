<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$lang_arr = Yii::$app->params['lang'][Yii::$app->language];

$this->title = $lang_arr['usr'];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a($lang_arr['addusr'], ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'addrStr',
            'lname',
            'fname',
//            'mname',
            'company',
            //'role',
            //'homepageid',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}'
            ],
        ],
    ]); ?>


</div>
