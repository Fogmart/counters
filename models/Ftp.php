<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ftp".
 *
 * @property int $id
 * @property string $ip
 * @property string $user_name
 * @property int $user_pass
 * @property int $active
 */
class Ftp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ftp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'user_name', 'user_pass'], 'required'],
            [['active'], 'integer'],
            [['ip'], 'string', 'max' => 20],
            [['user_name','user_pass'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Адрес',
            'user_name' => 'Пользователь',
            'user_pass' => 'Пароль',
            'active' => 'в работе',
        ];
    }

    public static function getLst(){
        return self::find()->where(['active'=>1])->all();
    }
}