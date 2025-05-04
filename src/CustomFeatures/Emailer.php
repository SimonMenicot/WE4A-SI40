<?php

namespace App\CustomFeatures;

use App\Entity\Account;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Messenger\SendEmailMessage;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Mime\Address;

/*

    Le mailer permet d'envoyer des mails de manière asynchrone (en théorie). 
    Ils utilisent la variable d'environnement EMAILER_LINKS_BASE_URL qui contient l'url de base. 
    
    Par défaut, cette variable vaut "http://localhost:8000". Sur le déployement en ligne (nooble.flopcreation.fr), elle vaut "https://nooble.flopcreation.fr". 
    Le nooble.flopcreation.fr de "no-reply@nooble.flopcreation.fr" pour permettre aux mails envoyés de ne pas se trouver dans les spams. 

*/
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

