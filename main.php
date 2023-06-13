<!DOCTYPE html>
<html>
<head>
    <title>Phonebook application</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // loading content in the "block" div 
        function loadContent(page) {
            $.ajax({
                url: page,
                success: function(data) {
                    $("#block").html(data);
                }
            });
        }
    </script>
</head>
<body>
    <p>Phonebook</p>
    <!--- buttons for navigation --->
    <?php
        session_start();

        if (isset($_SESSION["username"])) {
            //user is logged in
            echo '
            <ul>
                <li><a href="#" onclick="loadContent(\'public_phonebook.php\')">Public Phonebook</a></li>
                <li><a href="#" onclick="loadContent(\'my_contact.php\')">My contact</a></li>
                <li><a href="#" onclick="logout()">Logout</a></li>
            </ul>';
        } else {
            // user is not logged in
            echo '
            <ul>
                <li><a href="#" onclick="loadContent(\'login.php\')">Login</a></li>
                <li><a href="#" onclick="loadContent(\'public_phonebook.php\')">Public Phonebook</a></li>
            </ul>';
        }

        if (isset($_GET['logout'])) {
            // removing the saved session
            session_destroy();
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    ?>

<div id="block">
        
</div>
<!---logout function--->
<script>
    function logout() {
        window.location.href = '<?php echo $_SERVER['PHP_SELF']; ?>?logout=true';
    }
</script>

</body>
</html>
