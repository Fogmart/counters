<?php

namespace app\models;

use http\Url;
use Yii;

/**
 * This is the model class for table "ct_types".
 *
 * @property int $id
 * @property string $name
 * @property string $code
 */
class CtTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ct_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name'], 'string', 'max' => 20],
            [['code'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
        ];
    }

    public static function getTypeID( $type ){
        $id = "";
        foreach (CtTypes::find()->all() as $one){
            if (strpos($type, $one->code) !== false){
                $id = $one->id;
                break;
            }
        }
        return $id;

    }

    public function getImage(){
        return ($this->imgurl) ? \yii\helpers\Url::home(true)."/img/".$this->imgurl : "";
    }
}
