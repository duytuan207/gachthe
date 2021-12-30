<?php include('head.php');?>
<?php include('nav.php');?>

<div class="row mb-2">
    <div class="col-sm-6">
    </div><!-- /.col -->
</div><!-- /.row -->

<?php 

$total_cardauto = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe_auto` ")) ['COUNT(*)']; 
$total_card = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe` ")) ['COUNT(*)']; 

$total_cards = $total_cardauto + $total_card;

$total_a = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe_auto` WHERE `status` = 'hoantat' ")) ['COUNT(*)']; 
$total_b = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe` WHERE `status` = 'hoantat' ")) ['COUNT(*)']; 

$total_thanhcong = $total_a + $total_b;

$total_thexuly = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe` WHERE `status` = 'xuly' ")) ['COUNT(*)']; 
$total_az = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe_auto` WHERE `status` = 'thatbai' ")) ['COUNT(*)']; 
$total_ab = mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe` WHERE `status` = 'thatbai' ")) ['COUNT(*)']; 

$total_thethatbai = $total_az + $total_ab;
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?=format_cash($total_cards);?></h3>

                <p>TỔNG THẺ</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?=format_cash($total_thanhcong);?></h3>

                <p>THẺ HỢP LỆ</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?=format_cash($total_thexuly);?></h3>

                <p>THẺ ĐANG ĐỢI XỬ LÝ</p>
            </div>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?=format_cash($total_thethatbai);?></h3>

                <p>THẺ THẤT BẠI</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?=format_cash(mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(VND) FROM `account` WHERE `VND` >= 0 ")) ['SUM(VND)']);?>đ</h3>
                <p>TỔNG TIỀN THÀNH VIÊN</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?=format_cash(mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(DISTINCT callback) FROM `doithe_auto` WHERE `callback` IS NOT NULL ")) ['COUNT(DISTINCT callback)']);?></h3>
                <p>TỔNG SỐ WEBSITE ĐANG ĐẤU API</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?=format_cash(mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT SUM(menhgia) FROM `doithe_auto` WHERE `status` = 'hoantat' AND `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ")) ['SUM(menhgia)']);?>đ</h3>
                <p>DOANH THU HÔM NAY</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?=format_cash(mysqli_fetch_assoc(mysqli_query($ketnoi, "SELECT COUNT(*) FROM `doithe_auto` WHERE `status` = 'hoantat' AND `createdate` >= DATE(NOW()) AND `createdate` < DATE(NOW()) + INTERVAL 1 DAY ")) ['COUNT(*)']);?></h3>
                <p>SẢN LƯỢNG HÔM NAY</p>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
<!-- Main row -->
<div class="row">
    <section class="col-lg-12 connectedSortable">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">LOGS</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tài Khoản</th>
                                <th class="text-center">Nội Dung</th>
                                <th class="text-center">Thời Gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
$i = 0;
$result = mysqli_query($ketnoi,"SELECT * FROM `logs` ORDER BY id desc limit 0, 100000");
while($row2 = mysqli_fetch_assoc($result))
{
?>
                            <tr>
                                <td class="text-center"><?=$i; $i++;?></td>
                                <td class="text-center"><?=$row2['username'];?></td>
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
<!-- /.row (main row) -->

<?php include('foot.php');?>