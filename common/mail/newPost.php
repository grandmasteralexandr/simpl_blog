<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $event common\models\events\NewActivePost */

?>
    <p>New post has been added for your subscribe</p>
    <p><?= Html::a($event->getPostTitle(), 'blog.loc/post/' . $event->getPostId()) ?></p>
    <p>This email was sent you because you subscribe at <a href="blog.loc/">www.blog.loc</a></p>

