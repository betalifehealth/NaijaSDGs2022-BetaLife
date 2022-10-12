<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Notifications;

class NotificationsController extends BaseController
{
    public function __construct()
    {
        $this->arrayOfAcceptableAccountTypes = [
            'hospital', 'blood-bank', 'pharmacy'
        ];

        $this->accountAuthID = session("auth_id");
        $this->accountAuthType = session("acct_type");
        $this->user_info = $this->getUserProfileInformationBasedOnType($this->accountAuthType, $this->accountAuthID);

        $this->isUserSignedIn();
        $this->notifiationsModel = new Notifications();
    }

    public function index() 
    {
        $this->notifiationsModel->setNotifications($this->user_info->id, $this->accountAuthType);
    }

    public function getNotifications()
    {
        $notifications = $this->notifiationsModel->getNotifications($this->user_info->id, $this->accountAuthType);

        return $this->response->setJSON($notifications);
    }
}
