<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "BoughtItem".
 *
 * @property int $id
 * @property int $ownerId
 * @property int $nftId
 *
 * @property Nft $nft
 * @property User $owner
 */
class BoughtItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'BoughtItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ownerId', 'nftId'], 'required'],
            [['ownerId', 'nftId'], 'integer'],
            [['nftId'], 'exist', 'skipOnError' => true, 'targetClass' => Nft::class, 'targetAttribute' => ['nftId' => 'id']],
            [['ownerId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['ownerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ownerId' => Yii::t('app', 'Owner ID'),
            'nftId' => Yii::t('app', 'Nft ID'),
        ];
    }

    /**
     * Gets query for [[Nft]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNft()
    {
        return $this->hasOne(Nft::class, ['id' => 'nftId']);
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
}
