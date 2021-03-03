<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;


class Category extends ActiveRecord
{
    public static function tableName() {
        
        return 'categories';
    }

    public function getArticle() {

    }

}

