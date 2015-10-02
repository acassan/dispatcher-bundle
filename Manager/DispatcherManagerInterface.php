<?php
namespace DispatcherBundle\Manager;

use DispatcherBundle\Dispatcher\DispatcherInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Interface DispatcherManagerInterface
 * @package DispatcherBundle\Dispatcher
 */
Interface DispatcherManagerInterface
{
	/**
	 * @param string $eventName
	 * @param Event $event
	 */
	public function dispatch($eventName, Event $event);

	/**
	 * @param string $alias
	 * @param string $eventName
	 * @param Event $event
	 */
	public function dispatchOn($alias, $eventName, Event $event);

	/**
	 * @param string              $alias
	 * @param DispatcherInterface $dispatcher
	 * @return mixed
	 */
	public function addDispatcher($alias, DispatcherInterface $dispatcher);
}
