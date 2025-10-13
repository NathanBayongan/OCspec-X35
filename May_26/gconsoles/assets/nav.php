<?php
echo "<div class='navi'>";//declares class
    echo "<nav>";

        echo "<ul>";//declares unordered list

            echo "<li><a href='index.php'>main</a></li>";

            if(!isset($_SESSION['user'])){
                echo "<li><a href='login.php'>login</a></li>";
                echo "<li><a href='register.php'>register</a></li>";
            } else {

                echo "<li><a href='register_console.php'>register_console</a></li>";
                echo "<li><a href='logout.php'>logout</a></li>";
            }

        echo "</ul>";//closes list

    echo "</nav>";
echo "</div>";
?>

