<?php
/**
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 */

declare(strict_types = 1);

namespace App\Model;

/**
 * Класс модели "Объекты".
 *
 * @category   Model
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 * @version    0.2.0
 */
class IndexModel extends AbstractModel
{
	/** @var \PDO Интерфейс для доступа к БД */
	protected $db = null;

	/**
     * Метод создаёт экземпляр базового объекта класса модели.
     */
	public function __construct()
	{
		parent::__construct();

		$this->db = $this->conectDB();
	}

    /**
     * Метод изменяет данные в БД
     *
     * @param array $data Пользовательские данные
     */
	public function changeObject(array $data): void
	{
		try
		{
			$sql = "UPDATE `users`, `objects`
			           SET `users`.`fname` = ?, `users`.`fname` = ?, `users`.`mname` = ?,
                           `objects`.`coordinates` = ?, `objects`.`address` = ?, `objects`.`name` = ?,
                           `objects`.`points` = ?
                     WHERE `objects`.`users_id` = `users`.`id` AND `objects`.`id` = ?";

			$this->db->beginTransaction();

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				$data['fname'], $data['lname'], $data['mname'], $data['coordinates'], $data['address'],
				$data['object_name'], $data['points'], $data['object_id']
			]);

			$this->db->commit();
		}
		catch(\Exception $e)
		{
			$this->db->rollBack();
			throw $e;
		}
	}

    /**
     * Метод добавляет данные в БД
     *
     * @param array $data Пользовательские данные
     */
	public function addObject(array $data): void
	{
		try
		{
			$sql = "INSERT INTO `users` SET `users`.`fname` = ?, `users`.`lname` = ?, `users`.`mname` = ?";

			$this->db->beginTransaction();

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				$data['fname'], $data['lname'], $data['mname']
			]);

			$lastInsertId = $this->db->lastInsertId();

			$sql = "INSERT INTO `objects`
			                SET `objects`.`coordinates` = ?, `objects`.`address` = ?, `objects`.`name` = ?,
			                    `objects`.`points` = ?, `objects`.`users_id` = ?";

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				$data['coordinates'], $data['address'], $data['object_name'], $data['points'], $lastInsertId
			]);

			$this->db->commit();
		}
		catch(\Exception $e)
		{
			$this->db->rollBack();
			throw $e;
		}
	}

    /**
     * Метод получет список всех объектов и их владельцев.
     *
     * @return array
     */
	public function getObjects(): array
	{
		try
		{
			$sql = "SELECT `users`.`id` as `users_id`, `users`.`fname`, `users`.`lname`, `users`.`mname`,
					       `objects`.`id` as `objects_id`, `objects`.`coordinates`, `objects`.`address`,
					       `objects`.`name`, `objects`.`points`
					  FROM `users`, `objects`
				     WHERE `objects`.`users_id` = `users`.`id`";

			$data = $this->db->query($sql)->fetchAll();
		}
		catch(\Exception $e)
		{
			throw $e;
		}

        return $data;
	}

    /**
     * Метод получает объект владельца.
     *
     * @param int $id Идентификатор объекта
     * @return array
     */
	public function getObject(int $id): array
	{
		try
		{
			$sql = "SELECT `users`.`id` AS `users_id`, `users`.`fname`, `users`.`lname`, `users`.`mname`,
					       `objects`.`id` AS `objects_id`, `objects`.`coordinates`, `objects`.`address`,
					       `objects`.`name` AS `object_name`, `objects`.`points`
					  FROM `users`, `objects`
				     WHERE `objects`.`users_id` = `users`.`id`
				       AND `objects`.`id` = ?";

			$stmt = $this->db->prepare($sql);
			$stmt->execute([$id]);
			$data = $stmt->fetch();
		}
		catch(\Exception $e)
		{
			throw $e;
		}

        return $data;
	}

    /**
     * Метод фильтрует данные об объектах.
     *
     * @param array $data Пользовательские данные
     * @return array
     */
	public function filterObjects(array $data): array
	{
		try
		{
			$sql = "SELECT `users`.`id` as `users_id`, `users`.`fname`, `users`.`lname`, `users`.`mname`,
					       `objects`.`id` as `objects_id`, `objects`.`coordinates`, `objects`.`address`,
					       `objects`.`name`, `objects`.`points`
					  FROM `users`, `objects`
				     WHERE `objects`.`users_id` = `users`.`id`
				      AND IF('{$data['lname']}' != '', `users`.`lname` = '{$data['lname']}', TRUE)
                      AND IF('{$data['fname']}' != '', `users`.`fname` = '{$data['fname']}', TRUE)
                      AND IF('{$data['mname']}' != '', `users`.`mname` = '{$data['mname']}', TRUE)
                      AND IF('{$data['object_name']}' != '', `objects`.`name` = '{$data['object_name']}', TRUE)
                      AND IF('{$data['address']}' != '', `objects`.`address` = '{$data['address']}', TRUE)
                      AND IF('{$data['coordinates']}' != '', `objects`.`coordinates` = '{$data['coordinates']}', TRUE)
                      AND IF('{$data['points']}' != '', `objects`.`points` = '{$data['points']}', TRUE)";

			$data = $this->db->query($sql)->fetchAll();
		}
		catch(\Exception $e)
		{
			throw $e;
		}

        return $data;
	}

	public function __destruct()
	{
		$this->disconnectDB();
	}
}
