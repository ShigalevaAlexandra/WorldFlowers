<?php

namespace app\models;

use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id_user
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property string $еmail
 * @property string $password
 * @property int|null $is_admin
 *
 * @property Carts[] $carts
 */
class Users extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'еmail', 'password'], 'required'],
            [['is_admin'], 'integer'],
            [['name', 'surname', 'patronymic', 'login', 'еmail', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Логин',
            'еmail' => 'Еmail',
            'password' => 'Пароль',
            'is_admin' => 'Is Admin',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Carts::class, ['user_id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
    
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
    
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return self::find()->where(['email'=> $email])->one();
    }
}
