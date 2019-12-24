<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counters".
 *
 * @property int $id
 * @property int $type
 * @property int $addrid
 * @property string $num
 */
class Counter extends \yii\db\ActiveRecord
{
    public $begdt;
    public $enddt;
    public $addrName;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'counters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'num'], 'required'],
            [['type'], 'integer'],
            [['addrid'], 'integer'],
            [['active'], 'integer'],
            [['num'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {

        $lang = Yii::$app->user->identity->lang;

        if ($lang == 'ru')
            return [
                'id' => 'ID',
                'typeN' => 'Тип',
                'num' => 'Номер',
                'active' => 'В работе',
                'adress' => 'Адрес',
                'addrName' => 'Адрес',
            ];

        if ($lang == 'en')
            return [
                'id' => 'ID',
                'typeN' => 'Type',
                'num' => 'Number',
                'active' => 'Active',
                'adress' => 'Adress',
                'addrName' => 'Adress',
            ];

        if ($lang == 'et')
            return [
                'id' => 'ID',
                'typeN' => 'tüüp',
                'num' => 'number',
                'active' => 'töös',
                'adress' => 'aadress',
                'addrName' => 'aadress',
            ];

    }

    public static function getCounterID( $num, $tid, $addrid){
        $c = Counter::find()->where(["num"=>$num, "type"=> $tid, 'addrid'=>$addrid])->one();
        if ($c){
            $id = $c->id;
        }else{
            if (($num == "0")  || (strlen($num ) > 8) ) return null;
            $c = new Counter();
            $c->num = $num;
            $c->type = $tid;
            $c->addrid = $addrid;
            $c->save(false);
            $id = $c->id;
        }
        return $id;
    }

    public function getVals(){
        return $this->hasMany(CtVals::className(), ['ctid'=>'id'])->orderBy("whn");
    }

    public function getTypeN(){
        return $this->hasOne(CtTypes::className(), ['id'=>'type']);
    }
    public function getAdress(){
        return $this->hasOne(Addr::className(), ['id'=>'addrid']);
    }


    public function getValsByPeriod(){
        return CtVals::find()->where(["ctid"=>$this->id])
            ->andWhere(['>=', "whn", $this->begdt])
            ->andWhere(['<=', "whn", $this->enddt]) ->all();
    }
}
