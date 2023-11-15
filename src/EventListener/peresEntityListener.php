<?php

namespace App\EventListener;

use LogicException;
use App\Entity\Peres;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class peresEntityListener
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(Peres $peres, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $peres
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getPeresSlug($peres))
                ->setFullName($peres->getNom() . ' ' . $peres->getPrenom())
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $peres
            ->setCreatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getPeresSlug($peres))
            ->setFullName($peres->getNom() . ' ' . $peres->getPrenom());
    }

    public function preUpdate(Peres $peres, LifecycleEventArgs $arg)
    {
        /*$user = $this->security->getUser();
        if ($user) {
            $peres
                ->setUpdatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getPeresSlug($peres))
                ->setFullName($peres->getNom() . ' ' . $peres->getPrenom())
                ->setUpdatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }*/
        $peres
            ->setUpdatedAt(new \DateTimeImmutable('now'))
            ->setSlug($this->getPeresSlug($peres))
            ->setFullName($peres->getNom() . ' ' . $peres->getPrenom());
    }


    private function getPeresSlug(Peres $peres): string
    {
        $slug = mb_strtolower($peres->getFullname() . '-' . time() . '-', 'UTF-8');
        return $this->slugger->slug($slug);
    }
}
