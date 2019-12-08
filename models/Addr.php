<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "addrs".
 *
 * @property int $id
 * @property string $address
 * @property string $apartment
 */
class Addr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addrs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'max' => 100],
            [['apartment'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'apartment' => 'Apartment',
        ];
    }

    public static function getAddrID( $addr, $appartment ){
        $c = Addr::find()->where(["address"=>$addr, "apartment"=> $appartment])->one();
        if ($c){
            $id = $c->id;
        }else{
            $c = new Addr();
            $c->address = $addr;
            $c->apartment = $appartment;
            $c->save();
            $id = $c->id;

        }
        $a = Addr::find()->where(["address"=>$addr, "apartment"=> null])->exists();
        if (!$a){
            $a = new Addr();
            $a->address = $addr;
            $a->save();
        }

        return $id;
    }

    public function getCounters(){
        if ($this->apartment){
            return $this->hasMany(Counter::className(),['addrid'=>'id'])->where('active = 1');
        } else {
            $res = [];
            foreach (Addr::find()->where(["address"=>$this->address])->all() as $addr){
                if ($addr->apartment) {
                    $res = array_merge($res, $addr->counters);
                }
            }
            return $res;
        }

    }

    public static function slctLst(){
        $lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : Yii::$app->user->identity->lang;

        $res = [];
        foreach (self::find()->orderBy('address')->all() as $one){
            $app = ($one->apartment) ? $one->apartment : Yii::$app->params['lang'][$lang]['allapartaments'];
            $res[] = ['id'=> $one->id, 'name'=> $one->address .' / ' . $app];
        }
        return $res;
    }

    public static function getApartments($addr){
        return self::find()->where(['address'=>$addr]) ->orderBy('apartment')->all();
    }


}
