<?php
// Ket noi CSDL 




$servername="localhost";
$username="root";
$password="";
$dbname="sunphone";

// $servername="localhost";
// $username="id20134519_maianh";
// $password="M&~SHAnIRF97!y~V";
// $dbname="id20134519_sunphone";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die ("Connection failed: ".$conn->connect_error);
}
mysqli_query($conn,'set names utf8');
session_start();
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$wishlist = (isset($_SESSION['wishlist'])) ? $_SESSION['wishlist'] : [];

?>

<?php

if(isset($_POST['dangnhap_home'])) {  //tồn tại khi ấn submit đăng nhập
    $taikhoan = $_POST['email_login'];  //lấy lại email và pass
    $matkhau = $_POST['password_login'];
    // $input=$_POST['txtcaptcha'];
    // if($input!=$_SESSION['captcha']){
    // $_SESSION['message'] = "* Wrong captcha !!!";}
    if($taikhoan=='' || $matkhau ==''){
        echo '<script>alert("Làm ơn không để trống")</script>';
    }else{
        $sql_select_admin = mysqli_query($conn,"SELECT * FROM khachhang WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1"); //select ra kh có tk
        $count = mysqli_num_rows($sql_select_admin); //đếm sl dòng
        $row_dangnhap = mysqli_fetch_array($sql_select_admin);  //chuyển sang mảng
        if($count>0){  //nếu dòng >0 tức có tk
            $_SESSION['dangnhap_home'] = $row_dangnhap['hoten']; //nếu ok thì sẽ tạo 1 session phiên đăng nhập = tên khách hàng
            $_SESSION['khach_id'] = $row_dangnhap['khach_id']; //tạo 1 session phiên mãkh = khách hàng id
            $_SESSION['email'] = $row_dangnhap['email'];
            if(isset($_GET['action'])){
                $action = $_GET['action'];
                header('Location: '.$action.'.php');
            }else{
            header('Location: index.php');  //HƯỚNG VỀ TRANG INDEX NOT GIỎ HÀNG
            }

        }else{
            if($count==0)
            echo "<script> alert('Tài khoản hoặc mật khẩu bị sai') </script>";
            else
                echo "<script> alert('Đã xảy ra lỗi') </script>";   
        }

    }
}elseif(isset($_POST['dangky'])){
    $name = $_POST['hoten'];
     $phone = $_POST['sdt'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $note = $_POST['ghichu'];
     $address = $_POST['diachi'];
     $giaohang = $_POST['giaohang'];
     $sql_khachhang = mysqli_query($conn,"INSERT INTO khachhang(hoten,sdt,diachi,ghichu,email,password,giaohang) values ('$name','$phone','$address','$note','$email','$password','$giaohang')");
     $sql_select_khachhang = mysqli_query($conn,"SELECT * FROM khachhang ORDER BY khach_id DESC LIMIT 1");
     $row_khachhang = mysqli_fetch_array($sql_select_khachhang);
     $_SESSION['dangnhap_home'] = $name;
    $_SESSION['khach_id'] = $row_khachhang['khach_id'];
    $_SESSION['email'] = $row_khachhang['email'];

    header('Location:index.php?quanly=giohang');

}elseif(isset($_GET['dangxuat'])){ //tồn tại khi ấn đăng xuất
    $id = $_GET['dangxuat']; //lấy lại dangxuat=1
    if($id==1){
        unset($_SESSION['dangnhap_home']);
       session_destroy();
       $sql_delete_thanhtoan = mysqli_query($conn,"DELETE FROM giohang WHERE khach_id=1000"); //xoá hết giỏ hàng của khách hàng ko có tk
    }

}
?> 

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sun Phone </title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Sun Phone">    
    <meta name="author" content="p-themes">
    <!-- Favicon -->

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/haha.png">
    <link rel="icon" type="image/png" sizes="40x20" href="assets/images/haha.png">  
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/haha.png">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logo1.png">
    <link rel="icon" type="image/png" sizes="40x20" href="assets/images/logo1.png">  
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo1.png">

    <link rel="stylesheet" href="assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.countdown.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-3.css">
    <link rel="stylesheet" href="assets/css/demos/demo-3.css">
</head>



<!-- <div class="page"> -->
<div class="page-wrapper">
    <header class="header header-intro-clearance header-3">    
        <div class="header-top">
            <div class="container">
                <div class="header-left">
                    <a href="tel:#"><i class="icon-phone"></i>Call: 1800 6601</a>
                </div>
                <div class="header-right">
                    <ul class="top-menu">
                        <li>
                            <a href="#">Links</a>
                            <ul>

                                <li>
                                    <?php
                                        if(!isset($_SESSION['dangnhap_home'])){
                                            echo '<a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a>';
                                        };
                                    ?>
                                    
                                </li>
                                        <?php
						        if(isset($_SESSION['dangnhap_home'])){ 
                                
						        ?>
						        <li class="text-center">
                                    <a href="mypurchase.php?id=<?php echo $_SESSION['khach_id']?>" class="text-white">

						        	
						        	<i class="fas fa-truck mr-2"></i>Xem đơn hàng của : <?php echo $_SESSION['dangnhap_home'] ?></a>
						        </li>
						        <?php
						        }
						        ?>
                                <li>
                                    <?php  
                                    if(isset($_SESSION['dangnhap_home'])){ //tồn tại đăng nhập thì xuất hiện đăng xuất
                                        echo '<a href="index.php?quanly=giohang&dangxuat=1" class="text-center">Đăng xuất</a>' ;
                                    }else{
                                        echo '';
                                    }
                                    ?>                            
                                </li>
                            </ul>
                        </li>
                    </ul><!-- End .top-menu -->
                </div><!-- End .header-right -->
            </div><!-- End .container -->
        </div><!-- End .header-top -->
        
<!-- register -->
 
        <!-- log in -->

        <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Đăng nhập</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Đăng ký</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <label class="col-form-label">Email</label>
                                            <input type="text" class="form-control " placeholder=" " name="email_login" required="">
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label">Mật khẩu</label>
                                            <input type="password" class="form-control" placeholder=" " name="password_login" required="">
                                        </div>
                                        <div class="right-w3l">
                                            <!-- name= dangnhap_home, nếu tồn tại dangnhap_home phương thức post thì ghi đăng xuất, ngược lại -->
                                            <input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập"> 
                                        </div>
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#" method="post">
        			                	<div class="form-group">
        			                		<label class="col-form-label">Họ và tên</label>
        			                		<input type="text" class="form-control" placeholder=" " name="hoten" required="">
        			                	</div>
        			                	<div class="form-group">
        			                		<label class="col-form-label">Email</label>
        			                		<input type="email" class="form-control" placeholder=" " name="email" required="">
        			                	</div>
        			                	<div class="form-group">
        			                		<label class="col-form-label">Số điện thoại</label>
        			                		<input type="text" class="form-control" placeholder=" " name="sdt"  required="">
                                        </div>
        			                	<div class="form-group">
        			                		<label class="col-form-label">Địa chỉ</label>
        			                		<input type="text" class="form-control" placeholder=" " name="diachi"  required="">
        			                	</div>
        			                	<div class="form-group">
        			                		<label class="col-form-label">Password</label>
        			                		<input type="password" class="form-control" placeholder=" " name="password"  required="">
        			                		<input type="hidden" class="form-control" placeholder="" name="giaohang"  value="0">
        			                	</div>>
        			                	<div class="right-w3l">
        			                		<input type="submit" class="form-control" name="dangky" value="Đăng ký">
        			                	</div>
        			                </form>

                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

                            


            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        
                        <a href="index.php" class="logo">
                            <img src="assets/images/sunphone.png" alt="Molla Logo" width="250" height="150">
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            
                            <form method="get" action="timkiem.php" name="frm_search">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <label for="q" class="sr-only">Search</label>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                    <input id="search-quick" type="text" style="font-family:roboto; font-size:15px" class="form-control" name="ten" placeholder="Tìm kiếm sản phẩm ..." required>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                    <div class="dropdown cart-dropdown">
                        <a href="wishlist.php" class="dropdown-toggle">
                                <div class="icon">
                                    <i class="icon-heart-o"></i>
                                    <span class="cart-count"><?php echo count($wishlist)?></span>
                                </div>
                                <p style="font-family:roboto ">Yêu thích</p>
                            </a>    
                    </div>
                        <div class="dropdown cart-dropdown">
                        <a href="cart.php" class="dropdown-toggle">
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count"><?php echo count($cart)?></span>
                                </div>
                                <p style="font-family:roboto ">Giỏ hàng</p>
                            </a>    
                    </div><!-- End .header-right -->
                </div><!-- End .container --> 
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories"
                            style="font-family:roboto; font-size:20px"> Danh mục sản phẩm <i class="icon-angle-down"></i>
                            </a>

                            <div class="dropdown-menu">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">

                                        <?php
                                        $sql_category="SELECT * FROM danhmuc order by danhmuc_id asc";
                                        $result=$conn->query($sql_category);
                                        if($result ->num_rows >0)
                                        {
                                            $i=1;
                                            while($row_danhmuc=$result->fetch_assoc())
                                            {
                                                ?>
                                                <li class="item-lead"><a style="font-family:roboto" href="category.php?id=<?php echo $row_danhmuc['danhmuc_id'];?>"><?php echo $row_danhmuc['tendanhmuc']?></a></li>
                                                <?php
                                            $i++;
                                            }
                                        }
                                        ?>
                                                                           
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .header-left -->
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container active">
                                    <a href="index.php" style="font-family:roboto; font-size:20px">Trang chủ</a>

                                </li>
                                
                                <li>
                                    <a style="font-family:roboto; font-size:20px" href="listsanpham.php" >Sản phẩm</a>
                               </li>
                                <li>
                                    <a style="font-family:roboto; font-size:20px" href="blog-listing.php" >Tin tức</a>
                               </li>

                                <li>
                                <a href="baohanh.php" style="font-family:roboto; font-size:20px">Bảo hành</a>

                                </li>
                                <li>
                                <a href="contact.php" style="font-family:roboto; font-size:20px">Liên hệ</a>

                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-center -->

                    <div class="header-right">
                        <i class="la la-lightbulb-o" ></i><p style="font-family: roboto; font-size:15px">Xả kho<span class="highlight">&nbsp;Giảm tới 30%</span></p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->