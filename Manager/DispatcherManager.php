<?php
namespace DispatcherBundle\Manager;

use DispatcherBundle\Dispatcher\DispatcherInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DispatcherManager
 * @package DispatcherBundle\Dispatcher
 */
Class DispatcherManager implements  DispatcherManagerInterface
{
	/**
	 * @var array
	 */
	private $dispatcher;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->dispatcher = [];
	}

	/**
	 * @inheritdoc
	 */
	public function dispatch($eventName, Event $event)
	{
		foreach($this->dispatcher as $alias => $dispatcher) {
			$this->dispatchOn($alias, $eventName, $event);
		}
	}

	/**
	 * @inheritdoc
	 */
	public function dispatchOn($alias, $eventName, Event $event)
	{
		$dispatcher = $this->findDispatcher($alias);
		$event 		= $dispatcher->formatEvent($event);

		return $dispatcher->dispatch($eventName, $event);
	}

	/**
	 * @inheritdoc
	 */
	public function addDispatcher($alias, DispatcherInterface $dispatcher)
	{
		$this->dispatcher[strtolower($alias)] = $dispatcher;
	}

	/**
	 * @param $alias
	 * @return DispatcherInterface
	 */
	private function findDispatcher($alias)
	{
		$alias = strtolower($alias);

		if (!isset($this->dispatcher[$alias])) {
			throw new \RuntimeException(sprintf('There is no dispatcher %s.', $alias));
		}

		return $this->dispatcher[$alias];
	}
}
