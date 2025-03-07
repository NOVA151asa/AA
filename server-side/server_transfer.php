<?php
require_once '../api/config.php';

//ชื่อตาราง
$table = 'transfergame_tb';
//ชื่อคีย์หลัก
$primaryKey = 't_id';

//ข้อมูลอะเรที่ส่งป datables
$columns = array(
  array( 'db' => 't_user', 'dt' => 0,
         'formatter' => function( $d, $row ) {
          return "<a href='./customer/detail/".$row[11]."' target='_blank'>".$d."</a>";
         }
  ),
  array( 'db' => 't_fname', 'dt' => 1),
  array( 'db' => 't_amount', 'dt' => 2),
  array( 'db' => 't_promotion_title','dt' => 3),
  array( 'db' => 't_bonus', 'dt' => 4),
  array( 'db' => 't_total', 'dt' => 5),
  array( 'db' => 't_turnover', 'dt' => 6),
  array( 'db' => 't_withdraw_max', 'dt' => 7),
  array( 'db' => 't_after_wallet', 'dt' => 8),
  // array( 'db' => 't_after_credit', 'dt' => 9 ),
  array( 'db' => 't_date_create', 'dt' => 9,
         'formatter' => function( $d, $row ) {
          return date( 'd/m/Y', strtotime($d));
         }
  ),
  array( 'db' => 't_time_create', 'dt' => 10),
  array( 'db' => 't_u_id', 'dt' => 11),
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
      SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, "order by t_id desc", "t_date_create >= '".$_GET['startdate']."' AND t_date_create <= '".$_GET['enddate']."'" )
  );
