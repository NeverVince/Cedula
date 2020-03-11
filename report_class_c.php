<?php
    include 'session.php';

    if(!isset($_SESSION['login_user']))
        header("location: index.php");
    if($_SESSION['login_user'] == "admin")
        header("location: admin_class_a.php");

    $con = mysqli_connect('127.0.0.1','root','');
    mysqli_select_db($con,'cedula');
    if(!$con)
        echo 'ERROR: Not connected to server.';
    if (!mysqli_select_db($con,'cedula'))
        echo 'ERROR: Database not selected.';
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
        <div class="mainclassa">
            <div class="container">
                <div class="navbar">
                    <div class="logo-pic"><img src="img/Clogo.png" height="25px" width="25px"></div>
                        <div class="logo"><a href="home.php"><i>manila</i>&nbsp;<b>cedula</b></a></div>
                            <div class="menu">
                            <ul>
                                <li id="btn1"><a class="btn" href="#"><b>How&nbsp;to&nbsp;Use</b></a></li>
                                <!-- <li><a class="btn" href=""><b>Procedure</b></a></li> -->
                                <!-- I just set this as comment in order to include "Settings" option. I know this ("Procedure" option) is important.
                                Maybe you could place all five options without affecting the overall design of the panel. -H -->
                                <li><a class="btn" href="#"><b>About</b></a></li>
                                <li><a class="btn" href="#"><b>Settings</b></a></li> <!-- Change password feature. Yay or  nay? -H-->
                                <li><a class="btn" href="logout.php"><b>Logout</b></a></li>
                                <!--
                                <li id="btn1"><a class="btn" href=""><b>How&nbsp;to&nbsp;Use</b></a></li>
                                <li><a class="btn" href=""><b>Procedure</b></a></li>
                                <li><a class="btn" href=""><b>About</b></a></li>
                                -->
                            </ul>
                            </div>
                        </div>
                    </div>
                    <div class="maincontent_form">
                        <h1>Class C: Form Summary</h1>
                        <!-- <h2><i>(Corporation)</i></h2><br> -->
                        <br>
                                    <div class="menu_report_a">
                                    <p align="center">
                                    <?php
                                        if (!isset($_POST['fname']))
                                        {
                                            if ($_SESSION['currentPage'] == 'home')
                                                header("location: home.php");
                                            else if ($_SESSION['currentPage'] == 'form_class_a')
                                                header("location: form_class_a.php");
                                            else if ($_SESSION['currentPage'] == 'form_class_ab')
                                                header("location: form_class_ab.php");
                                            else if ($_SESSION['currentPage'] == 'form_class_c')
                                                header("location: form_class_c.php");
                                        }
                                        else
                                        {
                                            $firstName = $_POST['fname'];
                                            $middle = $_POST['minitial'];
                                            $lastName = $_POST['lname'];
                                            $corporation = $_POST['corporation'];
                                            $homeAddress = $_POST['address'];
                                            $dateOfBirth = $_POST['birthday'];
                                            $placeOfRegistration = $_POST['placeofreg'];
                                            $natureOfBusiness = $_POST['natureofbusiness'];
                                            $nbspTIN = $_POST['nbsptin'];
                                            $assessedValueOfProp = $_POST['assessedval'];
                                            $grossEarningsFromBix = $_POST['grossearn'];
                                            date_default_timezone_set("Asia/Brunei");
                                            $dateProcessed = date("Y-m-d");
                                            $timeProcessed = date("H:i:s");
                                        
                                            $sql1 = "INSERT INTO classc (firstName, middle, lastName, corporation, addressOfCorporation, dateOfRegistration, placeOfRegistration,
                                            natureOfBusiness, nbspTIN, assessedRealProperty, grossEarnings, dateProcessed, timeProcessed) VALUES ('$firstName', '$middle', '$lastName', '$corporation',
                                            '$homeAddress', '$dateOfBirth', '$placeOfRegistration', '$natureOfBusiness', '$nbspTIN', '$assessedValueOfProp', '$grossEarningsFromBix', '$dateProcessed', '$timeProcessed')";

                                        if (mysqli_query($con, $sql1))
                                        {
                                            $sql2 = "SELECT COUNT(*) FROM classc WHERE dateProcessed LIKE '$dateProcessed'";
                                            $result = mysqli_query($con, $sql2);
                                            $rows = mysqli_fetch_assoc($result);
                                            $queueingNo = $rows['COUNT(*)'];

                                            if($queueingNo/100==1)
                                                $queueingNo=100;
                                            else if ($queueingNo/100 < 1)
                                                if ($queueingNo/10 < 1)
                                                    $queue = "00";
                                                else
                                                    $queue = "0";
                                            else
                                                $queue = "";

                                            $queueingNo = "CC-" . $queue . $queueingNo%100;
                                            echo "<h1> Queue Number: " . $queueingNo . "</h1>";
                                            echo "<strong>Timestamp: </strong>" . $dateProcessed . " " . $timeProcessed;
                                            echo "<br/><br/>";
                                            echo "<strong>President/Authorized Representative: </strong>" . $firstName . " " . $middle . " " . $lastName;
                                            echo "<br/>";
                                            echo "<strong>Corporation: </strong>" . $corporation;
                                            echo "<br/>";
                                            echo "<strong>Home Address: </strong>" . $homeAddress;
                                            echo "<br/>";
                                            echo "<strong>Date of Birth: </strong>" . $dateOfBirth;
                                            echo "<br/>";
                                            echo "<strong>Place of Registration: </strong>" . $placeOfRegistration;
                                            echo "<br/>";
                                            echo "<strong>Nature of Business: </strong>" . $natureOfBusiness;
                                            echo "<br/>";
                                            echo "<strong>NBSP TIN: </strong>" . $nbspTIN;
                                            echo "<br/>";
                                            echo "<strong>Total Assessed Value of Real Property: </strong>" . "PHP " . sprintf("%.2f", $assessedValueOfProp);
                                            echo "<br/>";
                                            echo "<strong>Total Gross Earnings from Business: </strong>" . "PHP " . sprintf("%.2f", $grossEarningsFromBix);
                                            echo "<br/><br/>";

                                            $sql3 = "SET @count = 0";
                                            $sql4 = "UPDATE classc SET classc.id = @count:= @count + 1";
                                            $sql5 = "ALTER TABLE classc AUTO_INCREMENT = 1";
                                            mysqli_query($con, $sql3);
                                            mysqli_query($con, $sql4);
                                            mysqli_query($con, $sql5);
                                        }
                                        else
                                            echo "Your data was unsuccessfully uploaded to the database. Please reach out our staff regarding this matter.";
                                        }
                                    ?>
                                    </p>
                            <p align="center">
                            <br>
                            <a class="printbtn" target="blank" style="cursor: pointer" onclick="window.print();" align="center">Print</a>
                        </p>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/><br/>
    </body>
</html>