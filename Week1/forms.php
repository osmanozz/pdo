<?php
// dit is GET method
    // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //     $name = $_GET['name'];
    //     $surname = $_GET['surname'];
    //     $age = $_GET['age'];
    //     $email = $_GET['email'];

    //     echo "Welkom $name $surname. U bent $age jaar oud en uw email adres is $email";
    // }

// dit is POST method

   // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $name = $POST['name'];
    //     $surname = $POST['surname'];
    //     $age = $POST['age'];
    //     $email = $POST['email'];

    //     echo "Welkom $name $surname. U bent $age jaar oud en uw email adres is $email";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forms</title>
</head>
<body>
    <!-- <form method="GET">
        <input type="text" name="name" placeholder="Naam">
        <input type="text" name="surname" placeholder="Achternaam">
        <input type="text" name="age" placeholder="Leeftijd">
        <input type="text" name="adress" placeholder="Adres">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="button">
    </form> -->

    <form method="POST">
        <input type="text" name="name" placeholder="Naam">
        <input type="text" name="surname" placeholder="Achternaam">
        <input type="text" name="age" placeholder="Leeftijd">
        <input type="text" name="adress" placeholder="Adres">
        <input type="text" name="email" placeholder="Email">
        <input type="submit" name="button">
    </form>
</body>
</html>