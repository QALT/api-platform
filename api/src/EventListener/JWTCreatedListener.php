<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    /**
     * Replaces the data in the generated
     *
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        /** @var $user \AppBundle\Entity\User */
        $user = $event->getUser();
        $expiration = new \DateTime('+1 day');

        // add new data
        $payload['id'] = $user->getId();
        $payload['email'] = $user->getUsername();
        $payload['firstname'] = $user->getFirstname();
        $payload['lastname'] = $user->getLastname();
        $payload['roles'] = $user->getRoles();
        $payload['exp'] = $expiration->getTimestamp();

        $event->setData($payload);
    }
}
