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

    public $file=[];

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
        $lang = Yii::$app->user->identity->lang;

        if ($lang == 'ru')
            return [
                'id' => 'ID',
                'name' => 'Имя файла',
                'whn' => 'Дата загрузки',
            ];

        if ($lang == 'en')
            return [
                'id' => 'ID',
                'name' => 'File name',
                'whn' => 'Upload date',
            ];

        if ($lang == 'et')
            return [
                'id' => 'ID',
                'name' => 'Faili nimi',
                'whn' => 'Üleslaadimise kuupäev',
            ];

    }

    public static function saveVals( $data, $addr ){

        $num = count($data);
        $v = new CtVals();
        $dt = $data[0];
        $dt = explode(" ", $dt)[0];
        $dt = explode(".", $dt);
        date_default_timezone_set('UTC');
        $v->whn = mktime(0, 0, 0, $dt[1], $dt[2], $dt[0]);
        $type = CtTypes::getTypeID($data[2]);
        if (!$type) return;
        if (preg_match('/\d+/', $data[2], $match)){
            $apartment = $match[0];
        } elseif (preg_match('/ULD/', $data[2], $match)){
            $apartment = $match[0];
        } else {
            $apartment = '-';
        }
        $addrid = Addr::getAddrID($addr, $apartment);
        $v->ctid = Counter::getCounterID($data[1], $type, $addrid);
        if ($v->ctid) {
            $v->val = str_replace(",", ".", $data[3]);
            if (isset($data[5])) $v->val2 = str_replace(",", ".", $data[5]);
            if (isset($data[7])) $v->val3 = str_replace(",", ".", $data[7]);
            $v->check();
        }
    }

    public static function saveFiles( $file ){

        for ($i=0; $i<count($file["name"]["file"]); $i++ ){
            self::saveFile($file["name"]["file"][$i], $file["tmp_name"]["file"][$i]);

        }
    }

    public static function saveFile($fname, $floc){
        $u = self::isLoaded($fname);
        if (!$u){
            if (($handle = fopen($floc, "r")) !== FALSE) {
                $row = 0;
                $addr = str_replace(Yii::getAlias('@csv'), "", $fname);
                $addr = preg_replace('/[_\d+]+[.]csv/', "", $addr   );
                $addr = preg_replace('/^\d+[_]/', "", $addr);

                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                    $row++;
                    if ($row > 1) Uploadedfiles::saveVals($data, $addr);
                }
                fclose($handle);
            }
//            unlink($floc);
            rename($floc, Yii::getAlias('@loaded').$fname);
            $model =  new Uploadedfiles();
            $model->name = $fname;
            $model->save();
        }


    }

    public static function isLoaded($fname){
        return Uploadedfiles::find()->where(["name"=>$fname])->exists();
    }
}
