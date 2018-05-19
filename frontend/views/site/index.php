<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $posts \common\models\Post */
/* @var $postPages \yii\data\Pagination */
/* @var $rubrics \common\models\Rubric */
/* @var $subscriber \common\models\Subscriber */


$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">

                <?php foreach ($posts as $post): ?>

                    <?php
                       echo $post->creation_time;
                    ?>

                <h3><?php
                   echo Html::a($post->title, Url::to(['post/'. $post->id]) );
                    ?></h3>
                    <?php endforeach; ?>

                <?php
                echo LinkPager::widget([
                    'pagination' => $postPages,
                ]);
                ?>
            </div>
            <div class="col-lg-4">

                <?php foreach ($rubrics as $rubric): ?>
                <h4><?php
                    echo Html::a($rubric->name .' ('. $rubric->getPostCount() .')', Url::to(['rubric/' . $rubric->id]));
                    ?></h4>
                <?php endforeach; ?>

            </div>
            <div class="col-lg-4">
                <?= $this->render('subscriber', [
                        'model' => $subscriber,
                ]) ?>
            </div>
        </div>

    </div>
</div>
