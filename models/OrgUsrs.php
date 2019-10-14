<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "org_usrs".
 *
 * @property int $id
 * @property int $orgid
 * @property int $usrid
 * @property int $isadmin
 */
class OrgUsrs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'org_usrs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orgid', 'usrid'], 'required'],
            [['orgid', 'usrid', 'isadmin'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orgid' => 'Orgid',
            'usrid' => 'Usrid',
            'isadmin' => 'Isadmin',
        ];
    }
}
