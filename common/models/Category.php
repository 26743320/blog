<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $c_id
 * @property string $c_name
 * @property string $c_date
 * @property string $c_desc
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_id', 'c_name'], 'required'],
            [['c_id'], 'integer'],
            [['c_date'], 'safe'],
            [['c_name', 'c_desc'], 'string', 'max' => 255],
            [['c_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'c_id' => '博客类别',
            'c_name' => '类别名称',
            'c_date' => 'C Date',
            'c_desc' => 'C Desc',
        ];
    }
    /**
     * {@inheritdoc}
     * @return AticleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AticleQuery(get_called_class());
    }
}
