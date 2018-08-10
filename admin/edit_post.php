<!-- attach connection file -->
<?php include("connection.php"); ?>
<!-- connection file attached -->

<!-- edit post php code -->
<?php
    $id='';
    $id=$_GET["id"];
    

    if(isset($_GET["id"]))
    {
        $sql = "SELECT * FROM posts where id=". $_GET['id'];
        $result= mysqli_query($con,$sql);
        $var=mysqli_fetch_assoc($result);

        $post_title=$var["title"];

        $author_name=$var["author"];

        $content=$var['content'];

        $category=$var['category'];
    }
?> 
<!-- php code end -->
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
                                $target_dir = "images/fullsize/";
                                $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
                                $uploadOk = 1;
                                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                                if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
                                    echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
                                } else {
                                    echo "Sorry, there was an error uploading your file.";
                                }

                                $image=basename( $_FILES["imageUpload"]["name"],".jpg");

                                $post_title=$_POST['pname'];

                                $author_name=$_POST['aname'];

                                $content=$_POST['content'];

                                $checkbox1 = implode(",",$_POST["checkbox1"]);

                                $final_check_values= mysqli_real_escape_string($con,$checkbox1);

                                $sql1= "UPDATE posts SET title = '$post_title', author='$author_name',content='$content',category='$final_check_values',imageExtension='$image' where id=".$id;
                                $run_query = mysqli_query($con,$sql1);
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
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <label for="cname">Post Title</label><br>
                                            <input type="text" id="pname" name="pname" value="<?php echo $post_title; ?>" ><br>
                                            <label for="aname">Author Name</label><br>
                                            <input type="text" id="aname" name="aname" value="<?php echo $author_name; ?>"><br>
                                            <textarea id="content" name="content"  style="height:215px; width:500px;"><?php echo $content; ?></textarea><br>
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
                                                <input type="file" name="imageUpload" id="imageUpload"><br>
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
