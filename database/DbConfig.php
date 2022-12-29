<?php

namespace database;

class DbConfig {
    public array $settings;
    
    public function __construct($file = 'database.ini') {
        
        $settings = parse_ini_file($file);

        if(!$settings) {
            $settings['driver'] = 'mysql';
            $settings['host'] = 'localhost';
            $settings['port'] = '';
            $settings['dbname'] = 'interview_db';
            $settings['username'] = 'root';
            $settings['password'] = '';

            $file = fopen('database.ini', 'w');
            fwrite($file, implode('\n', $settings));
            fclose($file);
        }

        $settings['dsn'] = "{$settings['driver']}:host={$settings['host']}"
                        . ($settings['port'] ? ";port={$settings['port']}":"")
                        . ";dbname={$settings['dbname']}";

        $this->settings = $settings;

    }
}