<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highstock;
use miloschuman\highcharts\SeriesDataHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Counter */

$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Counters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
date_default_timezone_set('UTC');
?>
<div class="counter-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <p>Номер: <?=$model->num?></p>
    <p>Тип: <?=$model->typeN->name?></p>


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
                    'data' => new SeriesDataHelper($model->vals, ['whn:timestamp', 'val:float']),
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
        <tr >
            <th>#</th>
            <th>Дата</th>
            <th>Значение</th>
        </tr >
        <?php foreach ($model->vals as $i=>$v) {?>
            <tr >
                <td><?=$i+1?></td>
                <td><?=date (  'd.m.Y', $v->whn  ) ?></td>
                <td class="r"><?=$v->val?></td>
            </tr >
        <?php } ?>
    </table >
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
