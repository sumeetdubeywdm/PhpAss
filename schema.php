<?php
require_once("setting.php");
try {
    $db = 'mysql:host=' . 'localhost' . ';dbname=' . 'phptest'. ';charset=utf8';
    $pdo = new PDO($db, DBUSER, DBPASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Issue -> Connection failed: " . $e->getMessage();
    die();
}

function createSchema()
{
    global $pdo;

    // Create the users table if it doesn't exist
    $sql = "
        CREATE TABLE IF NOT EXISTS 'Table-Name' (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fullname VARCHAR(100),
            username VARCHAR(20),
            emailid VARCHAR(30),
            userPhoneNumber VARCHAR(20),
            gender ENUM('Male', 'Female'),
            userPassword VARCHAR(200),
            created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            verify_token VARCHAR(200)

        )
    ";

    try {
        $pdo->exec($sql);
        echo "Schema created successfully!";
    } catch (PDOException $e) {
        echo "Issue -> Schema creation failed: " . $e->getMessage();
    }
}

function deleteSchema()
{
    global $pdo;

    // Drop all tables
    $sql = "DROP TABLE IF EXISTS 'Table-Name'";

    try {
        $pdo->exec($sql);
        echo "Schema deleted successfully!";
    } catch (PDOException $e) {
        echo "Issue -> Schema deletion failed: " . $e->getMessage();
    }
}

//  "create-schema" or "delete-schema"
if (isset($argv[1])) {
    if ($argv[1] === 'create-schema') {
        createSchema();
    } elseif ($argv[1] === 'delete-schema') {
        deleteSchema();
    } else {
        echo "Invalid command. Please try again";
    }
} else {
    echo "Invalid command. Please try again";
}


// command to create and delete table form php schema.php create-schema and for 
// delete php schema.php delete-schema .