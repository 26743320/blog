<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "aticle".
 *
 * @property integer $a_id
 * @property integer $c_id
 * @property string  $a_title
 * @property string  $a_content
 * @property integer $a_date
 * @property integer $a_author
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%article}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_id', 'a_title', 'a_content'], 'required'],
            [['c_id'], 'integer'],
            [['a_content'], 'string'],
            [['a_title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'a_id' => 'A ID',
            'c_id' => '博客类别',
            'a_title' => '博客标题',
            'a_content' => '博客内容',
            'a_date' => 'A Date',
            'a_author' => 'A Author',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'a_author']);
    }

    /**
     * 保存数据
     */
    // public function save(){

    // }
}
