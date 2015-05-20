<?php namespace Qdiscuss\Core\Notifications\Senders;
use Qdiscuss\Core\Notifications\Types\Notification;
use Qdiscuss\Core\Models\User;
use Qdiscuss\Core\Models\Forum;
use Illuminate\Mail\Mailer;
use ReflectionClass;
class NotificationEmailer implements NotificationSender
{
	public function __construct(Mailer $mailer, Forum $forum)
	{
		$this->mailer = $mailer;
		$this->forum = $forum;
	}
	public function send(Notification $notification, User $user)
	{
		$this->mailer->send(
			$notification->getEmailView(),
			compact('notification', 'user'),
			function ($message) use ($notification, $user) {
				$message->to($user->email, $user->username)
						->subject('['.$this->forum->title.'] '.$notification->getEmailSubject());
			}
		);
	}
	public static function compatibleWith($class)
	{
		return (new ReflectionClass($class))->implementsInterface('Qdiscuss\Core\Notifications\Types\EmailableNotification');
	}
}