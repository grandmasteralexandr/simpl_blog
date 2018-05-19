<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Rubric', 'url' => ['rubric/' . $model->rubric_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo 'Created at ' . $model->creation_time . '<br>' ?>
    <?php echo 'Updated at ' . $model->update_time ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'body:html',
            ['attribute' => 'rubric_id',  'value' => $model->getRubricName()],
        ],
    ]) ?>

</div>
