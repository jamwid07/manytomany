<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "relation".
 *
 * @property int $review_id
 * @property int $category_id
 *
 * @property Review $review
 * @property Category $category
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review_id', 'category_id'], 'required'],
            [['review_id', 'category_id'], 'integer'],
//            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Review::className(), 'targetAttribute' => ['review_id' => 'id']],
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'review_id' => 'Review ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['id' => 'review_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
