<?php
  include("../config/dbconfig.php");
  $conn = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
if($conn->connect_error){
    die ("Connection failed: ".$conn->connect_error);
}
mysqli_query($conn,'set names utf8');
	session_start();
    
?>
<?php
	// session_destroy();
	// unset('dangnhap');
	if(isset($_POST['dangnhap'])) {
		$taikhoan = $_POST['taikhoan'];
		$matkhau = $_POST['matkhau'];
		
		
		//header('location:index.php');}
		if($taikhoan=='' || $matkhau ==''){
			echo '<p>Xin nhập đủ</p>';
		}else
		{
			$sql_select_admin = mysqli_query($conn,"SELECT * FROM admin WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count>0 ){
				$_SESSION['dangnhap'] = $row_dangnhap['admin_name'];
				$_SESSION['admin_id'] = $row_dangnhap['admin_id'];
				header('Location:dashboard.php');
				
				}
			else{
				if($count==0)
				echo "<script> alert('Tài khoản hoặc mật khẩu bị sai') </script>";
				else
					echo "<script> alert('Đã xảy ra lỗi') </script>";
			
		}
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/logo1.png" />

    <title>Sun Phone |Trang đăng nhập </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

   
  </head>

  <body class="login" style="background-image: url('https://png.pngtree.com/background/20210715/original/pngtree-yellow-lanterns-watermelon-and-rice-dumplings-vietnamese-new-year-background-picture-image_1324245.jpg')";>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
               <div class="col-md-12"></div>
               <form action="" method="post">
            <br><br>
             <h1 style="color: black"><b>Hệ thống quản trị Sun Phone</b></h1>
              <div>
                <input type="text" class="form-control" placeholder="Tên đăng nhập" name="taikhoan" required=""/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Mật khẩu" name="matkhau" required="" />
              </div>
              <div>
                <button style="background: #FB9901;border-color: black;padding: 10px;color:  #fff;border-radius: 10px;" name="dangnhap" type="submit">Đăng nhập hệ thống</button>
              </div>

            </form>
          </section>
        </div>
      </div>

  </body>
</html>
