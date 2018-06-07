<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Review".
 *
 * @property int $id
 * @property string $FIO
 * @property string $email
 * @property string $text
 *
 * @property Relation[] $relations
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FIO', 'email'], 'required'],
            [['text'], 'string'],
            [['FIO'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FIO' => 'Fio',
            'email' => 'Email',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelations()
    {
        return $this->hasMany(Relation::className(), ['review_id' => 'id']);
    }
}
