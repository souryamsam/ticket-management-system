<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Default connection group.
     */
    public string $defaultGroup = 'default';

    /**
     * SQLSRV database connection.
     */
    
    public $default = [
        'DSN'      => '',
        'hostname' => '10.100.10.10',  
        'username' => 'user_tkt',     
        'password' => 'asd-1234',
        'database' => 'TKT_COLLECTION',
        'DBDriver' => 'SQLSRV',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'), 
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433, 
    ];

    /**
     * Testing database connection.
     */
    public array $tests = [
        'DSN'          => '',
        'hostname'     => '127.0.0.1',
        'username'     => '',
        'password'     => '',
        'database'     => ':memory:',
        'DBDriver'     => 'SQLite3',
        'DBPrefix'     => 'db_',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'foreignKeys'  => true,
        'busyTimeout'  => 1000,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Use 'tests' group in testing environment.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
