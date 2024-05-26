<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\Events;

class UserSubscriber implements EventSubscriber
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();
        $this->encodePassword($entity);
    }

    private function encodePassword($entity): void
    {
        if (!$entity instanceof User) {
            return;
        }

        // Check if the password is already hashed
        if (password_get_info($entity->getPassword())['algo'] === 0) {
            $encodedPassword = $this->passwordHasher->hashPassword(
                $entity,
                $entity->getPassword()
            );
            $entity->setPassword($encodedPassword);
        }
    }
}
