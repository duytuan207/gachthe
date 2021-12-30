
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
          
        <div class="row">
          <section class="col-lg-12 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DANH SÁCH NẠP THẺ AUTO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="datatable1" class="table table-bordered table-striped">
                  <thead>                  
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">USERNAME</th>
                      <th class="text-center">TYPE</th>
                      <th class="text-center">SERI</th>
                      <th class="text-center">PIN</th>
                      <th class="text-center">MỆNH GIÁ</th>
                      <th class="text-center">THỰC NHẬN</th>
                      <th class="text-center">STATUS</th>
                      <th class="text-center">CREATEDATE</th>
                      <th class="text-center">UPDATEDATE</th>
                      <th class="text-center">NOTE</th>
                      <th class="text-center">CALLBACK</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
$i = 0;
$result = mysqli_query($ketnoi,"SELECT * FROM `doithe_auto` ORDER BY id desc ");
while($row1 = mysqli_fetch_assoc($result))
{
?>
                    <tr>
                      <td class="text-center"><?=$i; $i++;?></td>
                      <td class="text-center"><a href="edit-thanh-vien.php?username=<?=$row1['username'];?>" ><?=$row1['username'];?></td>
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
					  <td class="text-center"><?=$row1['createdate'];?></td>
					  <td class="text-center"><?=$row1['updatedate'];?></td>
					  <td class="text-center"><?=$row1['note'];?></td>
            <td class="text-center"><?=$row1['callback'];?></td>
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
        <!-- /.row (main row) -->
<?php include('foot.php');?>