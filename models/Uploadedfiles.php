<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uploadedfiles".
 *
 * @property int $id
 * @property string $name
 * @property string $whn
 */
class Uploadedfiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $file;

    public static function tableName()
    {
        return 'uploadedfiles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'safe'],
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
            'whn' => 'Whn',
        ];
    }
}
