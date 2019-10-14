<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usr_cntr".
 *
 * @property int $id
 * @property int $usrid
 * @property int $cntrid
 * @property int $type
 * @property int $cnfrmed
 * @property string $num
 */
class UsrCntr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usr_cntr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usrid'], 'required'],
            [['usrid', 'cntrid', 'type','cnfrmed'], 'integer'],
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
            'usrid' => 'Usrid',
            'cntrid' => 'Cntrid',
            'num' => 'num',
            'type' => 'type',
        ];
    }

    public function confirm(){
        $this->cntrid = Counter::getCounterID($this->num, $this->type);
        $this->cnfrmed = 1;
        $this->save();
    }
}
