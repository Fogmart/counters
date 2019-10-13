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
            'whn' => 'Whn',
        ];
    }
}
