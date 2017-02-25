<?php

/* 
 * The class use namshi/notificator 1.0
 * only email notification is implemented
 */

use Namshi\Notificator\Notification;
use Namshi\Notificator\Notification\Handler\HandlerInterface;
use Namshi\Notificator\NotificationInterface;
use Namshi\Notificator\Manager;

interface NotifySendNotificationInterface extends NotificationInterface
{
    public function getMessage();
}

interface EmailNotificationInterface extends NotificationInterface
{
    public function getAddress();
    public function getSubject();
    public function getBody();
}

class DoubleNotification extends Notification implements NotifySendNotificationInterface, EmailNotificationInterface
{
    protected $address;
    protected $body;
    protected $subject;

    public function __construct($address, $subject, $body, array $parameters = array())
    {
        parent::__construct($parameters);

        $this->address  = $address;
        $this->body     = $body;
        $this->subject  = $subject;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getMessage()
    {
        return $this->getBody();
    }
}
class NotifySendNotificationHandler implements HandlerInterface
{
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf NotifySendNotificationInterface;
    }

    public function handle(NotificationInterface $notification)
    {
        shell_exec(sprintf('notify-send "%s"', $notification->getMessage()));
    }
}

class EmailNotificationHandler implements HandlerInterface
{
    public function shouldHandle(NotificationInterface $notification)
    {
        return $notification instanceOf EmailNotificationInterface;
    }

    public function handle(NotificationInterface $notification)
    {
        mail($notification->getAddress(), $notification->getSubject(), $notification->getBody());
    }
}

/*
$manager = new Manager();
$manager->addHandler(new NotifySendNotificationHandler());
$manager->addHandler(new EmailNotificationHandler());

$notification = new DoubleNotification('guoyi6901@gmail.com', 'Test email', 'Hello world!');

//  trigger the notification
$manager->trigger($notification);
*/