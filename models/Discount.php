<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Discount".
 *
 * @property int $id
 * @property string $discountHash
 * @property int $ownerId
 * @property int $invitedUsersCount
 *
 * @property User $owner
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Discount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discountHash', 'ownerId', 'invitedUsersCount'], 'required'],
            [['ownerId', 'invitedUsersCount'], 'integer'],
            [['discountHash'], 'string', 'max' => 255],
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
            'discountHash' => Yii::t('app', 'Discount Hash'),
            'ownerId' => Yii::t('app', 'Owner ID'),
            'invitedUsersCount' => Yii::t('app', 'Invited Users Count'),
        ];
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

    public static function getUserCode($id)
    {
        return static::findOne(["ownerId" => $id])->discountHash;
    }

    public static function getUserDiscount()
    {
        if (Yii::$app->user->id <= 0) {
            return 0;
        }
        $discount = static::findOne(['ownerId' => Yii::$app->user->id])->invitedUsersCount;
        if ($discount > 0 && $discount < 10) {
            return 10;
        } else {
            return 15;
        }
        return 0;
    }

    public static function increaseDiscount($code)
    {
        $discount = static::findOne(['discountHash' => $code]);
        $discount->invitedUsersCount+=1;
        return $discount->save(false);
    }
}
