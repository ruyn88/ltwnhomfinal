<?php 

	// Lấy các dữ liệu bên trang sửa sản phẩm
	

	$id = $_POST['txtID'];
	$tensp = $_POST['txtTensp'];
	$giagoc = $_POST['txtGiagoc'];
	$giaban = $_POST['txtGiaban'];
	$chitiet = $_POST['txtChitiet'];
	$color = $_POST['txtcolor'];
	$sl = $_POST['txtsl'];
	$dmsp = $_POST['txtDmsp'];


	// Upload hình ảnh
	$anhminhhoa = "images/" . basename($_FILES["txtAnhMinhHoa"]["name"]);
	$fileanhtam = $_FILES["txtAnhMinhHoa"]["tmp_name"];
	$result = move_uploaded_file($fileanhtam, $anhminhhoa);
	if(!$result) {
		$anhminhhoa=NULL;
	}

	
    $ketnoi = mysqli_connect("localhost","root","","sunphone");
	mysqli_set_charset($ketnoi, 'UTF8');

	// Bước 2: Chàn dữ liệu vào bảng tbl_sp
	if($anhminhhoa==NULL) {		
		$sql=" 
		 UPDATE `sanpham` SET
		`ten_sp`='".$tensp."',
		`chitiet`='".$chitiet."',
		`soluong`='".$sl."',
		`giaban`='".$giagoc."',
		`danhmuc_id`='".$dmsp."',
		`khuyenmai`='".$giaban."',
		`color`='".$color."'
		 WHERE `sanpham_id` = '".$id."'
		 ";

	} else {
		$sql=" 
		 UPDATE `sanpham` SET
		`ten_sp`='".$tensp."',
		`chitiet`='".$chitiet."',
		`soluong`='".$sl."',
		`hinh_anh`='".$anhminhhoa."',
		`giaban`='".$giagoc."',
		`danhmuc_id`='".$dmsp."',
		`khuyenmai`='".$giaban."',
		`color`='".$color."'
		 WHERE `sanpham_id` = '".$id."'
		 ";
	}
	
	// Xem câu lệnh SQL viết có đúng hay không?
	// echo $sql;

	// Cho thực thi câu lệnh SQL trên
	mysqli_query($ketnoi, $sql);
	echo '
		<script type="text/javascript">
			alert("Sửa sản phẩm thành công!!!");
			window.location.href="sanpham-list.php";
		</script>';
;?>