<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\SeriesDataHelper;
use yii\widgets\ActiveForm;
use \kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Counter */

$this->title = $model->typeN->name;
$this->params['breadcrumbs'][] = ['label' => 'Счетчики', 'url' => ['user/home']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
date_default_timezone_set('UTC');
?>
<div class="counter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Номер: <?=$model->num?></p>
    <p>Тип: <?=$model->typeN->name?></p>

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-10">
        <?

        echo  DatePicker::widget([
            'name' => 'begdt',
            'value' => date('d.m.Y', $model->begdt),
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'enddt',
            'separator'=>'до',
            'value2' => date('d.m.Y', $model->enddt),
            'pluginOptions' => [
                'format' => 'dd.m.yyyy',
                'todayHighlight' => true,
                'autoclose'=>true,
            ]
        ]);
        ?>
        </div>
        <div class="col-md-2">
            <?= Html::submitButton('OK', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $vals = $model->getValsByPeriod();
    if ($vals) {
        ?>

    <?= Highstock::widget([
        'setupOptions' => [
            'lang' => [
                'loading'=> 'Загрузка...',
                'months'=> ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                'weekdays'=> ["Воскресенье", "Понедельник", 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
                'shortMonths'=> ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь', 'Июль', 'Авг', 'Сент', 'Окт', 'Нояб', 'Дек'],
                'exportButtonTitle'=> "Экспорт",
                'printButtonTitle'=> "Печать",
                'rangeSelectorFrom'=> 'С',
                'rangeSelectorTo'=> "По",
                'rangeSelectorZoom'=> "Период",
                'downloadPNG'=> 'Скачать PNG',
                'downloadJPEG'=> 'Скачать JPEG',
                'downloadPDF'=> 'Скачать PDF',
                'downloadSVG'=> 'Скачать SVG',
                'printChart'=> 'Напечатать график'
            ],
        ],

        'options' => [
            'rangeSelector'=>[
                'buttons'=>[],
                'inputEnabled'=>false,
                'enabled'=>false
            ],
            'navigator'=>[
              'enabled'=>false
            ],
            'credits'=>[
                'enabled'=>false
            ],
            'title' => ['text' => 'Показания'],
            'xAxis' => [
                'type'=> 'date',
                'crosshair' => true,
                'ordinal'=> false,
                'title' => [
                    'text' => 'Дата'
                ]
            ],
            'yAxis' => [
                'title' => ['text' => 'Значение']
            ],
            'series' => [
                [
                    'type' => 'areaspline',
                    'name' => 'Результат',
                    'data' => new SeriesDataHelper($vals, ['whn:timestamp', 'val:float']),
                    'yAxis' => 0,
                    'marker' => [
                        'enabled'=> true,
                        'radius'=> 3,
                        'states'=>['hover'=>['radius'=>2]],
                    ],
                    'dataLabels'=> [
                        'enabled'=>true,
                    ],
                ],
            ],
        ]
    ]);?>



        <h2>Показания</h2>
        <table >
            <?php foreach ($vals as $i=>$v) {
                if ($i==0) {
                    $begval = $v->val;
                    ?>
                    <tr >
                        <th>#</th>
                        <th>Дата</th>
                        <th>Значение</th>
                        <?php if ($model->typeN->id == 4) {
                            $begval2 = $v->val2;
                            ?>
                            <th >День</th>
                        <?php } ?>
                        <?php if ($model->typeN->id == 4) {
                            $begval3 = $v->val3;
                            ?>
                            <th >Ночь</th>
                        <?php } ?>
                    </tr >
                <?php } ?>
                <tr >
                    <td><?=$i+1?></td>
                    <td><?=date (  'd.m.Y', $v->whn  ) ?></td>
                    <td class="r"><?=$v->val?></td>
                    <?php if ($model->typeN->id == 4) {?>
                        <td class="r"><?=$v->val2?></td>
                    <?php } ?>
                    <?php if ($model->typeN->id == 4) {?>
                        <td class="r"><?=$v->val3?></td>
                    <?php } ?>
                </tr >
            <?php } ?>
        </table >
        На начало: <b><?=$begval?></b>
        <?php if ($model->typeN->id == 4) {?>
            (<?=$begval2?>/<?=$begval3?>)
        <?php } ?>
        На конец: <b><?=$v->val?></b>
        <?php if ($model->typeN->id == 4) {?>
            (<?=$v->val2?>/<?=$v->val3?>)
        <?php } ?>
        Расход : <b><?=$v->val-$begval?></b>
        <?php if ($model->typeN->id == 4) {?>
            (<?=$v->val2-$begval2?>/<?=$v->val3-$begval3?>)
        <?php } ?>
    <?php } ?>
</div>

<style>
    td, th {
        border: 1px solid black;
        padding: 5px;
    }
    th{
        text-align: center;
    }
    .r {
        text-align: right;
    }
</style>
