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
    <ul>
        <li><a href="#" onclick="loadContent('login.php')">Login</a></li>
        <li><a href="#" onclick="loadContent('public_phonebook.php')">Public Phonebook</a></li>
        <li><a href="#" onclick="loadContent('my_contact.php')">My contact</a></li>
    </ul>

    <!--- reloaded content --->
    <div id="block">
        
    </div>
</body>
</html>
