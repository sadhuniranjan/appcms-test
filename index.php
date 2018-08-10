<!-- attach connection file -->
<?php include("connection.php"); ?>
<!-- connection file attached -->

<!-- function to get category name -->
    <?php 
        function get_cat($cat)
            {
                global $con;
                $sql = "SELECT title from categories WHERE id IN ($cat)";
                $result= mysqli_query($con,$sql);
                            
                if (mysqli_num_rows($result) > 0)
                    {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result))
                            {
                                global $final_var;
                                $final[]=$row['title'];
                                $final_var=implode(",<hr>",$final);
                            }
                    }
                    return $final_var;
            }
    ?>
<!-- function end -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Home - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- include header file -->
    <?php include("header.php"); ?>
    <!-- header file end -->


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Posts From Admin
                    <small></small>
                </h1>

                <!-- First Blog Post -->
                <div id="blog">
                <?php 
                    $sql = "SELECT * from posts;";
                    $result= mysqli_query($con,$sql);

                    if (mysqli_num_rows($result) > 0)
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            global $cat;
                            $id=$row['id'];
                            $url=$row['imageExtension'];
                            $cat=$row['category'];

                            echo "<h2>" .$row['title']. "</h2>";
                            echo "<h4>".$row['author']."</h4>" ;
                            echo "<img src='admin/images/fullsize/$url.jpg' height='300px' width='700px'>";
                            echo "<p>".$row['content']."</p>" ;
                            echo '<a class="btn btn-primary" href="#">';
                            echo "read more";
                            echo '</a>';
                            echo "<hr>";
                        }
                    }
                ?>
                

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
