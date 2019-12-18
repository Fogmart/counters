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
        $lang = Yii::$app->user->identity->lang;

        if ($lang == 'ru')
            return [
                'id' => 'ID',
                'ip' => 'Адрес',
                'user_name' => 'Пользователь',
                'user_pass' => 'Пароль',
                'active' => 'в работе',
            ];

        if ($lang == 'en')
            return [
                'id' => 'ID',
                'ip' => 'Adress',
                'user_name' => 'Username',
                'user_pass' => 'Password',
                'active' => 'Active',
            ];

        if ($lang == 'et')
            return [
                'id' => 'ID',
                'ip' => 'aadress',
                'user_name' => 'kasutaja nimi',
                'user_pass' => 'kasutaja',
                'active' => 'tööl',
            ];

    }

    public static function getLst(){
        return self::find()->where(['active'=>1])->all();
    }

    public static function LoadData(){
        set_time_limit(600);
        foreach (Ftp::getLst() as $ftp){
            $conn_id = ftp_connect($ftp->ip);
            if (ftp_login($conn_id, $ftp->user_name, $ftp->user_pass)) {
                $contents = ftp_nlist($conn_id, ".");
                foreach ($contents as $c) {
                    if (in_array($c, array("./.", "./.."))) continue;
                    $fname = str_replace("./", "", $c);
                    if (!Uploadedfiles::isLoaded($fname)) {
                        $local_file = str_replace("./", Yii::getAlias('@csv'), $c);
                        ftp_get($conn_id, $local_file, $c, FTP_ASCII);
                    }
                }
            }
        }
        $dir = Yii::getAlias('@csv');
        $cdir = scandir($dir);
        $files = [];
        foreach ($cdir as $value) {
            if (!in_array($value,array(".", "..", 'loaded'))){
                $files[] = $value;
            }
        }

        foreach ($files as $file){
            Uploadedfiles::saveFile($file, $dir.$file);
        }
    }
}
