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
    <p class="feedbackunsubscribe"><?php echo $feedback['confirm']; ?></p>

    <div class="container">

        <main>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="icon"></div>
                <h1>Newsletter</h1>
                <div class="wrapper">
                    <label for="name">Votre nom</label>
                    <p for="name" class="error"><?php echo $error["name"]; ?></p>
                    <input type="text" name="name">
                    <label for="email">Votre email</label>
                    <p for="name" class="error"><?php echo $error["email"]; ?></p>
                    <p for="name" class="error"><?php echo $error["doublon"]; ?></p>
                    <input type="text" name="email">
                    <input type="submit" name="subscribe" value="S'inscrire">
                </div>
            </form>
            
            <a href="admin.php" class="admin">admin</a>
            <a href="unsubscribe.php" class="unsubscribe">Unsubscribe</a>
        </main>

    </div>


</body>

</html>