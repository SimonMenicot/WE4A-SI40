<?php

namespace App\CustomFeatures;

use App\Entity\Account;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Address;

const BASE_URL = "http://localhost:8000";

class Emailer
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function send_email(Account $user, string $subject, string $template, array $args)
    {
        $args["base_url"] = BASE_URL;

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

