<?php
require_once 'api/config.php';
if(empty(get_session()))
{
  echo "<SCRIPT LANGUAGE='JavaScript'>
          window.location.href = './login';
        </SCRIPT>";
  exit();
}
 

?>
<!DOCTYPE html>
<html>
<head>
  <?php include("master/MasterPages.php"); ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
  <div class="wrapper">
    <?php include ("partials/_navbar.php"); ?>
    <?php include ("partials/_sidebar.php"); ?>
    <div class="content-wrapper">
      <section class="content-header pt-4 pb-4">
        <h1 style="font-size: 30px;">ตรวจสอบการทำงานของระบบ </h1>
      </section>

 
      <section class="content">
        <div class="row">
          <div class="col-sm-6">
            <div class="card card-outline">
              <section class="content-header pt-4 pb-4">
                <h1 style="font-size: 30px; color: #2c9700;">การทำงานของระบบหน้าบ้าน <i class="fas fa-house-damage"></i></h1>
              </section>
              <div class="card-body box-profile">
                <div class="table-responsive">
                  <table class="table" id="tb_data" style="width: 100%;">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">PAGE</th>
                        <th scope="col">ระบบแจ้งว่า</th>
                        <th scope="col">วันเวลา</th>
                        <th scope="col">IP</th>
                        <th scope="col">สร้างโดย</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-6">
            <div class="card card-outline">
              <section class="content-header pt-4 pb-4">
                <h1 style="font-size: 30px; color: #d673ff;">การทำงานของระบบหลังบ้าน <i class="fab fa-ubuntu"></i></h1>
              </section>
              <div class="card-body box-profile">
                <div class="table-responsive">
                  <table class="table" id="tb_dataadmin" style="width: 100%;">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">PAGE</th>
                        <th scope="col">ระบบแจ้งว่า</th>
                        <th scope="col">วันเวลา</th>
                        <th scope="col">IP</th>
                        <th scope="col">สร้างโดย</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

 
 
      </section>
      
    </div>
  </div>
</body>
<?php include('partials/_footer.php'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
  $(function () {
    $('#tb_data').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "lengthMenu": [[20, 25, 50, 100, -1], [20, 25, 50, 100, "ทั้งหมด"]],
      "language": {
        "emptyTable":     "ไม่พบข้อมูล",
        "info":           "แสดงข้อมูลแถวที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
        "infoEmpty":      "ไม่พบข้อมูล",
        "infoFiltered":   "(ค้นหาจากข้อมูลทั้งหมด _MAX_ แถว)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "การแสดงผล _MENU_ แถว",
        "search":         "ค้นหา:",
        "zeroRecords":    "ไม่พบข้อมูลที่ค้นหา",
        "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ถัดไป",
            "previous":   "ก่อนหน้า"
        }
      },
      "processing": true,
      "serverSide": true,
      "ajax": "./server-side/server_log.php"
    });
  });

  $(function () {
    $('#tb_dataadmin').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "lengthMenu": [[20, 25, 50, 100, -1], [20, 25, 50, 100, "ทั้งหมด"]],
      "language": {
        "emptyTable":     "ไม่พบข้อมูล",
        "info":           "แสดงข้อมูลแถวที่ _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
        "infoEmpty":      "ไม่พบข้อมูล",
        "infoFiltered":   "(ค้นหาจากข้อมูลทั้งหมด _MAX_ แถว)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "การแสดงผล _MENU_ แถว",
        "search":         "ค้นหา:",
        "zeroRecords":    "ไม่พบข้อมูลที่ค้นหา",
        "paginate": {
            "first":      "หน้าแรก",
            "last":       "หน้าสุดท้าย",
            "next":       "ถัดไป",
            "previous":   "ก่อนหน้า"
        }
      },
      "processing": true,
      "serverSide": true,
      "ajax": "./server-side/server_logadmin.php"
    });
  });
 
</script>
</html>