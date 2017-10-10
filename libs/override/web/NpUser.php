<?php
/**
 * Created by PhpStorm.
 * Author: npbtrac@yahoo.com
 * Date time: 9/9/17 1:20 PM
 */
/**
 * Handling web user like logged in session, params for working session and timeout ...
 */
namespace enpii\enpiiCms\libs\override\web;

use Yii;
use yii\web\User;
use yii\web\IdentityInterface;

/**
 * Class NpWebUser
 * @package enpii\enpiiCms\libs\override\web
 * Override web user for web application
 */
class NpUser extends User
{
    public $params = [];

    public function login(IdentityInterface $identity, $duration = 0)
    {
        if ($this->beforeLogin($identity, $this->enableAutoLogin, $duration)) {
            $this->switchIdentity($identity, $duration);
            $id = $identity->getId();
            $ip = Yii::$app->getRequest()->getUserIP();
            if ($this->enableSession) {
                $log = "User '$id' logged in from $ip with duration $duration.";
            } else {
                $log = "User '$id' logged in from $ip. Session not enabled.";
            }
            Yii::info($log, __METHOD__);
            $this->afterLogin($identity, $this->enableAutoLogin, $duration);
        }

        return !$this->getIsGuest();
    }

    /**
     * This method is called after the user is successfully logged in.
     * The default implementation will trigger the [[EVENT_AFTER_LOGIN]] event.
     * If you override this method, make sure you call the parent implementation
     * so that the event is triggered.
     * @param IdentityInterface $identity the user identity information
     * @param boolean $cookieBased whether the login is cookie-based
     * @param integer $duration number of seconds that the user can remain in logged-in status.
     * If 0, it means login till the user closes the browser or the session is manually destroyed.
     */
    protected function afterLogin($identity, $cookieBased, $duration)
    {
        parent::afterLogin($identity, $cookieBased, $duration);
    }
}