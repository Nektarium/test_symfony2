<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Event\TestEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
//use Psr\EventDispatcher\EventDispatcherInterface;

class TestEventController extends AbstractController
{
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    #[Route('/api/test/event', name: 'test_event')]
    public function testEvent(Request $request): Response
    {
        $message = $request->query->get('message', 'Сообщение не передано');
        $event = new TestEvent($message);
        $this->eventDispatcher->dispatch($event);

        return new Response(sprintf('Событие с сообщением "%s" было отправлено', $message));
    }
}
