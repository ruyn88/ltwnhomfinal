<?php 

	// Lấy các dữ liệu bên trang Thêm mới bài viết
	$tendm = $_POST['txtTenDm'];

	// Chàn dữ liệu vào bảng tbl_tin_tuc
	// Bước 1: Kết nối đến CSDL 
	include("../config/dbconfig.php");
	$ketnoi = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
	mysqli_set_charset($ketnoi, 'UTF8');

	// Bước 2: Chàn dữ liệu vào bảng Liên hệ
	$sql1= "SELECT tendanhmuc
	FROM danhmuc
	WHERE EXISTS 
	  (SELECT tendanhmuc 
	   FROM danhmuc
	   WHERE tendanhmuc='$tendm')";
	$row=mysqli_query($ketnoi, $sql1);
	if ($row==false){
		$sql = "
	INSERT INTO `danhmuc` (
		`danhmuc_id`, 
		`tendanhmuc`) 
	VALUES (
		NULL, 
	
		'".$tendm."')";
	
	// Xem câu lệnh SQL viết có đúng hay không?
	// echo $sql;

	// Cho thực thi câu lệnh SQL trên
	mysqli_query($ketnoi, $sql);
	echo '
		<script type="text/javascript">
			alert("Thêm mới danh mục thành công!!!");
			window.location.href="dm-list.php";
		</script>';
	}
	else {
		echo '
		<script type="text/javascript">
			alert("Danh mục đã tồn tại!!!");
			window.location.href="dm-them-moi.php";
		</script>';
	}
	
	
;?>