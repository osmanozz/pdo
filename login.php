<?php

$username = 'root';
$password = '';
$db = 'winkel';
$host = 'localhost:3307';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $username, $password, $options);
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username, password from user where username=:username and password=:password";
    $placeholders = [ 
        'username' => $username,
        'password' => $password
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($placeholders);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $row = $stmt->rowCount();

        if($row > 0) {
                if ($result['username'] == $username && $result['password'] == $password) {
                    header('Location:index.php');
                    session_start();
                    $_SESSION['username'] = $result['username'];
                }
            } else {
                echo "Error username or password not correct";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit">
    </form>
</body>
</html>