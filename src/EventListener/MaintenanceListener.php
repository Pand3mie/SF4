<?php 

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class MaintenanceListener
{
    private $lockpath;

    public function __construct($lockpath){
        $this->lockpath = $lockpath;
    }

    public function onKernelRequest(GetResponseEvent $event){

        if (! file_exists($this->lockpath)){
            return;
        }

        $event->setResponse(new Response('Site en maintenance', Response::HTTP_SERVICE_UNAVAILABLE));
        $event->stopPropagation();
    }
}