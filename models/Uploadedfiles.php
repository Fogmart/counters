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
        return [
            'id' => 'ID',
            'name' => 'Name',
            'whn' => 'Whn',
        ];
    }

    public static function saveVals( $data ){

        $num = count($data);
        $v = new CtVals();
        $dt = $data[0];
        $dt = explode(" ", $dt)[0];
        $dt = explode(".", $dt);

        $v->whn = mktime(0, 0, 0, $dt[1] , $dt[2], $dt[0]);
        $v->ctid = Counter::getCounterID($data[1], $data[2]);
        $v->val = str_replace(",",".", $data[3]);
        if (isset($data[5])) $v->val2 = str_replace(",",".", $data[5]);
        if (isset($data[7])) $v->val3 = str_replace(",",".", $data[7]);
        $v->check();
    }

    public static function saveFiles( $file ){

        for ($i=0; $i<count($file["name"]["file"]); $i++ ){
            $name = $file["name"]["file"][$i];
            $u = Uploadedfiles::find()->where(["name"=>$name])->exists();
            if (!$u){
                if (($handle = fopen($file["tmp_name"]["file"][$i], "r")) !== FALSE) {
                    $row = 0;
                    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                        $row++;
                        if ($row > 1) Uploadedfiles::saveVals($data);
                    }
                    fclose($handle);
                }
                unlink($file["tmp_name"]["file"][$i]);
                $model =  new Uploadedfiles();
                $model->name = $name;
                $model->save();
            }

        }
    }
}
