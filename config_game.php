<?php
require_once 'api/config.php';
if(empty(get_session()))
{
  echo "<SCRIPT LANGUAGE='JavaScript'>
          window.location.href = './login';
        </SCRIPT>";
  exit();
}
else
{
  // ===== get permission =====
  if(get_admin("a_role") > 2)
  {
    echo "<SCRIPT LANGUAGE='JavaScript'>
    window.location.href = './unauthorized';
    </SCRIPT>";
    exit;
  }
  // ===== get permission =====
}
$q_u = dd_q('SELECT * FROM website_tb WHERE (id = ?)', [1]);
$row_u = $q_u->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("master/MasterPages.php"); ?>
  <style type="text/css">
<!--
.style1 {
	color: #007bff;
	font-weight: bold;
	font-size: 24px;
}
.style2 {color: #009900}
-->
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
  <div class="wrapper">
    <?php include ("partials/_navbar.php"); ?>
    <?php include ("partials/_sidebar.php"); ?>
    <div class="content-wrapper">
      <section class="content-header pt-4 pb-4">
        <h1 style="font-size: 30px;">ตั้งค่าค่ายเกม</h1>
        <?php
          $q_1 = dd_q('SELECT * FROM game_tb');
          while($row = $q_1->fetch(PDO::FETCH_ASSOC))
          {
        ?>
        <div class="card card-outline">
          <div class="card-body box-profile">
            <table width="753" border="0">
              <tr>
                <td><img style="border-radius:20px; width:150px;" src="https://aqua.paylegacy.com/<?php echo $row['g_img'] ?>"></td>
                <td><?php echo $row['g_name'] ?></td>
                <td><?php if ($row['g_closegame'] == 0) { ?><a class="btn btn-danger btn-block" href="<?php $_SERVER[HTTP_HOST] ?>/api/edit_game.php?id=<?php echo $row['g_id'] ?>&g_close=1"><i class="fas fa-window-close"></i> ปิดอยู่กดเพื่อเปิด</a>
                    <?php } else { ?> <a class="btn btn-success btn-block" href="<?php $_SERVER[HTTP_HOST] ?>/api/edit_game.php?id=<?php echo $row['g_id'] ?>&g_close=0"><i class="fas fa-lock-open"></i> เปิดอยู่กดเพื่อปิดปรับปรุง</a> <?php } ?></td>
                <td><?php if ($row['g_status'] == 0) { ?><a class="btn btn-danger btn-block" href="<?php $_SERVER[HTTP_HOST] ?>/api/edit_gamestatus.php?id=<?php echo $row['g_id'] ?>&g_status=1"><i class="fas fa-eye-slash"></i> ปิดอยู่กดเพื่อเปิดให้ลูกค้าเห็น</a>
                <?php } else { ?> <a class="btn btn-success btn-block" href="<?php $_SERVER[HTTP_HOST] ?>/api/edit_gamestatus.php?id=<?php echo $row['g_id'] ?>&g_status=0"><i class="fas fa-eye"></i> เปิดอยู่กดเพื่อปิดแสดงให้ลูกค้าเห็น</a> <?php } ?></td>
              </tr>
            </table>
          </div>
        </div>

        <?php
          }
        ?>
       
  <button type="submit" id="settingwebsite" class="btn btn-primary btn-lg"><i class="fas fa-save fa-lg"></i> บันทึก</button>


</form>
    </div>
  </div>
</body>
</body>
<?php include('partials/_footer.php'); ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

</html>