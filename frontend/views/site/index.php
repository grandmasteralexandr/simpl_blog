<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $posts \common\models\Post */
/* @var $postPages \yii\data\Pagination */
/* @var $rubrics \common\models\Rubric */


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
                   echo Html::a($post->title, Url::to(['post/'. $post->id .'/view']) );
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
                    echo Html::a($rubric->name .' ('. $rubric->getPostCount() .')', Url::to());
                    ?></h4>
                <?php endforeach; ?>

            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
