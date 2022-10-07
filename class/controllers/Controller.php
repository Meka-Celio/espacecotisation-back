<?php

/**
 * La classe controller sert de base pour la création d'instance de controller
 * 
 * L'utilité du controller est de définir comment les données réagissent aux 
 * actions de l'utilisateur
 * 
 * */

namespace controllers;

abstract class Controller 
{
	protected $model;
	protected $modelName;

	public function __construct ()
	{
		$this->model = new $this->modelName;
	}
}