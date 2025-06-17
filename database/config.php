<?php
// config.php

$host = 'localhost';  // Change this to your database host
$dbname = 'myproject'; // Database name
$username = 'root';    // Database username
$password = '';        // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

try {
    // Get all table names
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tables as $table) {
        // Check if the table has an AUTO_INCREMENT column
        $columns = $pdo->query("DESCRIBE $table")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($columns as $column) {
            if ($column['Extra'] === 'auto_increment') {
                // Reset the IDs in the table
                $pdo->exec("SET @num := 0; UPDATE $table SET {$column['Field']} = @num := (@num + 1);");
                
                // Reset the AUTO_INCREMENT value
                $pdo->exec("ALTER TABLE $table AUTO_INCREMENT = 1;");
            }
        }
    }
} catch (PDOException $e) {
    echo "Error resetting AUTO_INCREMENT: " . $e->getMessage();
}
?>
