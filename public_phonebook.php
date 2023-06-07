
<h2>Public Phonebook<h2>
<?php
// including the database connection
require_once "connection.php";

// getting the users' firstnames and lastnames
$query = "SELECT id, firstname, lastname FROM users";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        
        // printing the names in html tags
        echo "$id. $firstname $lastname <a href='#' onclick=''>Details</a>";
        echo "<br>";
    }
    $result->free();
} else {
    // handling error for executing the query
    echo "Error executing the query: " . $mysqli->error;
}


$mysqli->close();
?>
