
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `muathe` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "mua-the.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "mua-the.php" },1000);</script>'; 
    }
}
?>


        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH ĐƠN MUA THẺ</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">CODE</th>
                      <th class="text-center">USER</th>
                      <th class="text-center">LOẠI THẺ</th>
                      <th class="text-center">MỆNH GIÁ</th>
                      <th class="text-center">THANH TOÁN</th>
                      <th class="text-center">CREATEDATE</th>
                      <th class="text-center">UPDATEDATE</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$i=0;
$result = mysqli_query($ketnoi,"SELECT * FROM `muathe` ORDER BY id desc ");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$i; $i++;?></td>
                      <td class="text-center"><?=$row['code'];?></td>
                      <td class="text-center"><a href="edit-thanh-vien.php?username=<?=$row['username'];?>" ><?=$row['username'];?></td>
                      <td class="text-center"><?=$row['loaithe'];?></td>
                      <td class="text-center"><?=format_cash($row['menhgia']);?></td>
                      <td class="text-center"><?=format_cash($row['money']);?></td>
                      <td class="text-center"><?=$row['createdate'];?></td>
                      <td class="text-center"><?=$row['updatedate'];?></td>
                      <td class="text-center">
                      <?php if($row['status'] == 'xuly'){ ?>
                                        <label class="btn btn-warning">Chờ xử lý</label>
                            <?php }?> 
                            <?php if($row['status'] == 'hoantat'){ ?>
                                        <label class="btn btn-success">Hoàn tất</label>
                              <?php }?> 
                            <?php if($row['status'] == 'thatbai'){ ?>
                                        <label class="btn btn-danger">Thất bại</label>
                                <?php }?> 
                                </td>
                      <td class="text-center">
                        <a type="button" class="btn btn-default" data-toggle="modal" data-target="#EDIT_<?=$row['code'];?>" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> EDIT</a>
                        <!--<a href="mua-the.php?delete=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-trash"></i>
                        </a> -->
                      </td>  
                    </tr>


     <div class="modal fade" id="EDIT_<?=$row['code'];?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">MUA THẺ #<?=$row['code'];?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">EMAIL NHẬN THÔNG TIN THẺ</label>
                    <input type="text" class="form-control" value="<?=$row['email'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">SERI</label>
                    <input type="text" class="form-control" name="seri" value="<?=$row['seri'];?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">PIN</label>
                    <input type="text" class="form-control" name="pin" value="<?=$row['pin'];?>" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">GHI CHÚ</label>
                    <textarea name="note" class="form-control"><?=$row['note'];?></textarea>
                  </div>
                  <div class="form-group">
                  <label>TRẠNG THÁI</label>
                    <select class="form-control select2bs4" name="status" style="width: 100%;">
                      <option value="<?=$row['status'];?>" >
                        <?php if($row['status'] == 'xuly'){?>
                          Đang chờ xử lý
                        <?php }?>
                        <?php if($row['status'] == 'hoantat'){?>  
                          Hoàn tất
                        <?php }?>
                        <?php if($row['status'] == 'thatbai'){?>  
                          Thất bại
                        <?php }?>
                        </option>
                      <option value="xuly">Đang chờ xử lý</option>
                      <option value="hoantat">Hoàn tất</option>
                      <option value="thatbai">Thất bại</option>
                    </select>
                  </div>        
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
              <button type="submit" name="<?=$row['code'];?>" class="btn btn-primary">LƯU</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>




<?php
    if (isset($_POST[$row['code']]))
    {
        $seri = check_string($_POST['seri']);
        $pin = check_string($_POST['pin']);
        if($_POST['status'] == 'thatbai')
        {
          $get_money = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `VND` FROM `account` WHERE `username` = '".$row['username']."'  ")) ['VND'];

          mysqli_query($ketnoi,"INSERT INTO `logs` SET 
                `content` = '".format_cash($get_money)." + ".format_cash($row['money'])." = ".format_cash(phepcong($get_money, $row['money']))." lý do: Hủy Mua Thẻ ID ".$row['code'].". ',
                `username` = '".$row['username']."',
                `createdate` = now() ");

          $create = mysqli_query($ketnoi,"UPDATE `account` SET 
          `VND` = `VND` + ".$row['money']." 
          WHERE `username` = '".$row['username']."'");

          if($create)
          {
            mysqli_query($ketnoi,"UPDATE `muathe` SET 
            `status` = '".$_POST['status']."',
            `note` = '".$_POST['note']."',
            `updatedate` = now()
            WHERE `code` = '".$row['code']."' ");

            
        
            echo '<script type="text/javascript">swal("Thành Công","Hoàn tiền User hoàn tất!","success");
            setTimeout(function(){ location.href = "" },500);</script>';
            exit();
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","Lỗi kỹ thuật","error");
            setTimeout(function(){ location.href = "" },500);</script>';
            exit();
          }
        }
        else
        {
          $guitoi = $row['email'];   
          $subject = 'Mua Thẻ '.$row['loaithe'].' Thành Công!';
          $bcc = $site_tenweb;
          $hoten ='Client';
          $noi_dung = '<h2>Thông tin chi tiết thẻ cào #'.$row['code'].'</h2>
          <table >
          <tbody>
          <tr>
          <td>Loại Thẻ:</td>
          <td><b>'.$row['loaithe'].'</b></td>
          </tr>
          <tr>
          <td>Mệnh Giá:</td>
          <td><b style="color:blue;">'.format_cash($row['menhgia']).'</b></td>
          </tr>
          <tr>
          <td>SERI:</td>
          <td><b>'.$seri.'</b></td>
          </tr>
          <tr>
          <td>PIN</td>
          <td><b>'.$pin.'</b></td>
          </tr>
          <tr>
          <td>Thời Gian Xử Lý</td>
          <td><b style="color:red;">'.date("h:i:s m-d-Y").'</b></td>
          </tr>
          </tbody>
          </table>
          <i>Cảm ơn quý khách!</i>';
          sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);  

          $create = mysqli_query($ketnoi,"UPDATE `muathe` SET 
            `status` = '".$_POST['status']."',
            `seri` = '".$seri."',
            `pin` = '".$pin."',
            `note` = '".$_POST['note']."',
            `updatedate` = now()
            WHERE `code` = '".$row['code']."' ");

          if($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","Lưu thành công!","success");
            setTimeout(function(){ location.href = "" },500);</script>';
            exit();
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","Lỗi kỹ thuật","error");
            setTimeout(function(){ location.href = "" },500);</script>';
            exit();
          }
        }
    }
?>

<?php }?>
                  </tbody>
                </table>
              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      
<?php include('foot.php');?>