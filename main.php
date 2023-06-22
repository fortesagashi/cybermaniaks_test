<!DOCTYPE html>
<html>
<head>
    <title>Phonebook application</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // clickinh event to the links
            $("a.nav-link").click(function(e) {
                e.preventDefault(); // Prevent the default link behavior

                //getting page URL from link data attribute
                var page = $(this).data("page");

                // loading content into the block div
                loadContent(page);
            });

        // function to load content in the block div 
        function loadContent(page) {
            $.ajax({
                url: page,
                success: function(data) {
                    $("#block").html(data);
                }
            });
        }
    });
    </script>
    <link rel="stylesheet" type="text/css" href="style.css">
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
                <li><a href="?logout=true">Logout</a></li>
                <li><a href="#" class="nav-link" data-page="public_phonebook.php">Public Phonebook</a></li>
                <li><a href="#" class="nav-link" data-page="my_contact.php">My Contact</a></li>
            </ul>';
        } else {
            // user is not logged in
            echo '
            <ul>
                <li><a href="#" class="nav-link" data-page="login.php">Login</a></li>
                <li><a href="#" class="nav-link" data-page="public_phonebook.php">Public Phonebook</a></li>
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

</body>
</html>
