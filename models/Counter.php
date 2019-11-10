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
            [['num'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'num' => 'Num',
        ];
    }

    public static function getCounterID( $num, $tid, $addrid){
        $c = Counter::find()->where(["num"=>$num, "type"=> $tid])->one();
        if ($c){
            $id = $c->id;
        }else{
            $c = new Counter();
            $c->num = $num;
            $c->type = $tid;
            $c->addrid = $addrid;
            $c->save();
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

    public function getValsByPeriod(){
        return CtVals::find()->where(["ctid"=>$this->id])
            ->andWhere(['>=', "whn", $this->begdt])
            ->andWhere(['<=', "whn", $this->enddt]) ->all();
    }
}
