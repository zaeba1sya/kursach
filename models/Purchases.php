<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Purchases".
 *
 * @property int $id
 * @property int $nftId
 * @property int $userId
 * @property string $timestamp
 *
 * @property Nft $nft
 * @property User $user
 */
class Purchases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Purchases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nftId', 'userId'], 'required'],
            [['nftId', 'userId'], 'integer'],
            [['timestamp'], 'safe'],
            [['nftId'], 'exist', 'skipOnError' => true, 'targetClass' => Nft::class, 'targetAttribute' => ['nftId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nftId' => Yii::t('app', 'Nft ID'),
            'userId' => Yii::t('app', 'User ID'),
            'timestamp' => Yii::t('app', 'Timestamp'),
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
