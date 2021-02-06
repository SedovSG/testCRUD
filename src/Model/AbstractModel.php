<?php

declare(strict_types = 1);

namespace App\Model;

class AbstractModel
{
	/** @var array Массив настроек для подключения к БД */
	private $configsDB = [];

	/** @var PDO Интерфейс для доступа к БД */
	private $pdo = null;

    /**
     * Метод создаёт экземпляр абстрактного класса модели.
     */
	public function __construct()
	{
		$this->configsDB = include_once ($_SERVER["DOCUMENT_ROOT"] . DIRECTORY_SEPARATOR . "phinx.php");
	}

    /**
     * Метод устанавливает соединение с БД через PDO
     *
     * @throws \PDOException
     * @return \PDO
     */
	public function conectDB(): \PDO
	{
		extract($this->configsDB["environments"][$this->configsDB["environments"]["default_environment"]]);

		try
		{
			$dsn = "{$adapter}:host={$host};port={$port};dbname={$name};charset={$charset}";

			$this->pdo = new \PDO($dsn,$user, $pass);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
		}
		catch(\PDOException $e)
		{
			throw $e;
		}

	    return $this->pdo;
	}

    /**
     * Метод закрывает соединение с БД
     */
	public function disconnectDB(): void
	{
		$this->pd = null;
	}

}
