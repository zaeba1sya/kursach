<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $balance
 * @property int $roleId
 * @property string $authKey
* @property Profile[] $profiles
 *
 * @property Discount[] $discounts 
 * @property BoughtItem[] $boughtItems
 * @property Nft[] $nfts
 * @property Profile $profile
 * @property Purchases[] $purchases
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'balance', 'roleId', 'authKey'], 'required'],
            [['balance', 'roleId'], 'integer'],
            [['login', 'password', 'authKey'], 'string', 'max' => 255],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['roleId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'login' => Yii::t('app', 'Login'),
            'password' => Yii::t('app', 'Password'),
            'balance' => Yii::t('app', 'Balance'),
            'roleId' => Yii::t('app', 'Role ID'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'profileId' => Yii::t('app', 'Profile ID'),
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        $this->authKey = Yii::$app->security->generateRandomString();
        $this->password = Yii::$app->security->generatePasswordHash($this->password);
        $this->balance = 10000;
        $this->roleId = Role::getIdByRole("buyer");

        return true;
    }

    /**
     * Gets query for [[BoughtItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoughtItems()
    {
        return $this->hasMany(BoughtItem::class, ['ownerId' => 'id']);
    }

    public function createProfile($username, $id)
    {
        $newProfile = new Profile();
        $newProfile->userId = $id;
        $newProfile->username = $username;
        $newProfile->website = '';
        $newProfile->languageId = Language::getIdByLanguage("en-US");
        $newProfile->wallet = "0x".Yii::$app->security->generateRandomString(40);
        return $newProfile->save(false);
    }

    public function createDiscount($id)
    {
        $newDiscount = new Discount();
        $newDiscount->discountHash = Yii::$app->security->generateRandomString(10);
        $newDiscount->ownerId = $id;
        $newDiscount->invitedUsersCount = 0;
        return $newDiscount->save(false);
    }

    /**
    * Gets query for [[Discounts]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getDiscounts() 
   { 
       return $this->hasMany(Discount::class, ['ownerId' => 'id']); 
   } 

    /**
     * Gets query for [[Nfts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNfts()
    {
        return $this->hasMany(Nft::class, ['ownerId' => 'id']);
    }

   	   /**
    * Gets query for [[Profiles]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getProfiles()
    {
        return $this->hasMany(Profile::class, ['userId' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchases::class, ['userId' => 'id']);
    }

    public function getIsAdmin()
    {
        return $this->roleId == Role::getIdByRole("admin");
    }

    public function getIsMerchant()
    {
        return $this->roleId == Role::getIdByRole("merchant");
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'roleId']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByLogin($login)
    {
        return static::findOne(["login" => $login]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
