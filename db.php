<?php

$db_connection;
function initDB() {
    global $db_user,$db_password,$db,$db_cnnection;
    connectDB("127.0.0.1","3306",$db_user,$db_password,$db);
    
}
function connectDB($host,$port,$user,$password,$db) {
    global $db_connection;
    $db_connection = @new mysqli($host, $user, $password, $db, $port);
    if ($db_connection->connect_error) {
        die('Connect Error: ' . $db_connection->connect_error);
    }
}
function queryDB($SQL) {
    initDB();
    global $db_connection;
    $result = mysqli_fetch_assoc($db_connection->query($SQL, MYSQLI_USE_RESULT));
    return $result;
}
function queryDB_RAW($SQL) {
    initDB();
    global $db_connection;
    $result = $db_connection->query($SQL, MYSQLI_USE_RESULT);
    return $result;
}