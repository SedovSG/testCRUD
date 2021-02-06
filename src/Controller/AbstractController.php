<?php

declare(strict_types = 1);

namespace App\Controller;

use Fenom;

class AbstractController
{

	/** @var \Fenom Объект шаблонизатора Fenom */
  	protected $fenom = null;

    /**
     * Метод создаёт экземпляр базового объекта класса контроллера.
     */
	public function __construct()
	{
		$this->setFenom();
	}

	/**
	 * Метод устанавливает объект шаблонизатора Fenom.
	 *
	 * @throws \Fenom\Error\CompileException
	 *
	 * @return void
	 */
	public function setFenom(): void
	{
	  try
	  {
	    $this->fenom = new Fenom(new Fenom\Provider(__DIR__ . "/../Layout"));
	    $this->fenom->setCompileDir(__DIR__ . "/../../data/cache");

	    $this->fenom->setOptions(Fenom::AUTO_RELOAD | Fenom::FORCE_COMPILE);
	  }
	  catch(Fenom\Error\CompileException $exp)
	  {
	    throw $exp;
	  }
	}

	/**
	 * Метод получает объект шаблонизатора Fenom.
	 *
	 * @return \Fenom
	 */
	public function getFenom(): Fenom
	{
	  return $this->fenom;
	}
}