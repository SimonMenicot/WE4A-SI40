<?php

namespace App\CustomFeatures;

use App\Entity\Account;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Address;

class Emailer
{
    private MessageBusInterface $bus;

    private string $base_url;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
        $this->base_url = $_ENV["EMAILER_LINKS_BASE_URL"];
    }

    public function send_email(Account $user, string $subject, string $template, array $args)
    {
        $args["base_url"] = $this->base_url;

        $mail = (new TemplatedEmail())
            ->from(new Address("no-reply@nooble.flopcreation.fr", "Nooble"))
            ->to(new Address($user->getEmail(), $user->getSurname() . " " . $user->getName()))
            ->subject($subject)
            ->htmlTemplate($template)
            ->context($args);

        $this->bus->dispatch(
            new SendEmailMessage($mail)
        );
    }
}

