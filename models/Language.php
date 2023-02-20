<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Language".
 *
 * @property int $id
 * @property string $language
 *
 * @property Profile[] $profiles
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['language'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'language' => Yii::t('app', 'Language'),
        ];
    }

    /**
     * Gets query for [[Profiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['languageId' => 'id']);
    }

    public static function getIdByLanguage($language)
    {
        return static::findOne(['language' => $language])->id;
    } 
}
