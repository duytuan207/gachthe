
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Chỉnh Sửa Thành Viên</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
<?php
if (isset($_GET['username'])) 
{
    $usernamer = $_GET['username'];
}

$AADDCC = mysqli_query($ketnoi,"SELECT * FROM `account` WHERE `username` = '".$usernamer."' ");
while ($row = mysqli_fetch_array($AADDCC) ) 
{
  if (isset($_POST["btn_submit"])) 
  {

    $mail = $_POST["mail"];   
    $fullname = $_POST["fullname"]; 
    $banned = $_POST["banned"]; 
    $level = $_POST["level"]; 


    $ketnoi->query("UPDATE `account` SET 
    `mail` = '$mail',
    `banned` = '$banned',
    `level`= '$level',
    `fullname` = '$fullname' WHERE `username` = '".$usernamer."' ");

    $ketnoi->query("INSERT INTO `logs` SET 
    `content` = 'Thay đổi thông tin bởi Admin ',
    `username` = '".$usernamer."',
    `createdate` = now() ");

    echo '<script type="text/javascript">swal("Thành Công","Save Thành Công","success");
    setTimeout(function(){ location.href = "" },500);</script>';
      
  }

?>
<?php
if(isset($_POST['btn_congtien']))
{
    $sotien = check_string($_POST['sotien']);
    $get_money = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `VND` FROM `account` WHERE `username` = '".$row['username']."'  ")) ['VND'];
    $create = mysqli_query($ketnoi,"UPDATE `account` SET `VND`=`VND`+ '$sotien' WHERE `username`='".$row['username']."'");


    if ($create)
    {
      mysqli_query($ketnoi,"INSERT INTO `logs` SET 
        `content` = '".format_cash($get_money)." + ".format_cash($sotien)." = ".format_cash(phepcong($get_money, $sotien))." lý do: Admin Cộng Tiền. ',
        `username` = '".$row['username']."',
        `createdate` = now() ");
      
       echo '<script type="text/javascript">swal("Thành Công","Cộng tiền thành công","success");
            setTimeout(function(){ location.href = "" },1000);</script>';
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");
            setTimeout(function(){ location.href = "" },2000);</script>';
    }       
}
if(isset($_POST['btn_trutien']))
{
    $sotien = $_POST['sotien'];
    $get_money = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `VND` FROM `account` WHERE `username` = '".$row['username']."'  ")) ['VND'];
    mysqli_query($ketnoi,"UPDATE `account` SET `VND`=`VND`- '$sotien' WHERE `username`='".$row['username']."'");
    

      
    mysqli_query($ketnoi,"INSERT INTO `logs` SET 
        `content` = '".format_cash($get_money)." - ".format_cash($sotien)." = ".format_cash(pheptru($get_money, $sotien))." lý do: Admin Trừ Tiền. ',
        `username` = '".$row['username']."',
        `createdate` = now() ");
        
    echo '<script type="text/javascript">swal("Thành Công","Cộng tiền thành công","success");
            setTimeout(function(){ location.href = "" },1000);</script>';
}
?>

<div class="row">

<section class="col-lg-12 connectedSortable">
  
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">THÀNH VIÊN</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" class="form-control" value="<?=$row['username'];?>"  disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Số Dư</label>
                    <input type="text" class="form-control" value="<?php echo number_format($row['VND'], 0, '.', '.');?>đ"  disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Ngày Đăng Ký</label>
                    <input type="text" class="form-control" value="<?=$row['createdate'];?>"  disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">IP Đăng Nhập</label>
                    <input type="text" class="form-control" value="<?=$row['ip'];?>"  disabled>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control" name="fullname" value="<?=$row['fullname'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" name="mail" value="<?=$row['mail'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Banned</label>
                    <select class="custom-select" name="banned">
                       <option value="<?=$row['banned'];?>">
                      <?php
                      if($row['banned'] == "0"){ echo 'ACTIVE';}
                      if($row['banned'] == "1"){ echo 'BANNED';}
                      ?>  
                      </option> 
                          <option value="0">ACTIVE</option>
                          <option value="1">BANNED</option>
                        </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Rank</label>
                    <input type="text" class="form-control" name="level" value="<?=$row['level'];?>">
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
</section>


<section class="col-lg-6 connectedSortable">
<form class="form-horizontal" action="" method="post">  
<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">CỘNG TIỀN</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Số Tiền Cộng</label>
                    <input type="number" class="form-control" name="sotien" placeholder="">
                </div>
                 <div class="card-footer">
                  <button type="submit" name="btn_congtien" class="btn btn-primary">Submit</button>
                </div>
              </div>

              <!-- /.card-body -->
            </div>
</form>            
</section>  

<section class="col-lg-6 connectedSortable">
<form class="form-horizontal" action="" method="post">  
<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">TRỪ TIỀN</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Số Tiền Trừ</label>
                    <input type="number" class="form-control" name="sotien" placeholder="">
                </div>
                 <div class="card-footer">
                  <button type="submit" name="btn_trutien" class="btn btn-primary">Submit</button>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</form>
</section>


          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH THẺ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover">
                  <thead>                  
                    <tr>
                      <th class="text-center">TIME</th>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">SERI</th>
                      <th class="text-center">PIN</th>
                      <th class="text-center">MỆNH GIÁ</th>
                      <th class="text-center">THỰC NHẬN</th>
                      <th class="text-center">STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `doithe_auto` WHERE `username` = '".$row['username']."' ORDER BY id desc limit 0, 100000");
while($row1 = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row1['createdate'];?></td>
                      <td class="text-center"><label class="btn btn-success"><?=$row1['type'];?></label></td>
                      <td class="text-center"><?=$row1['seri'];?></td>
                      <td class="text-center"><?=$row1['pin'];?></td>
                      <td class="text-center"><?=format_cash($row1['menhgia']);?>đ</td>
                      <td class="text-center"><?=format_cash($row1['thucnhan']);?>đ</td>
                      <td class="text-center">
                      	<?php if($row1['status'] == 'xuly'){ ?>
						<label class="btn btn-warning">Chờ xử lý</label>
						<?php }?> 
						<?php if($row1['status'] == 'hoantat'){ ?>
						<label class="btn btn-success">Hoàn tất</label>
						<?php }?> 
						<?php if($row1['status'] == 'thatbai'){ ?>
						<label class="btn btn-danger">Thất bại</label>
						<?php }?> 
						</td> 
                    </tr>

<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-6 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH YÊU CẦU RÚT TIỀN</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" >
                  <thead>                  
                    <tr>
                      <th class="text-center">TIME</th>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">STK</th>
                      <th class="text-center">CHỦ TK</th>
                      <th class="text-center">CHI NHÁNH</th>
                      <th class="text-center">MONEY</th>
                      <th class="text-center">STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `ruttien` WHERE `username` = '".$row['username']."' ORDER BY id desc limit 0, 100000");
while($row2 = mysqli_fetch_assoc($result))
{
?>
				<tr>
					<td class="text-center"><?=$row2['createdate'];?></td>
					<td class="text-center"><?=$row2['ngan_hang'];?></td>
					<td class="text-center"><?=$row2['stk'];?></td>
					<td class="text-center"><?=$row2['chu_tai_khoan'];?></td>
					<td class="text-center"><?=$row2['chi_nhanh'];?></td>
					<td class="text-center"><?=format_cash($row2['money']);?>đ</td>
					<td class="text-center">
						<?php if($row2['status'] == 'xuly'){ ?>
						<label class="btn btn-warning">Chờ xử lý</label>
						<?php }?> 
						<?php if($row2['status'] == 'hoantat'){ ?>
						<label class="btn btn-success">Hoàn tất</label>
						<?php }?> 
						<?php if($row2['status'] == 'thatbai'){ ?>
						<label class="btn btn-danger">Thất bại</label>
						<?php }?> 
					</td>
				</tr>

<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>


<section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">LOG</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover" >
                  <thead>                  
                    <tr>
                      <th class="text-center">Nội Dung</th>
                      <th class="text-center">Thời Gian</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `logs` WHERE `username` = '".$row['username']."' ORDER BY id desc limit 0, 100000");
while($row2 = mysqli_fetch_assoc($result))
{
?>
				<tr>
					<td class="text-center"><?=$row2['content'];?></td>
					<td class="text-center"><?=$row2['createdate'];?></td>
				</tr>

<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

</div>
<?php }?>
<?php include('foot.php');?>