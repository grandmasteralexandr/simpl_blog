<?php

namespace frontend\controllers;

use Yii;
use common\models\Rubric;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Post;
use yii\data\Pagination;
use common\models\Subscriber;

/**
 * RubricController implements the CRUD actions for Rubric model.
 */
class RubricController extends Controller
{

    /**
     * Displays a single Rubric model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $postQuery = Post::find()->where(['status' => 'Active'])->andWhere(['rubric_id' => $id])->orderBy(['creation_time' => SORT_DESC]);
        $postPages = new Pagination(['totalCount' => $postQuery->count(), 'pageSize' => 5]);
        $posts = $postQuery->offset($postPages->offset)->limit($postPages->limit)->all();

        $rubrics = Rubric::find()->all();

        $subscriber = new Subscriber();

        if ($subscriber->load(Yii::$app->request->post()) && $subscriber->validate()) {
            if ($subscriber->save()) {
                Yii::$app->session->addFlash('success', 'You Successfuly subcribed');
                return $this->refresh();
            }
            return $this->render('index', ['subscribe' => $subscriber]);

        }

        return $this->render('..\site\index', [
            'model' => $this->findModel($id),
            'posts' => $posts,
            'postPages' => $postPages,
            'rubrics' => $rubrics,
            'subscriber' => $subscriber,
        ]);
    }

    /**
     * Finds the Rubric model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rubric the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rubric::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
