
<?php include('head.php');?>
<?php include('nav.php');?>

<?php
if (isset($_GET['delete'])) 
{
    $delete = $_GET['delete'];

    $create = mysqli_query($ketnoi,"DELETE FROM `doithe` WHERE `id` = '".$delete."' ");

    if ($create)
    {
      echo '<script type="text/javascript">swal("Thành Công","XÓA THÀNH CÔNG","success");setTimeout(function(){ location.href = "card.php" },500);</script>'; 
    }
    else
    {
      echo '<script type="text/javascript">swal("Lỗi","LỖI MÁY CHỦ, VUI LÒNG LIÊN HỆ KỸ THUẬT VIÊN","error");setTimeout(function(){ location.href = "card.php" },1000);</script>'; 
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
                <h3 class="card-title">DANH SÁCH THẺ CHẬM</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">ID</th>
                      <th class="text-center">USER</th>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">SERI</th>
                      <th class="text-center">PIN</th>
                      <th class="text-center">MỆNH GIÁ</th>
                      <th class="text-center">THỰC NHẬN</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">THAO TÁC</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$result = mysqli_query($ketnoi,"SELECT * FROM `doithe` ORDER BY id desc limit 0, 100000");
while($row = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$row['id'];?></td>
                      <td class="text-center"><?=$row['username'];?></td>
                      <td class="text-center"><label class="btn btn-success"><?=$row['type'];?></label></td>
                      <td class="text-center"><?=$row['seri'];?></td>
                      <td class="text-center"><?=$row['pin'];?></td>
                      <td class="text-center"><?=format_cash($row['menhgia']);?>đ</td>
                      <td class="text-center"><?=format_cash($row['thucnhan']);?>đ</td>
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
                        <a type="button" class="btn btn-default" data-toggle="modal" data-target="#<?=$row['code'];?>" class="btn btn-info"><i class="fa fa-search" aria-hidden="true"></i> EDIT</a>
                        <a href="card.php?delete=<?=$row['id'];?>" class="btn btn-default">
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
                    <input type="text" class="form-control" value="<?=$row['type'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">MỆNH GIÁ</label>
                    <input type="text" class="form-control" value="<?=$row['menhgia'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">SERI</label>
                    <input type="text" class="form-control" value="<?=$row['seri'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">PIN</label>
                    <input type="text" class="form-control" value="<?=$row['pin'];?>" readonly>
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
        if($_POST['status'] == 'hoantat')
        {
          mysqli_query($ketnoi,"UPDATE `account` SET 
          `VND` = `VND` + ".$row['thucnhan']." 
          WHERE `username` = '".$row['username']."'");
          
          mysqli_query($ketnoi,"UPDATE `doithe` SET 
          `status` = '".$_POST['status']."',
          `note` = '".$_POST['note']."',
          `updatedate` = now()
          WHERE `code` = '".$row['code']."' ");

          $get_money = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `VND` FROM `account` WHERE `username` = '".$row['username']."'  ")) ['VND'];

          $ketnoi->query("INSERT INTO `logs` SET 
          `content` = '".format_cash($get_money)." + ".format_cash($row['thucnhan'])." = ".format_cash(pheptru($get_money, $row['thucnhan']))." lý do: Đổi Thẻ Chậm SERI ".$row['seri'].". ',
          `username` = '".$row['username']."',
          `createdate` = now() ");

          echo '<script type="text/javascript">swal("Thành Công","Cộng tiền User hoàn tất!","success");
            setTimeout(function(){ location.href = "" },500);</script>';
          exit();
        }
        else
        {
          mysqli_query($ketnoi,"UPDATE `doithe` SET 
          `status` = '".$_POST['status']."',
          `note` = '".$_POST['note']."',
          `updatedate` = now()
          WHERE `code` = '".$row['code']."' ");

          echo '<script type="text/javascript">swal("Thành Công","Lưu thành công!","success");
            setTimeout(function(){ location.href = "" },500);</script>';
          exit();
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