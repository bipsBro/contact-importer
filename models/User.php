<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
* This is the model class for table "user".
*
* @property int $id
* @property string $username
* @property string $email
* @property string $password_hash
* @property string $auth_key
* @property int $confirmed_at
* @property int $blocked_at
* @property int $created_at
* @property int $updated_at
* @property int $last_login
*
* @property Contact[] $contacts
*/
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'user';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'last_login'], 'integer'],
      [['username', 'email'], 'string', 'max' => 255],
      [['password_hash'], 'string', 'max' => 60],
      [['auth_key'], 'string', 'max' => 32],
    ];
  }

  public function behaviors()
  {
    return [
      TimestampBehavior::className(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'username' => 'Username',
      'email' => 'Email',
      'password_hash' => 'Password Hash',
      'auth_key' => 'Auth Key',
      'confirmed_at' => 'Confirmed At',
      'blocked_at' => 'Blocked At',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At',
      'last_login' => 'Last Login',
    ];
  }
  public static function findIdentity($id)
  {
    return static::findOne($id);
  }

  /**
  * @inheritdoc
  */
  public function getId()
  {
    return $this->getPrimaryKey();
  }

  /**
  * @inheritdoc
  */
  public function getAccessToken()
  {
    return $this->auth_key;
  }

  public function getAuthKey($value='')
  {

  }

  public function validateAuthKey($value='')
  {

  }

  /**
   * Generates "remember me" authentication key
   */
  public function generateAuthKey()
  {
      $this->auth_key = Yii::$app->security->generateRandomString();
  }
  /**
  * @inheritdoc
  */
  public function validateAccessToken($accessToken)
  {
    return $this->getAccessToken() === $accessToken;
  }
  /**
  * Validates password
  *
  * @param string $password password to validate
  * @return boolean if password provided is valid for current user
  */
  public function validatePassword($password)
  {
    return Yii::$app->security->validatePassword($password, $this->password_hash);
  }

  /**
  * Generates password hash from password and sets it to the model
  *
  * @param string $password
  */
  public function setPassword($password)
  {
    $this->password_hash = Yii::$app->security->generatePasswordHash($password);
  }

  /**
  * @inheritdoc
  */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    $user = static::findOne(['auth_key' => $token]);
    if ($user && $user->tokenExpiry > time()) {
        // TBD : update auth_key
      return $user;
    }
    return null;
  }
  /**
  * Finds user by email
  *
  * @param string $email
  * @return static|null
  */
  public static function findByEmail($email)
  {
    return static::find()->where(
      'email = :email', [
        ':email' => $email
      ])->one();
  }
  /**
  * Finds user by username
  *
  * @param string $email
  * @return static|null
  */
  public static function findByUsername($username)
  {
    return static::find()->where(
      'username = :username', [
        ':username' => $username
      ])->one();
  }
  
  /**
   * @return \yii\db\ActiveQuery
   */
  public function getContacts()
  {
    return $this->hasMany(Contact::className(), ['user_id' => 'id']);
  }
}
