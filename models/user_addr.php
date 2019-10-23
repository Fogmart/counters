<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_addr".
 *
 * @property int $id
 * @property int $userid
 * @property int $addrid
 */
class user_addr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_addr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'addrid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'addrid' => 'Addrid',
        ];
    }
}
