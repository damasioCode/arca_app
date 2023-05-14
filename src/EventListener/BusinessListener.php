<?php

namespace App\EventListener;

use App\Entity\Business;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class BusinessListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Business $business, LifecycleEventArgs $event)
    {
        $this->updateSlug($business);
    }

    public function preUpdate(Business $business, LifecycleEventArgs $event)
    {
        $this->updateSlug($business);
    }

    private function updateSlug(Business $business)
    {
        $title = $business->getTitle();
        $slug = $this->slugger->slug($title)->lower();
        $business->setSlug($slug);
    }
}