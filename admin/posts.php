<!-- attach connection file -->
<?php include("connection.php"); ?>
<!-- connection file attached -->
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
            <link href="css/main.css" rel="stylesheet">

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
                            <?php include("header.php"); ?>
                        <!-- header within div -->
                        <!-- Sidebar Menu Items -->
                            <?php include("sidebar.php"); ?>
                        <!-- /.navbar-collapse -->
                    </nav>
                    <!-- php code to add new categories -->
                        <?php
                            if(isset($_POST['submit']))
                            {
                                $post_title=$_POST['pname'];

                                $content=$_POST['content'];

                                $checkbox1 = implode(",",$_POST["checkbox1"]);

                                $final_check_values= mysqli_real_escape_string($con,$checkbox1);

                                $sql= "INSERT INTO posts (`title`,`content`,`category`) values ('$post_title','$content','$final_check_values')";

                                if(!mysqli_query($con,$sql))
                                {
                                    echo "category not added";
                                }
                                else
                                {
                                    // echo "category added";
                                }
                            }
                        ?>
                    <!-- add categories code end -->
                    <div id="page-wrapper">
                        <div class="container-fluid">
                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Add Posts
                                    </h1>
                                    <ol class="breadcrumb">
                                        <form action="posts.php" method="post" enctype="multipart/form-data">
                                            <label for="cname">Post Title</label><br>
                                            <input type="text" id="pname" name="pname"><br>
                                            <textarea id="content" name="content" placeholder="Write something about ypur post.." style="height:215px; width:500px;"></textarea><br>
                                                <!-- div categories dynamic -->    
                                                <div id="div_categories">
                                                    <?php
                                                        $sql1='SELECT title,id FROM categories';
                                                        $result= mysqli_query($con,$sql1);

                                                        if (mysqli_num_rows($result) > 0)
                                                        {
                                                        $i=1;
                                                        while($row = mysqli_fetch_assoc($result))
                                                        {
                                                            echo '<tr><td><input type="checkbox" id="'.$i.'" name="checkbox1[]" value="'.$row['id'].'" class="form-check-input"></td><td>',$row['title'],'</td></tr>';
                                                            echo "<br>";
                                                            $i++;
                                                        }
                                                        }
                                                    ?>
                                                </div>
                                                <!-- div categories end -->
                                                <label for="image">Featured Image</label><br>
                                                <input type="file" name="file"><br>
                                            <input type="submit" value="Submit" name="submit">
                                        </form>
                                    </ol>
                                </div>
                            </div>
                            <!-- /.row -->  
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                    <!-- /#page-wrapper -->
                </div>
                <!-- /#wrapper -->

                <!-- jQuery -->
                <script src="js/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="js/bootstrap.min.js"></script>

            </body>

        </html>
