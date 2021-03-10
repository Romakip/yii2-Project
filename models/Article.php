<?php

namespace app\models;

use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;
use app\models\Category;
use app\models\Subcategory;
use app\models\OurUser;


class Article extends ActiveRecord
{

    public $relations = [];

    private $_values = [];

    public static function tableName() {
        
        return 'articles';
    }
    
    public function getCategories(){
        
           return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    public function getSubcategories() {

        return $this->hasOne(Subcategory::class, ['id'=> 'subcategoryId']);
    }

    public function getAuthors() {

        return $this->hasMany(OurUser::class, ['id' => 'author'])
            ->viaTable('authors', ['article_id' => 'id']);
    }


    public function rules(){

        return [

            [['title', 'summary', 'content', 'publicationDate', 'categoryId', 'subcategoryId'], 'required'],
            ['title', 'string', 'max' => 5, 'tooLong' => 'Title not should be long'],
            ['active', 'safe']
        ];

    }
    

}

