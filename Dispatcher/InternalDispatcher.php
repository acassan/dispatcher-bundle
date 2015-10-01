<?php

namespace DispatcherBundle\Dispatcher;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class InternalDispatcher
 * @package DispatcherBundle\Dispatcher
 */
Class InternalDispatcher implements DispatcherInterface
{
	/**
	 * @var EventDispatcherInterface
	 */
	private $dispatcher;

	/**
	 * @param EventDispatcherInterface $dispatcher
	 */
	public function __construct(EventDispatcherInterface $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @inheritdoc
	 */
	public function dispatch($eventName, Event $event)
	{
		$this->dispatcher->dispatch($eventName, $event);
	}

	/**
	 * @inheritdoc
	 */
	public function formatEvent(Event $event)
	{
		return $event;
	}
}
