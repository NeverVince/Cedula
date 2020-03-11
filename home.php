<?php
    include 'session.php';
    $_SESSION['currentPage'] = 'home';

    if(!isset($_SESSION['login_user']))
        header("location: index.php");
    if($_SESSION['login_user'] == 'admin')
        header("location: admin_class_a.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meat name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Manila City Hall: Cedula</title>
        <link rel="stylesheet" href="style.css" />
        <style>
            @import url('https://fonts.googleapis.com/css?family=Montserrat|Muli|Roboto&display=swap');
        </style>
    </head>
    <body>
        <div class="main">
            <div class="container_all">
                <div class="navbar">
                        <div class="logo-pic"><img src="img/Clogo.png" height="25px" width="25px"></div>
                        <div class="logo"><a href=""><i>manila</i>&nbsp;<b>cedula</b></a></div>
                    <div class="menu">
                        <ul>
                            <li id="btn1"><a class="btn" href=""><b>How&nbsp;to&nbsp;Use</b></a></li>
                            <!-- <li><a class="btn" href=""><b>Procedure</b></a></li> -->
                            <li><a class="btn" href=""><b>About</b></a></li>
                            <li><a class="btn" href=""><b>Settings</b></a></li> <!-- Change password feature. Yay or  nay? -H-->
                            <li><a class="btn" href="logout.php"><b>Logout</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="main-text">
                    <h1>Manila City Hall</h1>
                    <h2>Community Tax Certificate</h2>
                    <br>
                    <div class="description">
                        Choose your class type on the dropdown below.
                    </div>
                    <br><br>
                    <div class="dropdown">
                        <form id="chooseclasstype" action="" method="POST">
                            <select id="classtypelist" class="classtypes" name="classtypes" onchange="selectClassType()">
                                <option selected disabled>Please select a class.</option>
                                <option value="classa">Class A</option>
                                <option value="classab">Class AB</option>
                                <option value="classc">Class C</option>
                            </select>
                            <br><br>
                            <input type="submit" value="Proceed" class="proceedbtn">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>