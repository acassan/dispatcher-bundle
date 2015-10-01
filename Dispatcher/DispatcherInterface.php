<?php

namespace DispatcherBundle\Dispatcher;
use Symfony\Component\EventDispatcher\Event;

/**
 * Interface DispatcherInterface
 * @package DispatcherBundle\Dispatcher
 */
Interface DispatcherInterface
{
	/**
	 * @param $eventName
	 * @param $event
	 * @return mixed
	 */
	public function dispatch($eventName, Event $event);

	/**
	 * @param Event $event
	 * @return Event
	 */
	public function formatEvent(Event $event);
}
