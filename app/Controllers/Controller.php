<?php

namespace App\Controllers;

use Slim\Views\Twig as View;

class Controller 
{
	
		protected $container;
		protected $view;

	public function __construct($container, View $view)
	{
		$this->container = $container;
		$this->view = $view;
	}

	public function __get($property)
	{
		if ($this->container->{$property}) {
			return $this->container->{$property};
		}
	}
}