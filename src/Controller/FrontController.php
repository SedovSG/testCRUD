<?php
/**
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 */

declare(strict_types = 1);

namespace App\Controller;

/**
 * Класс фронт контроллера для маршрутизации приложения.
 *
 * @category   Controller
 * @author     Седов Станислав, <SedovSG@yandex.ru>
 * @copyright  Copyright (c) 2021 Sedov Stanislav
 * @license    https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause
 * @version    0.2.0
 */
class FrontController extends AbstractController
{
    /** @var string Имя действия контроллера по умолчанию. */
    const DEFAULT_ACTION     = "index";
    /** @var string Имя контроллера по умолчанию. */
    const DEFAULT_CONTROLLER = "Index";
    /** @var string Базовый путь. */
    const BASE_PATH = '';

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();

    /**
     * Метод создаёт экземпляр базового объекта класса контроллера.
     *
     * @param array $options Массив опций
     */
    public function __construct(array $options = array())
    {
        parent::__construct();

        if (empty($options))
        {
           $this->parseUri();
        }
        else
        {
            if (isset($options["controller"]))
            {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"]))
            {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"]))
            {
                $this->setParams($options["params"]);
            }
        }
    }

    /**
     * Метод разбирает URI текущей страницы на контроллеры и действия контроллеров.
     * Кроме того дополнительно разбираются параметры этого действия.
     */
    protected function parseUri()
    {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");

        if($path === self::BASE_PATH)
        {
        	$this->setController($this->controller);
        	$this->setAction($this->action);
        }
        else
        {
			if(self::BASE_PATH != '')
            {
				$path = trim(str_replace(self::BASE_PATH, "", $path), "/");
			}

        	@list($controller, $action, $params) = explode("/", $path, 3);

        	if (isset($controller))
            {
        	    $this->setController($controller);
        	}

        	if (isset($action))
            {
        	    $this->setAction($action);
        	}

        	if (isset($params))
            {
        	    $this->setParams(explode("/", $params));
        	}
        }
    }

    /**
     * Метод устанавливает имя контроллера текущего URI
     *
     * @param string $controller Имя контроллера
     *
     * @return FrontController
     */
    private function setController(string $controller): FrontController
    {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        $controller = "App\\Controller\\" . $controller;

        if (!class_exists($controller))
        {
        	header("HTTP/1.0 404 Not Found");

            $content = [
                'title' => "Ошибка 404",
                'message' => "Извините, но ничего не найдено"
            ];

        	$this->getFenom()->display('pages/error.tpl', $content);
        	exit();
    	}

        $this->controller = $controller;

        return $this;
    }

    /**
     * Метод устанавливает имя действия контроллера текущего URI
     *
     * @param string $controller Имя действия контроллера
     *
     * @return FrontController
     */
    private function setAction(string $action): FrontController
    {
        $reflector = new \ReflectionClass($this->controller);


        if (!$reflector->hasMethod($action))
        {
            header("HTTP/1.0 404 Not Found");

            $content = [
                'title' => "Ошибка 404",
                'message' => "Извините, но ничего не найдено"
            ];

            $this->getFenom()->display('pages/error.tpl', $content);
            exit();
    	}

        $this->action = $action;

        return $this;
    }

     /**
     * Метод устанавливает имя параметры действия контроллера текущего URI
     *
     * @param string $controller Имя параметры действия контроллера
     *
     * @return FrontController
     */
    private function setParams(array $params): FrontController
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Метод запускает действие контроллера.
     */
    public function run()
    {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}