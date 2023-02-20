<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Collection".
 *
 * @property int $id
 * @property string $collection
 *
 * @property Nft[] $nfts
 */
class Collection extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Collection';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['collection'], 'required'],
            [['collection'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'collection' => Yii::t('app', 'Collection'),
        ];
    }

    /**
     * Gets query for [[Nfts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNfts()
    {
        return $this->hasMany(Nft::class, ['collectionId' => 'id']);
    }
}
