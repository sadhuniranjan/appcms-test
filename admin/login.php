<!-- Connection to database -->
<?php 
    session_start();
    global $con;
    include("connection.php");
    if(isset($_SESSION['user'])!="")
    {
        header("Location: index.php");
    }

    if(isset($_POST['submit']))
    {
        $email = mysqli_real_escape_string($con,$_POST['form-username']);
        $upass = mysqli_real_escape_string($con,$_POST['form-password']);

        $email = trim($email);
        $upass = trim($upass);

        "SELECT * FROM users WHERE email_id='$email'";
        $res=mysqli_query($con,"SELECT * FROM users WHERE email_id='$email'");
        $row=mysqli_fetch_array($res);

        $count = mysqli_num_rows($res);

        if($count == 1 && $row['password']==$upass)
        {
            $_SESSION['user'] = $row['id'];

            $res2=mysqli_query($con,"SELECT * FROM users WHERE user_id='".$_SESSION['user']."'");
            $row2=mysqli_fetch_array($res2);

            $_SESSION['role']==1;

            header("Location: index.php");
        }
        else
        {
        ?>
        <script>alert('Username / Password Seems Wrong !');</script>
        <?php
        }
    }
?>

<!-- connection code end -->

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>SB Admin - Bootstrap Admin Template</title>

            <!-- Bootstrap Core CSS -->
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="css/sb-admin.css" rel="stylesheet">
            <link href="css/login.css" rel="stylesheet">

            <!-- Custom Fonts -->
            <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

        </head>

            <body>
                <div id="wrapper">
                    <!-- Navigation -->
                    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <!-- header within div -->
                            <?php include("login_header.php"); ?>
                        <!-- header within div -->
                        <!-- Sidebar Menu Items -->
                            <!--no sidebar needed.-->
                        <!-- /.navbar-collapse -->
                    </nav>
                <!-- jQuery -->
                <script src="js/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="js/bootstrap.min.js"></script>

                <!-- login form -->
                 

                <form action="index.php" method="post">

                    <div class="container">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="form-username" required><br>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="form-password" required><br>
                            
                        <button type="submit" name="submit" value="submit">Login</button>

                    </div>
                </form>
                <!-- login form end -->

            </body>

        </html>
