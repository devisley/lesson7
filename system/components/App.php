<?php

namespace system\components;

/**
 * Class App
 * @package system\components
 *
 * @var $config array
 * @var $request Request
 * @var $connection \PDO
 * @var $controller Controller
 * @var $action string
 */
class App extends BaseObject {

    use Singleton; // singleton trait

    /**
     * @var array
     */
    public $config; // app global configuration

    /**
     * @var Request
     */
    public $request; // GET & POST handler

    /**
     * @var \PDO
     */
    public $connection; // database PDO object

    /**
     * @var App
     */
    public static $current; // singleton instance

    /**
     * App constructor (singleton)
     * @param array $config
     */
    public function __construct(array $config) {
        if (empty(static::$current)) {
            $this->config = $config;
            static::$current = $this;
        } else {
            return static::$current;
        }
    }

    /**
     * Start main loop
     * @param bool $withRouting
     */
    public function start($withRouting = true) {
        // connect to DB
        $this->connection = $this->getConnection();
        // get current request
        $this->request = new Request();

        if ($withRouting) {
            // initialize new router instance
            $router = new Router($this->request->route);
            // start routing
            $router->route();
        }
    }

    /**
     * Creates DB connection with PDO
     */
    private function getConnection() {
        $settings = $this->config['db'];

        $host = $settings['host'];
        $user = $settings['user'];
        $password = $settings['password'];
        $database = $settings['database'];

        try {
            $dbh = new \PDO("mysql:host={$host};dbname={$database}", $user, $password);
            return $dbh;
        } catch (\PDOException $error) {
            echo $error->getMessage();
            die();
        }
    }

}
