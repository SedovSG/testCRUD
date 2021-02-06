<?php
/**
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 */

declare(strict_types = 1);

namespace App\Controller;

use App\Model\IndexModel;

/**
 * Класс фронт контроллера начальной страницы.
 *
 * @category   Controller
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 * @version    0.2.0
 */
class IndexController extends AbstractController
{
    /**
     * Метод создаёт экземпляр базового объекта класса контроллера.
     */
	public function __construct()
    {
        parent::__construct();
	}

    /**
     * Метод стартовой страницы
     */
	public function index(): void
	{
		try
		{
			$content = [
			  	"title"  => "Тестовое задание",
			  	"content" => "index",
			  	"objects" => (new IndexModel)->getObjects(),
			];
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();
		}

		$this->getFenom()->display("pages/main.tpl", $content);
	}

    /**
     * Метод сохранения изменений в БД
     */
	public function save(): void
	{
		$data = filter_input_array(INPUT_POST, [
			"lname"       => FILTER_SANITIZE_STRING,
			"fname"       => FILTER_SANITIZE_STRING,
			"mname"       => FILTER_SANITIZE_STRING,
			"object_name" => FILTER_SANITIZE_STRING,
			"address"     => FILTER_SANITIZE_STRING,
			"coordinates" => FILTER_SANITIZE_STRING,
			"points"      => FILTER_SANITIZE_STRING,
			"object_id"   => FILTER_SANITIZE_NUMBER_INT,
		]);

        try
        {
        	if($data['object_id'] > 0)
        	{
        		(new IndexModel)->changeObject($data);
        	}
        	else
        	{
        		(new IndexModel)->addObject($data);
        	}

        }
        catch (\Exception $e)
        {
        	echo $e->getMessage();
        }

		header("Location: /", true, 301);
		exit();
	}

    /**
     * Метод поиска объектов
     */
	public function search(): void
	{
		$data = filter_input_array(INPUT_POST, [
			"lname"       => FILTER_SANITIZE_STRING,
			"fname"       => FILTER_SANITIZE_STRING,
			"mname"       => FILTER_SANITIZE_STRING,
			"name_object" => FILTER_SANITIZE_STRING,
			"address"     => FILTER_SANITIZE_STRING,
			"coordinates" => FILTER_SANITIZE_STRING,
			"points"      => FILTER_SANITIZE_STRING,
		]);

		try
		{
			$content = [
				"title"   => "Тестовое задание | Найденные объекты",
				"content" => "search_object",
				"objects" => (new IndexModel)->filterObjects($data),
			];
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();
		}

		$this->getFenom()->display("pages/main.tpl", $content);
	}

    /**
     * Метод редактирования объекта
     *
     * @param int $param Идентификатор объекта
     */
	public function edit(int $param): void
	{
		$id = filter_var($param, FILTER_SANITIZE_NUMBER_INT);

		try
		{
			$content = [
				"title"   => "Тестовое задание | Редактирование объекта",
				"content" => "edit_object",
				"object"  => (new IndexModel)->getObject((int) $id),
			];
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();
		}

		$this->getFenom()->display("pages/main.tpl", $content);
	}

    /**
     * Метод добавления новых записей в БД
     */
	public function add(): void
	{
		try
		{
			$content = [
				"title"   => "Тестовое задание | Создание объекта",
				"content" => "add_object"
			];
		}
		catch(\Exception $e)
		{
			echo $e->getMessage();
		}

		$this->getFenom()->display("pages/main.tpl", $content);
	}

	public function delete()
	{
		# code...
	}
}