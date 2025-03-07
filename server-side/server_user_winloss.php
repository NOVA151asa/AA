<?php
require_once '../api/config.php';

//ชื่อตาราง
$table = 'winloss_receive_tb';
//ชื่อคีย์หลัก
$primaryKey = 'wl_id';

//ข้อมูลอะเรที่ส่งป datables
$columns = array(
  array( 'db' => 'wl_date', 'dt' => 0),
  array( 'db' => 'wl_cashback', 'dt' => 1),
  array( 'db' => 'wl_action_date', 'dt' => 2),
  array( 'db' => 'wl_action_time', 'dt' => 3)
);

  //เชื่อต่อฐานข้อมูล
  $sql_details = array(
    'user' => DB::$str_username,
    'pass' => DB::$str_password,
    'db'   => DB::$str_database,
    'host' => DB::$str_hosting
  );

  // เรียกใช้ไฟล์ spp.class.php
  require( 'ssp.class.php' );

  //ส่งข้อมูลกลับไปเป็น JSON
  echo json_encode(
      SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, "order by wl_id desc", "wl_user = '".$_GET['userid']."'" )
  );
