<?php
$_REQUEST['user']=!empty($_REQUEST['user']) ? $_REQUEST['user'] : '';
$_REQUEST['password']=!empty($_REQUEST['password']) ? $_REQUEST['password'] : '';
?>
<!DOCTYPE html>
<html lang="en">
        <head>
                <meta charset="utf-8">
                <link rel="stylesheet" type="text/css" href="style.css" />
                <title>Game Hub</title>
        </head>
        <body>
                <header><h1>Game Hub</h1></header>
                <!--
                <nav>
                        <ul>
                        <li> <a href="">Class</a>
                        <li> <a href="">Profile</a>
                        <li> <a href="">Logout</a>
                        </ul>
                </nav>
                -->
                <main>
                        <h1>User Profile</h1>
                        <form action="index.php" method="post">
                                <legend>Profile</legend>
                                <table>
                                        <!-- Trick below to re-fill the user form field -->
                                        <tr><th><label for="user">User</label></th><td><input type="text" name="user" value="<?php echo($_REQUEST['user']); ?>" /></td></tr>
                                        <tr><th><label for="password">Password</label></th><td> <input type="password" name="password" /></td></tr>
                                        <tr><th>&nbsp;</th><td><input type="submit" name="submit" value="Change Password" /></td></tr>
                                        <tr><th>&nbsp;</th><td><?php echo(view_errors($errors)); ?></td></tr>
                                </table>
                        </form>
                        <form action="index.php" method="post">
                                <input type="submit" name="back" value="Go Back?"/>
                        </form>
                </main>
                <footer>
                </footer>
        </body>
</html>
