<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Profile".
 *
 * @property int $id
 * @property int $userId
 * @property string $username
 * @property string $website
 * @property int $languageId
 * @property string $wallet
 *
 * @property Language $language
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'username', 'website', 'languageId', 'wallet'], 'required'],
            [['userId', 'languageId'], 'integer'],
            [['username', 'website', 'wallet'], 'string', 'max' => 255],
            [['languageId'], 'exist', 'skipOnError' => true, 'targetClass' => Language::class, 'targetAttribute' => ['languageId' => 'id']],
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
            'userId' => Yii::t('app', 'User ID'),
            'username' => Yii::t('app', 'Username'),
            'website' => Yii::t('app', 'Website'),
            'languageId' => Yii::t('app', 'Language ID'),
            'wallet' => Yii::t('app', 'Wallet'),
        ];
    }

    /**
     * Gets query for [[Language]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'languageId']);
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

    public static function getProfileData($id)
    {
        return static::findOne(["userId" => $id]);
    }
}