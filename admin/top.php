  <style>
    .hinhanh {text-align: center;
      color:white;
      padding-top: 10px;
      padding-bottom: 0px;
    }
  </style>      
  <?php
                      // Bước 1: Kết nối đến CSDL
                      include("../config/dbconfig.php");
                      $ketnoi = mysqli_connect($host, $dbusername, $dbpassword, $dbname);
                      mysqli_set_charset($ketnoi, 'UTF8');

                      //Bước 2: Hiển thị các dữ liệu trong bảng tbl_admin ra đây
                      $sql = "
                        SELECT * 
                        FROM admin";
                      $dulieu = mysqli_query($ketnoi, $sql);
                      $row = mysqli_fetch_array($dulieu);
    ?>    
            
            <div class="logo"><a href="index.php" class="site_title"> <img style="width: 90%; height: auto;" src="images/sunphone.png"></a></div>
            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix" >
              <div class="hinhanh">
                <span>Xin chào</span>
                <h2><?php echo $row["username"];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
           

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
              <div class="menu_section">
                
                <ul class="nav side-menu">
                  <li><a  href="./dashboard.php"><i class="fa fa-home"></i>Hệ thống quản lý</a></li>
            
                  <li><a><i class="fa fa-desktop"></i> Quản trị Tin tức <span  class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" >
                      <li><a href="tin_tuc_them_moi.php">Tạo tin tức mới</a></li>
                      <li><a href="tin_tuc_quan_tri.php">Quản trị tin tức</a></li>
                    </ul>
                  </li>
                   <li><a><i class="fa fa-table"></i> Quản trị Người dùng<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="admin-them-moi.php">Tạo Người dùng mới </a></li>
                      <li><a href="admin-list.php">Quản trị Người dùng</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-table"></i> Quản trị Sản phẩm <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="sanpham-them-moi.php">Tạo sản phẩm mới</a></li>
                      <li><a href="sanpham-list.php">Quản trị sản phẩm</a></li>
                    </ul>
                  </li>
                      <li><a><i class="fa fa-table"></i> Quản trị Danh mục  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="dm-them-moi.php">Tạo danh mục</a></li>
                      <li><a href="dm-list.php">Danh sách danh mục</a></li>
                    </ul>
                  </li>

            

                  <li><a><i class="fa fa-table"></i> Quản trị Sự kiện <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="su-kien-them-moi.php">Tạo Sự kiện mới </a></li>
                      <li><a href="su-kien-list.php">Quản trị Sự kiện</a></li>
                    </ul>
                  </li>
                      
                  </li>
                  <li><a href="quan_tri_lien_he.php"><i class="fa fa-bar-chart-o"></i> Quản trị Liên hệ</a></li>
                  <li><a href="order_list.php"><i class="fa fa-bar-chart-o"></i>Quản trị Đơn hàng</a></li>
              </div>
            </div>
            <!-- /sidebar menu -->


            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav" style="background-color:#212529">
          <div class="nav_menu" style="background-color:#212529">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i style="color: white" class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a style="color: white" href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> ADMIN
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a></li>
                  </ul>
                </li>

                
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->