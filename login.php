<?php 
session_start();
error_reporting(0);
include "includes/dbconnection.php";
if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query=mysqli_query($con,"SELECT * FROM users WHERE username='$username' and password='$password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
        $extra="index.php";
        $_SESSION['ulogin']=$_POST['username'];
        $_SESSION['id']=$num['id'];
        $_SESSION['username']=$num['fullname'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=1;
        $log=mysqli_query($con,"insert into userlog(username,userip,action) values('".$_SESSION['login']."','$uip','$status')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
    else
    {
        $extra="login.php";
        $username=$_POST['username'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=0;
        $log=mysqli_query($con,"insert into userlog(username,userip,action) values('$username','$uip','$action')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        $_SESSION['errmsg']="Tên đăng nhập hoặc mật khẩu không đúng";
        exit();
    }
}
if(isset($_POST['submit']))
{
    $userName=$_POST['userName'];
    echo  $userName;
    $password=$_POST['password'];
    echo  $password;
    $cusName=$_POST['cusName'];
    echo  $cusName;
    $email=$_POST['email'];
    echo  $email;
    $address=$_POST['address'];
    echo  $address;
    $phone=$_POST['phone'];
    echo  $phone;
    $query=mysqli_query($con,"INSERT INTO users(fullname,username,password,email,address,phone) values('$cusName','$userName','$password','$email', '$address','$phone')");
    if($query)
    {
        echo "<script>alert('Bạn đã đăng ký thành công');</script>";
    }
    else{
    echo "<script>alert('Đăng ký không thành công!');</script>";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Vian Shop - Đăng nhập</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style-index.css">
    <link rel="shortcut icon" type="image/png" href="image-page/logo2.PNG">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php 
    include "includes/top-header.php";
    include 'includes/header.php';
    ?>
    <hr>
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Đăng nhập</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot
                            password?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body">
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    <form id="loginform" class="form-horizontal" role="form" action='' method="POST">
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="username" value=""
                                placeholder="Tên đăng nhập">
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password"
                                placeholder="Mật khẩu">
                        </div>
                        <div class="input-group">
                            <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                            </div>
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls">
                                <button type='submit' id="btn-login" class="btn btn-success" name="login">Login </a>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                    Don't have an account!
                                    <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                                        Sign Up Here
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="signupbox" style="display:none; margin-top:50px"
            class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3>Đăng ký</h3>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="signupform" class="form-horizontal" role="form" action='' method="POST">
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="userName" placeholder="Tên đăng nhập"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Mật khẩu"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="cusName" placeholder="Họ và tên" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="address" placeholder="Địa chỉ" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <!-- Button -->
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="submit" class="btn btn-info"><i
                                        class="icon-hand-right" name="submit"></i> &nbsp Đăng ký</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:70%">
                                    Bạn có tài khoản!
                                    <a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">
                                        Đăng nhập
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>