<?php
    include 'connection.php';
    session_start();
    $error ='';
        
        if (isset($_POST['submit'])) {
            // echo "<script>alert('hey')</script>";
            $username = $_POST['username'];
            $password = $_POST['password'];
            //validation
            if (empty($username) || empty($password)) {
                 echo "<script>alert('Username and Password must be fill')</script>";
            }
            else{
                // cheeck if user exist
                $query = mysqli_query($con, "select * from login_tb where username = '$username' and password = '$password'") or die(mysqli_error($con));
                if (mysqli_num_rows($query) > 0) {
                    $_SESSION['user'] = '$username';
                    header('location:admin/dashboard.php');
                }
                else{
                    $message = 'Wrong Username or Password' .$username."".$password;
                    $error = '<div class=" alert alert-danger">'.$message.'</div>';
                }
            }
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
    form label{
        font-style: italic;
    }
    .headings{
        text-align: center;
        text-transform: uppercase;
        font-style: italic;
        color: #ccc;
        text-shadow: 2px 2px 5px darkblue;
        margin-bottom: -30px;
    }
</style>

</head>

<body>

    <div class="container" style="margin-top: 30px;">

        <div class="row">
        <h1 class="headings">Markarz Salam system</h1>
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-primary" style="margin-bottom: 40px;">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-style: italic; color: #fafafa; font-weight: bold;"> <i class="fa fa-lock"> </i> Sign In</h3>
                    </div>
                    <div class="panel-body">

                    <?php
                        echo $error;
                    ?>
                        <form role="form" method="post" action="">
                            <fieldset>
                                <div>
                                    <label>Username:</label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="username" name="username" type="text" required="required">
                                </div>

                                <div>
                                    <label>Password:</label>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" required="required">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                

                                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end of row-->

        <!-- testing -->
            <?php

                $fetch = mysqli_query($con, "select * from login_tb");
                $counter =1;
                if (mysqli_num_rows($fetch)<1) {
                    echo "Not fetch";
                }
                else{
                while ($rowss = mysqli_fetch_assoc($fetch)) {?>
                    <tr>
                     <td><?php echo $counter?></td>
                    <td><?=$rowss['username']?></td>
                    <td><?=$rowss['password']?></td>
                    </tr>
               <?php }
           }
            ?>
        <!-- testing ends -->
    </div>

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
