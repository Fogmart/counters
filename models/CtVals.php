<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ct_vals".
 *
 * @property int $id
 * @property int $ctid
 * @property double $val
 * @property string $whn
 */
class CtVals extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_vals';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ctid', 'val', 'whn'], 'required'],
            [['ctid'], 'integer'],
            [['val'], 'number'],
            [['whn'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ctid' => 'Ctid',
            'val' => 'Val',
            'va2' => 'Val',
            'va3' => 'Val',
            'whn' => 'Whn',
        ];
    }

    public function check(){
        $v = CtVals::find()->where(["ctid"=>$this->ctid, 'whn'=>$this->whn, "val"=>$this->val])->one();
        if (!$v) $this->save();
    }
}
