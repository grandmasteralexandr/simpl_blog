<?php

namespace common\models;


/**
 * This is the model class for table "subscriber".
 *
 * @property int $id
 * @property string $email
 */
class Subscriber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscriber';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'unique'],
            ['email', 'email'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getEmails()
    {
        return $this->find()->all();
    }
}
