
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `setting_card` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "setting-card.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "setting-card.php" },1000);</script>'; 
    }
}
?>
<?php
    if (isset($_POST["add_card"]))
    {
        
          $type = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['type']))));
          $ck = str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($_POST['ck']))));
          $permitted_chars = 'QWERTYUIOPASDFGHJKLZXCVBNM';  
          $code = substr(str_shuffle($permitted_chars), 0, 12);

          $create = mysqli_query($ketnoi,"INSERT INTO `setting_card` SET 
            `type` = '".$type."',
            `code` = '".$code."',
            `ck` = '".$ck."' ");
          if ($create)
          {
            echo '<script type="text/javascript">swal("Thành Công","THÊM THÀNH CÔNG","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
          }
          else
          {
            echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
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
                <h3 class="card-title">DANH SÁCH LOẠI THẺ</h3>
                <div class="text-right">
                  <a type="button" class="btn btn-default" data-toggle="modal" data-target="#addcard" class="btn btn-info">THÊM LOẠI THẺ</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">CK</th>
                      <th class="text-center">TRẠNG THÁI</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `setting_card` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['type'];?></td>
                      <td class="text-center"><?=$row['ck'];?>%</td>
                      <td class="text-center"><?=$row['status'];?></td>
                      <td class="text-center">
                        <a type="button" class="btn btn-default" data-toggle="modal" data-target="#<?=$row['code'];?>" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i></a>
                        <a href="setting-card.php?delete=<?=$row['id'];?>" class="btn btn-default">
                          <i class="fas fa-trash"></i>
                        </a> 
                      </td>  
                    </tr>


     <div class="modal fade" id="<?=$row['code'];?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">EDIT CARD</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">LOẠI THẺ</label>
                    <input type="text" class="form-control" value="<?=$row['type'];?>" name="type" >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHIẾT KHẤU</label>
                    <input type="text" class="form-control" value="<?=$row['ck'];?>" name="ck">
                  </div>
                  <div class="form-group">
                  <label>TRẠNG THÁI</label>
                    <select class="form-control select2bs4" name="status" style="width: 100%;">
                      <option value="<?=$row['status'];?>" ><?=$row['status'];?></option>
                      <option value="ON">ON</option>
                      <option value="OFF">OFF</option>
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
      <!-- /.modal -->    

<?php
    if (isset($_POST[$row['code']]))
    {
      $create = mysqli_query($ketnoi,"UPDATE `setting_card` SET 
        `status` = '".$_POST['status']."',
        `type` = '".$_POST['type']."',
        `ck` = '".$_POST['ck']."'
         WHERE `code` = '".$row['code']."' ");

      if ($create)
      {
        echo '<script type="text/javascript">swal("Thành Công","LƯU THÀNH CÔNG","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
      }
      else
      {
        echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
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

<div class="modal fade" id="addcard">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">THÊM LOẠI THẺ</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" action="" method="post">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN THẺ:</label>
                    <input type="text" class="form-control" name="type"  placeholder="VD: Viettel" required="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">CHIẾT KHẤU:</label>
                    <input type="number" class="form-control" name="ck"  placeholder="Chiết khấu đổi thẻ" required="">
                  </div>      
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">ĐÓNG</button>
              <button type="submit" name="add_card" class="btn btn-primary">TẠO</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->        
<?php include('foot.php');?>