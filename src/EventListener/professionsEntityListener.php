<?php

namespace App\EventListener;

use LogicException;
use App\Entity\Professions;
use Symfony\Bundle\SecurityBundle\Security;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class professionsEntityListener
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(Professions $professions, LifecycleEventArgs $arg)
    {
        $user = $this->security->getUser();
        if ($user) {
            $professions
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getProfessionsSlug($professions))
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }
    }

    public function preUpdate(Professions $professions, LifecycleEventArgs $arg)
    {
        $user = $this->security->getUser();
        if ($user) {
            $professions
                ->setUpdatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getProfessionsSlug($professions))
                ->setUpdatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }
    }


    private function getProfessionsSlug(Professions $professions): string
    {
        $slug = mb_strtolower($professions->getDesignation() . '-' . time() . '-', 'UTF-8');
        return $this->slugger->slug($slug);
    }
}
