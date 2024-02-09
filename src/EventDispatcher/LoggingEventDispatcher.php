<?php

namespace App\EventDispatcher;

//use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
//use Psr\EventDispatcher\EventDispatcherInterface;

class LoggingEventDispatcher implements EventDispatcherInterface
{
    private $dispatcher;
    private $logger;

    public function __construct(EventDispatcherInterface $dispatcher, LoggerInterface $logger)
    {
        $this->dispatcher = $dispatcher;
        $this->logger = $logger;
    }

    public function dispatch(object $event, string $eventName = null): object
    {
        $this->logger->info('Dispatching event', ['event' => $eventName]);
        return $this->dispatcher->dispatch($event, $eventName);
    }

    public function addListener(string $eventName, $listener, int $priority = 0): void
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    public function removeListener(string $eventName, $listener): void
    {
        $this->dispatcher->removeListener($eventName, $listener);
    }

    public function addSubscriber(EventSubscriberInterface $subscriber): void
    {
        $this->dispatcher->addSubscriber($subscriber);
    }

    public function removeSubscriber(EventSubscriberInterface $subscriber): void
    {
        $this->dispatcher->removeSubscriber($subscriber);
    }

    public function getListeners(string $eventName = null): array
    {
        return $this->dispatcher->getListeners($eventName);
    }

    public function getListenerPriority(string $eventName, $listener): ?int
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    public function hasListeners(string $eventName = null): bool
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}