<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHAT</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/contact.css">

    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    <script src="js/index.js" defer></script>
</head>
<body>
    <div id=container>
        <div class="row" id="row1">
            <img src="img/logo.svg" alt="logo" id="logo">
            <nav>
                <ul class="rowright">
                    <li> <a href="index.php" > Home </a></li>
                    <li> <a href="profile.php"> Profile </a></li>
                    <li> <a href="dm.php"> Direct messages </a></li>
                    <li> <a href="about.html"> About </a></li>
                    <li> <a href="contact.php" class="currentpage"> Contact </a></li>
                    <li> <a href="logout.php"> Logout </a></li> 
                </ul>
            </nav>
        </div>
        
        
        <div class="column row" id=chatsections> 
            <h1> Contact us </h1>
            <p>
                <?php
                    if (isset($_COOKIE["mesajcontact"])) {
                        echo $_COOKIE["mesajcontact"];
                        //stergem cookie-ul ca sa nu mai fie afisat mereu 
                        setcookie("mesajcontact", "", time() - 3600,"/");
                    }
                ?>
            </p>
            <section>
                <form action="server/contact.php" method="post">
                    <div class="formrow">
                        <label> Email-ul dvs</label> <input type="email" name="email">
                    </div>
                    <div class="formrow">
                        <label> Problema dumneavoastra </label> <textarea name="problem"> </textarea>
                    </div>
                    <div class="formrow">
                        <input type="submit" value="Trimite"> 
                    </div>
                </form>
            </section>
        </div>
      
        <footer> Copyright Silviu 2021 </footer>
    </div>  
</body>
</html>