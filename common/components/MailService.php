<?php

namespace common\components;


use Yii;
use yii\base\Component;
use common\models\events\NewActivePost;
use common\models\Subscriber;

class MailService extends Component
{
    /**
     * @param NewActivePost $event
     */
    public function sendNewPosts($event)
    {
        $subscriber = new Subscriber();
        $subscriber = $subscriber->getEmails();
        foreach ($subscriber as $email) {
            Yii::$app->mailer->compose('newPost', ['event' => $event])
                ->setFrom('grandmasteralexandr@gmail.com')
                ->setTo($email->email)
                ->setSubject('Created new Post ' . $event->getPostTitle())
                ->send();
        }

    }
}