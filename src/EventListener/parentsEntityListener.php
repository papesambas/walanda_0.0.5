<?php

namespace App\EventListener;

use LogicException;
use App\Entity\Parents;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class parentsEntityListener
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(Parents $parents, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $parents
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getParentsSlug($parents))
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $parents
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getParentsSlug($parents));
    }

    public function preUpdate(Parents $parents, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $parents
                ->setUpdatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getParentsSlug($parents))
                ->setUpdatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $parents
            ->setUpdatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getParentsSlug($parents));
    }


    private function getParentsSlug(Parents $parents): string
    {
        $slug = mb_strtolower($parents->getPere() . '-' . $parents->getMere() . time() . '-', 'UTF-8');
        return $this->slugger->slug($slug);
    }
}
