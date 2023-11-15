<?php

namespace App\EventListener;

use LogicException;
use App\Entity\Meres;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class meresEntityListener
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(Meres $meres, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $meres
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getMeresSlug($meres))
                ->setFullName($meres->getNom() . ' ' . $meres->getPrenom())
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $meres
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getMeresSlug($meres))
            ->setFullName($meres->getNom() . ' ' . $meres->getPrenom());
    }

    public function preUpdate(Meres $meres, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $meres
                ->setUpdatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getMeresSlug($meres))
                ->setFullName($meres->getNom() . ' ' . $meres->getPrenom())
                ->setUpdatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $meres
            ->setUpdatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getMeresSlug($meres))
            ->setFullName($meres->getNom() . ' ' . $meres->getPrenom());
    }


    private function getMeresSlug(Meres $meres): string
    {
        $slug = mb_strtolower($meres->getFullname() . '-' . time() . '-', 'UTF-8');
        return $this->slugger->slug($slug);
    }
}
