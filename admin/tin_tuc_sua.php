
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logo1.png"/>

    <title>Sun Phone| Trang sửa tin tức</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/9j2gtkk3vfkw13r44vxngdwafrideig3epiwyocdrkxngktd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  
  <script>
          tinymce.init({
            selector: '#txtNoiDung'
          });
        </script>  
  </head>

  <body class="nav-md" style="background-color:#212529;" >
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <?php 
                  include("top.php");

            // Bước 1: Kết nối đến CSDL 
                  include("../config/dbconfig.php");
                  $ketnoi = mysqli_connect($host, $dbusername, $dbpassword, $dbname);

                  // Bước 2: Lấy dữ liệu từ trên đường đẫn
                  $id = $_GET["id"];

                  //Bước 3: Hiển thị các dữ liệu trong bảng tbl_tin_tuc ra đây
                  $sql = "
                    SELECT * 
                    FROM blog 
                    WHERE blog_id = ".$id;
                  
                  $dulieu = mysqli_query($ketnoi, $sql);

                  $row = mysqli_fetch_array($dulieu);
          ;?>
            <!-- page content -->
            <div class="right_col" role="main">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h1>SỬA TIN TỨC</h1>
                  <form method="post" action="tin_tuc_sua_thuc_hien.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tiêu đề tin tức<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input name="txtTieuDe" type="text" class="form-control" value='<?php echo $row["blog_name"];?>'>
                    </div>
                  </div>
  
                  <br><br><br>
           
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Ảnh minh họa</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input name="txtAnhMinhHoa" type="file" class="form-control" value="/<?php echo $row['bog_image'];?>">
                    </div>
                  </div>
                  <br><br><br>

                  <div>
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nội dung tin tức</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <textarea name="txtNoiDung" class="form-control col-md-7 col-xs-12" id = "txtNoiDung" name="txtNoiDung" placeholder = "Nội dung chi tiết bài viết" ><?php echo $row["blog_noidung"];?></textarea>
                    </div>
                  </div>
                  <br><br><br><br>

                  <div class="form-group" style="float: right;">
                    <input type="hidden" name="txtID" value='<?php echo $row["blog_id"];?>'>
                    <button type="submit">Sửa tin tức</button>
                  </div>
                  <br>

                </div>
                </form>
              </div>
            </div>
            <!-- /page content -->

            <?php include("bottom.php");?>
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../vendors/Flot/jquery.flot.js"></script>
    <script src="../vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../vendors/Flot/jquery.flot.time.js"></script>
    <script src="../vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
  </body>
</html>