<?php include('head.php');?>
<?php include('nav.php');?>

<div class="row mb-2">
    <div class="col-sm-6">

    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DANH SÁCH 200 YÊU CẦU RÚT TIỀN</h3>
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
                                <th class="text-center">TYPE</th>
                                <th class="text-center">STK</th>
                                <th class="text-center">CHỦ TK</th>
                                <th class="text-center">CHI NHÁNH</th>
                                <th class="text-center">MONEY</th>
                                <th class="text-center">TIME</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-center">THAO TÁC</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$i = 0;
$result = mysqli_query($ketnoi,"SELECT * FROM `ruttien` ORDER BY id desc limit 200 ");
while($row = mysqli_fetch_assoc($result))
{
?>
                            <tr>
                                <td class="text-center"><?=$i;?> <?php $i++;?></td>
                                <td class="text-center"><?=$row['code'];?></td>
                                <td class="text-center"><a
                                        href="edit-thanh-vien.php?username=<?=$row['username'];?>"><?=$row['username'];?>
                                </td>
                                <td class="text-center"><?=$row['ngan_hang'];?></td>
                                <td class="text-center"><?=$row['stk'];?></td>
                                <td class="text-center"><?=$row['chu_tai_khoan'];?></td>
                                <td class="text-center"><?=$row['chi_nhanh'];?></td>
                                <td class="text-center"><?=format_cash($row['money']);?>đ</td>
                                <td class="text-center"><?=$row['createdate'];?></td>
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
                                    <a type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#<?=$row['code'];?>" class="btn btn-info"><i class="fa fa-search"
                                            aria-hidden="true"></i> EDIT</a>
                                </td>
                            </tr>


                            <div class="modal fade" id="<?=$row['code'];?>">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">RÚT TIỀN #<?=$row['code'];?></h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form" action="" method="post">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">NGÂN HÀNG</label>
                                                    <input type="text" class="form-control"
                                                        value="<?=$row['ngan_hang'];?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">STK</label>
                                                    <input type="text" class="form-control" value="<?=$row['stk'];?>"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">CHỦ TÀI KHOẢN</label>
                                                    <input type="text" class="form-control"
                                                        value="<?=$row['chu_tai_khoan'];?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">CHI NHÁNH</label>
                                                    <input type="text" class="form-control"
                                                        value="<?=$row['chi_nhanh'];?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">SỐ TIỀN RÚT</label>
                                                    <input type="text" class="form-control" value="<?=$row['money'];?>"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">GHI CHÚ</label>
                                                    <textarea name="note"
                                                        class="form-control"><?=$row['note'];?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>TRẠNG THÁI</label>
                                                    <select class="form-control select2bs4" name="status"
                                                        style="width: 100%;">
                                                        <option value="<?=$row['status'];?>">
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
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">ĐÓNG</button>
                                            <button type="submit" name="<?=$row['code'];?>"
                                                class="btn btn-primary">LƯU</button>
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
        if($_POST['status'] == 'thatbai')
        {
          $get_money = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT `VND` FROM `account` WHERE `username` = '".$row['username']."'  ")) ['VND'];

          $create = mysqli_query($ketnoi,"UPDATE `account` SET 
          `VND` = `VND` + ".$row['money']." 
          WHERE `username` = '".$row['username']."'");

          if($create)
          {
            mysqli_query($ketnoi,"UPDATE `ruttien` SET 
            `status` = '".$_POST['status']."',
            `note` = '".$_POST['note']."'
            WHERE `code` = '".$row['code']."' ");

            
            mysqli_query($ketnoi,"INSERT INTO `logs` SET 
                `content` = '".format_cash($get_money)." + ".format_cash($row['money'])." = ".format_cash(phepcong($get_money, $row['money']))." lý do: Hủy Rút Tiền ID ".$row['code'].". ',
                `username` = '".$row['username']."',
                `createdate` = now() ");
        
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
          $create = mysqli_query($ketnoi,"UPDATE `ruttien` SET 
            `status` = '".$_POST['status']."',
            `note` = '".$_POST['note']."'
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