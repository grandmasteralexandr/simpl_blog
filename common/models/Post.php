<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\SluggableBehavior;
use common\models\events\NewActivePost;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property int $rubric_id
 * @property string $status
 *
 * @property Rubric $rubric
 * @property int $creation_time
 * @property int $update_time
 */
class Post extends \yii\db\ActiveRecord
{
    const EVENT_NEW_ACTIVE_POST = 'new_active_post';

    public function init()
    {
        $this->on(Self::EVENT_NEW_ACTIVE_POST, [Yii::$app->mailService, 'sendNewPosts']);
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'rubric_id'], 'required'],
            [['body', 'status'], 'string'],
            [['rubric_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['rubric_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rubric::className(), 'targetAttribute' => ['rubric_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'rubric_id' => 'Rubric',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRubric()
    {
        return $this->hasOne(Rubric::className(), ['id' => 'rubric_id']);
    }

    /**
     * @return array
     */
    public function getRubricList()
    {
        $list = Rubric::find()->all();
        return ArrayHelper::map($list, 'id', 'name');
    }

    /**
     * @return string
     */
    public function getRubricName()
    {
        $list = $this->getRubric()->one();
        return ArrayHelper::getValue($list, 'name');
    }

    /**
     * @return array
     */
    public function getStatusEnum()
    {
        return [ 'Draft' => 'Draft', 'Active' => 'Active', 'Archive' => 'Archive', ];
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'creation_time',
                'updatedAtAttribute' => 'update_time',
                'value' => function () { return date('Y-m-d H:i:s'); }
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                // 'slugAttribute' => 'slug',
            ],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->status == 'Active') {
            $event = new NewActivePost();
            $event->post = $this;
            $this->trigger(Post::EVENT_NEW_ACTIVE_POST, $event);
        }
        return parent::save($runValidation, $attributeNames);
    }
}
