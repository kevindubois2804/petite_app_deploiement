<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Entity\Dog;

class DoctrineEntityListener
{
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Dog) {
            return;
        }

        $now = new \DateTime();
        if ($entity->getCreatedAt() === null) {
            $entity->setCreatedAt($now);
        }
        $entity->setUpdatedAt($now);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Dog) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime());
    }
}
