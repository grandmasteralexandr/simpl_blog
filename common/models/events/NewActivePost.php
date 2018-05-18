<?php


namespace common\models\events;


use yii\base\Event;
use common\models\Post;

class NewActivePost extends Event
{
    /**
     * @var Post
     */
    public $post;

    /**
     * @return int
     */
    public function getPostId()
    {
        return $this->post->id;
    }

    /**
     * @return string
     */
    public function getPostTitle()
    {
        return $this->post->title;
    }
}