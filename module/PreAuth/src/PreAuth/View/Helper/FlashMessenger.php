<?php

namespace PreAuth\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{
	protected static $_flashMessenger;

	public function __invoke($namespace = 'default') {

		if (!self::$_flashMessenger) {

			self::$_flashMessenger = new \Zend\Mvc\Controller\Plugin\FlashMessenger;
		}

		return self::$_flashMessenger->setNamespace($namespace);
	}
}