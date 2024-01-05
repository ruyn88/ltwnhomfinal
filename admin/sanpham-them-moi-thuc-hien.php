<?php 

	// Lấy các dữ liệu bên trang Thêm mới 
	$tensp = $_POST['txtTensp'];
	$giagoc = $_POST['txtGiagoc'];
	$khuyenmai = $_POST['txtkhuyenmai'];
	$chitiet = $_POST['txtChitiet'];
	$color = $_POST['txtcolor'];
	$sl = $_POST['txtsl'];
	$dmspid = $_POST['txtDmsp'];
	$rate = $_POST['txtRate'];
	$kt = $_POST['txtKichthuoc'];
	$congnghe = $_POST['txtcongnghe'];
	$camsau= $_POST['txtcamsau'];
	$camtruoc= $_POST['txtcamtruoc'];
	$chip = $_POST['txtchip'];
	$pin = $_POST['txtpin'];
	$hdh = $_POST['txthdh'];
	$ram = $_POST['txtram'];
	$bonho = $_POST['txtbonho'];
	
	// Upload hình ảnh
	$anhminhhoa = "images/". basename($_FILES["txtAnhMinhHoa"]["name"]);
	$fileanhtam = $_FILES["txtAnhMinhHoa"]["tmp_name"];
	$result = move_uploaded_file($fileanhtam, $anhminhhoa);
	if(!$result) {
		$anhminhhoa=NULL;
	}
	// Anh zoom
	$anhzoom = "images/". basename($_FILES["txtAnhZoom"]["name"]);
	$fileanhzoom = $_FILES["txtAnhZoom"]["tmp_name"];
	$result1 = move_uploaded_file($fileanhzoom, $anhzoom);
	if(!$result1) {
		$anhzoom=NULL;
	}
	

	// Chàn dữ liệu vào bảng tbl_sp
	// Bước 1: Kết nối đến CSDL 
	include("../config/dbconfig.php");
	$ketnoi = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
	mysqli_set_charset($ketnoi, 'UTF8');

	// Bước 2: Chàn dữ liệu vào bảng tbl_sp
	$sql = "INSERT INTO `sanpham` (
		`sanpham_id`, 
		`ten_sp`,
		`giaban`,
		`danhmuc_id`, 
		`hinh_anh`,
		`chitiet`,
		`khuyenmai`,
		`color`,
		`soluong`,
		`rate`,
		`kichthuocman`,
		`congngheman`,
		`cam_sau`,
		`cam_truoc`,
		`chipset`,
		`pin`,
		`hedieuhanh`,
		`ram`,
		`bonhotrong`,
		`hinhanh_zoom`
		) 
	VALUES (
		NULL, 
		'".$tensp."',
		'".$giagoc."',
		'".$dmspid."',
		'".$anhminhhoa."',
		'".$chitiet."',
		'".$khuyenmai."',
		'".$color."',
		'".$sl."',
		'".$rate."',
		'".$kt."',
		'".$congnghe."',
		'".$camsau."',
		'".$camtruoc."',
		'".$chip."',
		'".$pin."', 
		'".$hdh."', 
		'".$ram."', 
		'".$bonho."',
		'".$anhzoom."'
		)";
	
	// Xem câu lệnh SQL viết có đúng hay không?
	// echo $sql;

	// Cho thực thi câu lệnh SQL trên
	mysqli_query($ketnoi, $sql);
	echo '
		<script type="text/javascript">
			alert("Thêm mới bài viết thành công!!!");
			window.location.href="sanpham-list.php";
		</script>';
;?>