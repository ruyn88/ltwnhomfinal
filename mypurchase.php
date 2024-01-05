<!DOCTYPE html>
<html lang="vi">
<meta charset="UTF-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        .example{
            margin: 20px;
			color: black;
        }
		div.col-md-12{
			padding: 0px
		}
    </style>
<?php
require("header.php");

?>


<body>

    <div class="page-wrapper">

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/nen.png')">
        		<div class="container">
        			<h1 class="page-title" style="font-family: roboto;">Lịch sử mua hàng<span>Sun Phone</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" ><a href="index.php" style="font-family: roboto">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page" style=" font-family: roboto">Lịch sử mua</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="ads-grid py-sm-5 py-4">
				<div class="container py-xl-4 py-lg-2">
					<div class="row">
						<!-- product left -->
						<div class="agileinfo-ads-display col-lg-9">
							<div class="wrapper">
								<!-- first section -->
								<?php
								if(isset($_GET['id'])){
									$id_khachhang = $_GET['id'];
								}else{
									$id_khachhang = '';
								}
								//$sql_select = mysqli_query($conn,"SELECT orders.order_id, hinh_anh, orders.ngaythang, ten_sp, order_detail.soluong, tongtien, gia FROM orders join order_detail on orders.order_id = order_detail.order_id join sanpham on order_detail.sanpham_id = sanpham.sanpham_id" ); 
								$sql_select = mysqli_query($conn,"SELECT * FROM order_detail join orders on order_detail.order_id= orders.order_id WHERE orders.khach_id='$id_khachhang' GROUP BY order_detail.order_id"); 

								?>
								    <div class="example" style=" font-family: roboto">
										<p style=" font-family: roboto; color: black; font-size: 20px">
											<?php
											if(isset($_SESSION['dangnhap_home'])){
												echo 'Khách hàng : '.$_SESSION['dangnhap_home'];
											} 
											?>
										</p><br>

										<div class="container" style=" font-family: roboto, color: black">
																						
												<table class="table table-bordered ">
													<tr>
														<th style="color:black; text-align: center">Thứ tự</th>
														<th style="color:black; text-align: center">Mã giao dịch</th>
														<th style="color:black; text-align: center">Ngày đặt</th>
														<th style="color:black; text-align: center">Tổng tiền</th>
														<th style="color:black; text-align: center">Chi tiết</th>
													</tr>
													<?php
													$i = 0;
													$dem = 0;
													while($row_donhang = mysqli_fetch_array($sql_select)){ 
														$i++;
													?> 
													<tr>
														<td style=" font-family: roboto; text-align: center"><?php echo $i; ?></td>

														<td style=" font-family: roboto; text-align: center"><?php echo $row_donhang['order_id']; ?></td>
														<td style=" font-family: roboto; text-align: center"><?php echo $row_donhang['ngaythang'] ?></td>
														<td rowspan="" style=" font-family: roboto; text-align: center"><?php echo number_format($row_donhang['tongtien'])?></td>
														<td style="text-align: center" ><a style=" font-family: roboto" href="mypurchase.php?id=<?php echo $_GET['id'] ?>&magd=<?php echo $row_donhang['order_id'] ?>">Xem chi tiết</a></td>
													
													</tr>
													<?php
													} 
													?> 
												</table>
											
									    
								
											<p style=" font-family: roboto; color: black; font-size: 20px">Chi tiết đơn hàng</p><br>
											<?php
											if(isset($_GET['magd'])){
												$magiaodich = $_GET['magd'];
											}else{
												$magiaodich = '';
											}
											//$sql_select = mysqli_query($con,"SELECT * FROM tbl_giaodich,tbl_khachhang,tbl_sanpham WHERE tbl_giaodich.sanpham_id=tbl_sanpham.sanpham_id AND tbl_khachhang.khachhang_id=tbl_giaodich.khachhang_id AND tbl_giaodich.magiaodich='$magiaodich' ORDER BY tbl_giaodich.giaodich_id DESC"); 
											$sql_select = mysqli_query($conn,"SELECT order_detail.order_id,order_detail.sanpham_id, hinh_anh, ten_sp, order_detail.soluong, giaban, khuyenmai FROM order_detail,orders,sanpham WHERE order_detail.sanpham_id=sanpham.sanpham_id AND orders.order_id=order_detail.order_id AND order_detail.order_id='$magiaodich' ORDER BY order_detail.order_id DESC");
										
											?> 
											<table class="table table-bordered ">
												<tr>
													<th style="color:black; font-family: roboto; text-align: center">Thứ tự</th>
													<th style="color:black; font-family: roboto; text-align: center">Mã giao dịch</th>													
													<th style="color:black; font-family: roboto; text-align: center">Tên sản phẩm</th>
													<th style="color:black; font-family: roboto; text-align: center">Số lượng</th>
													<th style="color:black; font-family: roboto; text-align: center">Giá</th>


												</tr>
												<?php
												$i = 0;
												while($row_donhang = mysqli_fetch_array($sql_select)){ 
													$i++;
												?> 
												<tr>
													<td style=" font-family: roboto; text-align: center"><?php echo $i; ?></td>
													<td style=" font-family: roboto; text-align: center"><?php echo $row_donhang['order_id']; ?></td>
													<td style=" font-family: roboto; text-align: center"><a href="product.php?id=<?php echo $row_donhang["sanpham_id"];?>" style="font-family: roboto"><?php echo $row_donhang['ten_sp']; ?></a></td>									
													<td style=" font-family: roboto; text-align: center"><?php echo $row_donhang['soluong'] ?></td>
													<td style=" font-family: roboto; text-align: center"><?php if (number_format($row_donhang["khuyenmai"])>0) echo number_format($row_donhang["khuyenmai"]).'₫'; else echo number_format($row_donhang["giaban"]).'₫';?></td>
												
												

												</tr>
												<?php
												} 
												?> 
											</table>
							
										</div>
        							</div>
									</div>
									</div>
								<!-- //first section -->
							</div>
						</div>
						<!-- //product left -->
						<!-- product right -->	
					</div>
				</div>
			</div>
		</main><!-- End .main -->
    </div>

<?php
require("footer.php");
?>
    <!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>


<!-- molla/checkout.html  22 Nov 2019 09:55:06 GMT -->
</html>