<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Nft".
 *
 * @property int $id
 * @property int $title
 * @property int $image
 * @property string $description
 * @property int $price
 * @property int $amount
 * @property int $ownerId
 * @property int $collectionId
 *
 * @property BoughtItem[] $boughtItems
 * @property Collection $collection
 * @property User $owner
 * @property Purchases[] $purchases
 */
class Nft extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Nft';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'image', 'description', 'price', 'amount', 'ownerId', 'collectionId'], 'required'],
            [['title', 'image', 'price', 'amount', 'ownerId', 'collectionId'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['ownerId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['ownerId' => 'id']],
            [['collectionId'], 'exist', 'skipOnError' => true, 'targetClass' => Collection::class, 'targetAttribute' => ['collectionId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'image' => Yii::t('app', 'Image'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'amount' => Yii::t('app', 'Amount'),
            'ownerId' => Yii::t('app', 'Owner ID'),
            'collectionId' => Yii::t('app', 'Collection ID'),
        ];
    }

    /**
     * Gets query for [[BoughtItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoughtItems()
    {
        return $this->hasMany(BoughtItem::class, ['nftId' => 'id']);
    }

    /**
     * Gets query for [[Collection]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::class, ['id' => 'collectionId']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'ownerId']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['nftId' => 'id']);
    }
}
