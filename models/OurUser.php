<?php


namespace app\models;
use yii\db\ActiveRecord;

class OurUser extends ActiveRecord
{
    public static function tableName(){
        return 'users';
    }
}