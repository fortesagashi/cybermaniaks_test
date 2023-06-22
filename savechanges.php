<?php

session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $phone = $_POST["phone"];
    $phoneId = $_POST["phoneId"];
    $email = $_POST["email"];
    $emailId = $_POST["emailId"];
    $id = $_SESSION['userId'];

    // updating firstname, lastname, address, and zip_city fields
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];
    $zip_city = $_POST["zip_city"];
    $countryId = $_POST["country"];

    $updateUserQuery = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', address = '$address', zip_city = '$zip_city', country_id = '$countryId' WHERE id = $id";
    $updateUserResult = $mysqli->query($updateUserQuery);

    // updating and inserting phone numbers
    foreach ($phone as $key => $p) {
        $s = isset($_POST["hidePhoneNumber" . $phoneId[$key]]) && $_POST["hidePhoneNumber" . $phoneId[$key]] == 'on' ? 1 : 0;
        $query = '';

        if ($phoneId[$key]) {
            $query = "UPDATE phone_numbers SET phone_number = '$p', is_hidden = '$s' WHERE id = $phoneId[$key]";
        } else {
            $query = "INSERT INTO phone_numbers (user_id, phone_number, is_hidden) VALUES ($id, '$p', $s)";
        }

        $result = $mysqli->query($query);
    }

    // updating and inserting email addresses
    foreach ($email as $key => $p) {
        $s = isset($_POST["hideEmail" . $emailId[$key]]) && $_POST["hideEmail" . $emailId[$key]] == 'on' ? 1 : 0;
        $query = '';

        if ($emailId[$key]) {
            $query = "UPDATE email_addresses SET email = '$p', is_hidden = '$s' WHERE id = $emailId[$key]";
        } else {
            $query = "INSERT INTO email_addresses (user_id, email, is_hidden) VALUES ($id, '$p', $s)";
        }

        $result = $mysqli->query($query);
    }

    $publish = isset($_POST['publishContact']) && $_POST['publishContact'] == 'on' ? 1 : 0;

    // updating is_published variable in the users table
    $updateQuery = "UPDATE users SET is_published = $publish WHERE id = $id";
    $updateResult = $mysqli->query($updateQuery);

    header('Location: main.php');
}
