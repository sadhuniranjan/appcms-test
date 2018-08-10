<!-- attach connection file -->
<?php include("connection.php"); ?>
<!-- connection file attached -->
<!-- delete post function -->
<?php  
    $id = $_GET['id'];
    $sql = "DELETE from posts WHERE id='$id'";
    mysqli_query($con,$sql);
?>
<!-- function end -->
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

            <title>SB Admin - Bootstrap Admin Template</title>

            <!-- Bootstrap Core CSS -->
            <link href="css/bootstrap.min.css" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="css/sb-admin.css" rel="stylesheet">

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

                    <div id="page-wrapper">
                        <div class="container-fluid">
                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Categories
                                        <small></small>
                                    </h1>
                                    <ol class="breadcrumb">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Author</th>
                                                <th>Content</th>
                                                <th>category Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php
                                            //table data
                                                $sql = "SELECT * from posts;";
                                                $result= mysqli_query($con,$sql);
                                                
                                                if (mysqli_num_rows($result) > 0)
                                                {
                                                // output data of each row
                                                while($row = mysqli_fetch_assoc($result))
                                                    {
                                                    global $cat;
                                                    $id=$row['id'];
                                                    $url=$row['imageExtension'];
                                                    $cat=$row['category'];
                                                    echo "<tr>";
                                                    echo "<td>" .$row['id']."</td>";
                                                    echo "<td>" .$row['title']."</td>";
                                                    echo "<td>" .$row['author']."</td>";
                                                    echo "<td>" .$row['content']."</td>";
                                                    echo "<td>".get_cat($cat)."</td>";
                                                    echo "<td><img src='images/fullsize/$url.jpg' height='150px' width='300px'></td>";
                                                    echo "<td><a href='edit_post.php?id=" .$row['id'] ."'>Edit post</a> <hr> <a href='delete_post.php?id=" .$row['id'] ."'>Delete post</a></td>";
                                                    echo "<td></td>";
                                                    echo "</tr>";
                                                    }
                                                }
                                        ?>
                                    </table>
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
