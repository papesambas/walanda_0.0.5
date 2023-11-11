<?php

namespace App\EventListener;

use App\Entity\Telephones;
use LogicException;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class telephonesEntityListener
{
    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger, Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public function prePersist(Telephones $telephones, LifecycleEventArgs $arg): void
    {
        $user = $this->security->getUser();
        if ($user) {
            $telephones
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getTelephonesSlug($telephones))
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }
    }

    public function preUpdate(Telephones $telephones, LifecycleEventArgs $arg): void
    {
        $user = $this->security->getUser();
        if ($user) {
            $telephones
                ->setCreatedAt(new \DateTimeImmutable('now'))
                ->setSlug($this->getTelephonesSlug($telephones))
                ->setCreatedBy($user);
        } else {
            throw new LogicException('User cannot be null here ...');
        }
    }


    private function getTelephonesSlug(Telephones $telephones): string
    {
        $slug = mb_strtolower($telephones->getNumero() . '-' . $telephones->getId(), 'UTF-8');
        return $this->slugger->slug($slug);
    }
}
