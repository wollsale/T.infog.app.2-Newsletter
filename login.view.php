<?php include 'subscribe.php'; ?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <link rel="stylesheet" href="stylesheets/screen.css">
    <link href='http://fonts.googleapis.com/css?family=Yantramanav:700,300,400' rel='stylesheet' type='text/css'>
</head>

<body>

    <div class="container">

        <main>
            <form class="adminlogin" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post">
                <div class="icon"></div>
               <h1>Admin</h1>
                <ol>
                    <li>
                        <label for="username">UserName * :</label>
                        <input type="text" name="username" id="username">
                        <p for="name" class="error"><?php echo $errors["username"]; ?></p>
                    </li>
                    <li>
                        <label for="password">Password * :</label>
                        <input type="password" name="password" id="password">
                        <p for="email" class="error"><?php echo $errors["password"]; ?></p>
                        <p class="error"><?php echo $error["wrong"]; ?></p>
                        
                    </li>
                    <li>
                        <input type="submit" name="Submit" value="Log In">
                    </li>
                </ol>
            </form>
        </main>

    </div>


</body>

</html>