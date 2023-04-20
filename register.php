<?php
$db = 'winkel';
$user = 'root';
$host = 'localhost:3307';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;";
try 
{
     $pdo = new PDO($dsn, $user, $pass);
} 
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $check = 'SELECT username from user WHERE username=:username';
    $placeholders = [
        'username' => $_POST['username']	
    ];
    $stmt = $pdo->prepare($check);
    $stmt->execute($placeholders);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!is_array($result)) {
            $sql = "INSERT INTO user VALUES (:user_id, :username, :password)";
                $stmt = $pdo->prepare($sql);
                $placeholders = [
                    'user_id' => null,
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ];
                $stmt->execute($placeholders);
                $count = $stmt->rowCount();
                    if($count > 0) {
                        echo '<script>
                        alert("Success"); 
                        document.location="login.php";
                        </script>';
                    } 
        } else {
            echo 'niet gelukt username already taken';
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
    <h1>Register</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="username" required>
        <input type="text" name="password" placeholder="password" required>
        <input type="submit">
    </form>
</body>
</html>