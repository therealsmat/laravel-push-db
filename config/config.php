<?php 

return [

    /**
     * Your database name
     */
    'db_database'          => getenv('DB_DATABASE'),

    /**
     * Your database username
     */
    'db_username'            => getenv('DB_USERNAME'),

    /**
     * Your database password
     */
    'db_password'            => getenv('DB_PASSWORD'),

    /**
     * Directory to save backups
     */
    'storage_directory'      => 'backups',

    /**
     * Path to store the exported database file
     */
    'file_name'            => 'database.sql'
];