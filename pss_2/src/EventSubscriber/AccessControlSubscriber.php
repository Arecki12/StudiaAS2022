<?php

namespace App\EventSubscriber;

use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class AccessControlSubscriber implements EventSubscriberInterface
{
    /**
     * @param ParameterBagInterface $parameterBagInterface
     */
    public function __construct(
        private readonly ParameterBagInterface $parameterBagInterface,
    )
    {
    }

    /**
     * @param RequestEvent $event
     * @return void
     */
    public function onKernelRequest(RequestEvent $event): void
    {
//        $ip = $event->getRequest()->getClientIp();
//        $isSlackBotCalling = str_contains($event->getRequest()->getPathInfo(), '/slack/');
//
//        $allowedIps = $this->parameterBagInterface->get('allowed_ips');
//        if (!in_array($ip, explode(',', $allowedIps)) && !$isSlackBotCalling) {
//            throw new AccessDeniedHttpException("Access denied for IP: $ip");
//        }
    }

    /**
     * @return string[]
     */
    #[ArrayShape([KernelEvents::REQUEST => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }
}