<?php
require_once 'api/config.php';
if(empty(get_session()))
{
  echo "<SCRIPT LANGUAGE='JavaScript'>
          window.location.href = './login';
        </SCRIPT>";
  exit();
}

if(isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date'] != "" && $_GET['end_date'] != "")
{
  $start_date = $_GET['start_date'];
  $end_date = $_GET['end_date'];
}
elseif(isset($_GET['start_date']) && $_GET['start_date'] != "")
{
  $start_date = $_GET['start_date'];
  $end_date = date('Y-m-d');
}
elseif(isset($_GET['end_date']) && $_GET['end_date'] != "")
{
  $start_date = date('Y-m-d');
  $end_date = $_GET['end_date'];
}
else
{
  $start_date = date('Y-m-d');
  $end_date = date('Y-m-d');
}

$q_1 = dd_q('SELECT COUNT(w_id) AS count_withdraw FROM withdraw_tb WHERE w_date_create >= ? AND w_date_create <= ?', [$start_date, $end_date]);
$row_1 = $q_1->fetch(PDO::FETCH_ASSOC);
$count_withdraw_all = $row_1['count_withdraw'];

$q_2 = dd_q('SELECT COUNT(w_id) AS count_withdraw, SUM(w_amount) AS sum_withdraw FROM withdraw_tb WHERE w_date_create >= ? AND w_date_create <= ? AND w_status = ?', [$start_date, $end_date, '1']);
$row_2 = $q_2->fetch(PDO::FETCH_ASSOC);
$count_withdraw_1 = $row_2['count_withdraw'];
$sum_withdraw_1 = $row_2['sum_withdraw'];
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
        <h1 style="font-size: 30px;">รายการถอนเงิน 
          <span style="font-size: 24px;" class="text-success">
            (วันที่ <?=$start_date?> ถึง <?=$end_date?>)
          </span>
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-sm-6">
            <div class="card card-success card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <h2>฿ <?=number_format($sum_withdraw_1, 2)?></h2>
                  <p>รายการยอดถอนเงินทั้งหมด</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <h2><?=number_format($count_withdraw_all, 0)?></h2>
                  <p>รายการถอนทั้งหมด</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-3">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php
                  $q_3 = dd_q('SELECT COUNT(w_id) AS coumt_withdraw FROM withdraw_tb WHERE w_date_create >= ? AND w_date_create <= ? AND w_status = ?', [$start_date, $end_date, '0']);
                  $row_3 = $q_3->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <h2 class="text-warning"><?=number_format($row_3['coumt_withdraw'], 0)?></h2>
                  <p>รายการที่ยังไม่ได้ยืนยัน</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <h2 class="text-success"><?=number_format($count_withdraw_1, 0)?></h2>
                  <p>รายการที่ยืนยันแล้ว</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php
                  $q_4 = dd_q('SELECT COUNT(w_id) AS coumt_withdraw FROM withdraw_tb WHERE w_date_create >= ? AND w_date_create <= ? AND w_status = ?', [$start_date, $end_date, '2']);
                  $row_4 = $q_4->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <h2 class="text-danger"><?=number_format($row_4['coumt_withdraw'], 0)?></h2>
                  <p>รายการที่ยกเลิก</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <?php
                  $q_5 = dd_q('SELECT COUNT(w_id) AS coumt_withdraw FROM withdraw_tb WHERE w_date_create >= ? AND w_date_create <= ? AND w_status = ?', [$start_date, $end_date, '3']);
                  $row_5 = $q_5->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <h2 class="text-primary"><?=number_format($row_5['coumt_withdraw'], 0)?></h2>
                  <p>รายการที่ยกเลิกและคืนเครดิต</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- <section class="content mb-3">
        <div class="row">
          <div class="col-sm-12">
            <button type="button" class="btn btn-success btn-block btn-lg">
              <i class="fas fa-plus"></i> เพิ่มรายการถอน
            </button>
          </div>
        </div>
      </section> -->
      <section class="content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="row">
                  <div class="col-sm-2 mb-1">
                    <b>เลือกช่วง วัน/เวลา :</b>
                  </div>
                  <div class="col-sm-3 mb-1">
                    <div class="input-group">
                      <input type="text" class="form-control" id="txt_dateStart" value="<?=date('d/m/Y', strtotime($start_date))?>">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <span class="far fa-calendar-alt"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-1">
                    <div class="input-group">
                      <input type="text" class="form-control" id="txt_dateEnd" value="<?=date('d/m/Y', strtotime($end_date))?>">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <span class="far fa-calendar-alt"></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3 mb-1">
                    <button type="button" id="btn_search" class="btn btn-primary">ยืนยัน</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-outline">
              <div class="card-body box-profile">
                <div class="table-responsive">
                  <table class="table" id="tb_data" style="width: 100%;">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">ยูเซอร์</th>
                        <th scope="col">ชื่อ นามสกุล</th>
                        <th scope="col">จำนวนเงินถอน</th>
                        <th scope="col">ธนาคาร</th>
                        <th scope="col">สำเร็จโดย</th>
                        <th scope="col">วันสร้าง</th>
                        <th scope="col">เวลาสร้าง</th>
                        <th scope="col">สถานะ</th>
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
      "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "ทั้งหมด"]],
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
      "ajax": "./server-side/server_withdraw.php?startdate=<?=$start_date?>&enddate=<?=$end_date?>"
    });
  });

  $('#txt_dateStart').datepicker({
    format:'dd/mm/yyyy',
    autoclose: true,
    todayBtn: true
  });
  $('#txt_dateEnd').datepicker({
    format:'dd/mm/yyyy',
    autoclose: true,
    todayBtn: true
  });
  $("#btn_search").click(function(e) {
    e.preventDefault();
    var arr_dateStart = $("#txt_dateStart").val().split("/");
    var _dateStart = arr_dateStart[2]+'-'+arr_dateStart[1]+'-'+arr_dateStart[0];

    var arr_dateEnd = $("#txt_dateEnd").val().split("/");
    var _dateEnd = arr_dateEnd[2]+'-'+arr_dateEnd[1]+'-'+arr_dateEnd[0];

    window.location = './withdraw?start_date='+_dateStart+'&end_date='+_dateEnd;
});
</script>
</html>