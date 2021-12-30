
<?php include('head.php');?>
<?php include('nav.php');?>

        <div class="row mb-2">
          <div class="col-sm-6">
          
          </div><!-- /.col -->
        </div><!-- /.row -->

<?php
if (isset($_POST['btnSave']) && isset($_SESSION['admin']))
{

  $random_code = random('1234567890', 4);
  if (check_img('site_logo') == true)
  {
    $uploads_dir = '../upload/';
    $tmp_name = $_FILES['site_logo']['tmp_name'];
    $create = move_uploaded_file($tmp_name, "$uploads_dir/logo_$random_code.png");
    if($create)
    {
      $ketnoi->query("UPDATE settings SET site_logo = '/upload/logo_$random_code.png'  ");
    }
  }
  if (check_img('site_favicon') == true)
  {
    $uploads_dir = '../upload/';
    $tmp_name = $_FILES['site_favicon']['tmp_name'];
    $create = move_uploaded_file($tmp_name, "$uploads_dir/favicon_$random_code.png");
    if($create)
    {
      $ketnoi->query("UPDATE settings SET site_favicon = '/upload/favicon_$random_code.png'  ");
    }
  }
  if (check_img('site_img') == true)
  {
    $uploads_dir = '../upload/';
    $tmp_name = $_FILES['site_img']['tmp_name'];
    $create = move_uploaded_file($tmp_name, "$uploads_dir/thumbnail_$random_code.png");
    if($create)
    {
      $ketnoi->query("UPDATE settings SET site_img = '/upload/thumbnail_$random_code.png'  ");
    }
  }
  $create = $ketnoi->query("UPDATE `settings` SET 
  `site_fanpage` = '".$_POST['site_fanpage']."',
  `site_diachi` = '".$_POST['site_diachi']."',
  `status_muathe` = '".$_POST['status_muathe']."',
  `status_cham` = '".$_POST['status_cham']."',
  `status_auto` = '".$_POST['status_auto']."',
  `note_napdt` = '".$_POST['note_napdt']."',
  `status_napdt` = '".$_POST['status_napdt']."',
  `ck_napdt_vt` = '".$_POST['ck_napdt_vt']."',
  `ck_napdt_mobi` = '".$_POST['ck_napdt_mobi']."',
  `ck_napdt_vina` = '".$_POST['ck_napdt_vina']."',
  `site_min_bank` = '".$_POST['site_min_bank']."',
  `site_min_momo` = '".$_POST['site_min_momo']."',
  `tenweb` = '".$_POST['site_tenweb']."',
  `mota` = '".$_POST['mota']."',
  `baotri` = '".$_POST['site_baotri']."',
  `cookie` = '".$_POST['site_cookie']."',
  `idfb` = '".$_POST['site_idfb']."',
  `thongbao` = '".$_POST['site_thongbao']."',
  `site_luuy_doithe` = '".$_POST['site_luuy_doithe']."',
  `site_hotline` = '".$_POST['site_hotline']."',
  `site_luuy_ruttien` = '".$_POST['site_luuy_ruttien']."',
  `site_gmail` = '".$_POST['site_gmail']."',
  `cardvip_vt` = '".$_POST['cardvip_vt']."',
  `apikey` = '".$_POST['apikey']."',
  `ck_con` = '".$_POST['ck_con']."',
  `site_color` = '".$_POST['site_color']."',
  `cardvip_mobi` = '".$_POST['cardvip_mobi']."',
  `cardvip_vina` = '".$_POST['cardvip_vina']."',
  `cardvip_viet` = '".$_POST['cardvip_viet']."',
  `cardvip_zing` = '".$_POST['cardvip_zing']."',
  `cardvip_gate` = '".$_POST['cardvip_gate']."',
  `cardvip_garena` = '".$_POST['cardvip_garena']."',
  `tukhoa` = '".$_POST['site_keyword']."'  ");

  if ($create)
  {
    echo '<script type="text/javascript">swal("Thành Công","Lưu thành công","success");setTimeout(function(){ location.href = "" },1000);</script>'; 
  }
  else
  {
    echo '<script type="text/javascript">swal("Lỗi","Lỗi máy chủ","error");setTimeout(function(){ location.href = "" },1000);</script>'; 
  }
}

?>
<form class="form-horizontal" enctype="multipart/form-data" action="" method="post">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <button name="btnSave" type="submit" class="btn btn-info">LƯU THAY ĐỔI</button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">                
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">TÊN WEB</label>
                    <input type="text" class="form-control" name="site_tenweb" value="<?=$site_tenweb;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">MÔ TẢ</label>
                    <input type="text" class="form-control" name="mota" value="<?=$site_mota;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">TỪ KHÓA</label>
                    <input type="text" class="form-control" name="site_keyword" value="<?=$site_keyword;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Chiết Khấu Dưới 50.000đ</label>
                    <input type="number" class="form-control" name="ck_con" value="<?=$ck_con;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">RÚT VỀ BANK TỐI THIỂU</label>
                    <input type="number" class="form-control" name="site_min_bank" value="<?=$site_min_bank;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">RÚT VỀ MOMO TỐI THIỂU</label>
                    <input type="number" class="form-control" name="site_min_momo" value="<?=$site_min_momo;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ID FB ADMIN</label>
                    <input type="text" class="form-control" name="site_idfb" value="<?=$site_idfb;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">HOTLINE</label>
                    <input type="text" class="form-control" name="site_hotline" value="<?=$site_hotline;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">FANPAGE FB</label>
                    <input type="text" class="form-control" name="site_fanpage" value="<?=$site_fanpage;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">ĐỊA CHỈ</label>
                    <input type="text" class="form-control" name="site_diachi" value="<?=$site_diachi;?>"  >
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">COOKIE BOT</label>
                    <textarea class="form-control"  name="site_cookie"><?=$site_cookie;?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email ADMIN</label>
                    <input type="text" class="form-control" name="site_gmail" value="<?=$site_gmail;?>"  >
                  </div>
                  <div class="form-group">
                  <label>ON/OFF BẢO TRÌ</label>
                    <select class="form-control select2bs4" name="site_baotri" style="width: 100%;">
                      <option value="<?=$site_baotri;?>" ><?=$site_baotri;?></option>
                      <option value="ON">ON</option>
                      <option value="OFF">OFF</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label>ON/OFF ĐỔI THẺ CHẬM</label>
                    <select class="form-control select2bs4" name="status_cham" style="width: 100%;">
                      <option value="<?=$status_cham;?>" ><?=$status_cham;?></option>
                      <option value="ON">ON</option>
                      <option value="OFF">OFF</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label>ON/OFF MUA THẺ</label>
                    <select class="form-control select2bs4" name="status_muathe" style="width: 100%;">
                      <option value="<?=$status_muathe;?>" ><?=$status_muathe;?></option>
                      <option value="ON">ON</option>
                      <option value="OFF">OFF</option>
                    </select>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="example-color-input" class="form-control-label">Màu THEME</label>
                  <input class="form-control" type="color" value="<?=$site_color;?>" name="site_color">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">LOGO</label>
                  <input class="form-control" type="file" name="site_logo" multiple>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">FAVICON</label>
                  <input class="form-control" type="file" name="site_favicon" multiple>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">ẢNH BÌA WEB</label>
                  <input class="form-control" type="file" name="site_img" multiple>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">THÔNG BÁO</label>
                    <textarea class="textarea" name="site_thongbao"   style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$site_thongbao;?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">LƯU Ý ĐỔI THẺ</label>
                    <textarea class="textarea" name="site_luuy_doithe" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$site_luuy_doithe;?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">LƯU Ý RÚT TIỀN</label>
                    <textarea class="textarea" name="site_luuy_ruttien" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$site_luuy_ruttien;?></textarea>
                </div>
              </div>  
                </div>
               
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>CẤU HÌNH NẠP ĐIỆN THOẠI</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">                
                  <div class="row">
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">CK Viettel</label>
                      <input type="text" class="form-control" name="ck_napdt_vt" value="<?=$ck_napdt_vt;?>"  >
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">CK Vinaphone</label>
                      <input type="text" class="form-control" name="ck_napdt_vina" value="<?=$ck_napdt_vina;?>"  >
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="exampleInputEmail1">CK Mobifone</label>
                      <input type="text" class="form-control" name="ck_napdt_mobi" value="<?=$ck_napdt_mobi;?>"  >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                    <label>ON/OFF NẠP ĐT</label>
                      <select class="form-control select2bs4" name="status_napdt" style="width: 100%;">
                        <option value="<?=$status_napdt;?>" ><?=$status_napdt;?></option>
                        <option value="ON">ON</option>
                        <option value="OFF">OFF</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-7">
                    <div class="form-group">
                      <label for="exampleInputEmail1">LƯU Ý</label>
                      <textarea class="textarea" name="note_napdt"   style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?=$note_napdt;?></textarea>
                    </div>
                  </div>

              </div>
            </div>
          </div>
        </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>CẤU HÌNH NẠP THẺ TỰ ĐỘNG</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">                
                  <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">API CARDVIP</label>
                      <input type="text" class="form-control" name="apikey" value="<?=$apikey;?>"  >
                    </div>
                  </div>
                 <div class="col-md-6">
                    <div class="form-group">
                    <label>ON/OFF ĐỔI THẺ AUTO</label>
                      <select class="form-control select2bs4" name="status_auto" style="width: 100%;">
                        <option value="<?=$status_auto;?>" ><?=$status_auto;?></option>
                        <option value="ON">ON</option>
                        <option value="OFF">OFF</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Auto Vinaphone</label>
                      <input type="number" class="form-control" name="cardvip_vina" value="<?=$cardvip_vina;?>"  >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Auto Viettel</label>
                      <input type="number" class="form-control" name="cardvip_vt" value="<?=$cardvip_vt;?>"  >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Auto Mobifone</label>
                      <input type="number" class="form-control" name="cardvip_mobi" value="<?=$cardvip_mobi;?>"  >
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Auto Zing</label>
                      <input type="number" class="form-control" name="cardvip_zing" value="<?=$cardvip_zing;?>"  >
                    </div>
                    </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Auto Vietnamobile</label>
                      <input type="number" class="form-control" name="cardvip_viet" value="<?=$cardvip_viet;?>"  >
                    </div>
                    </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Chậm Gate</label>
                      <input type="number" class="form-control" name="cardvip_gate" value="<?=$cardvip_gate;?>"  >
                    </div>
                    </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Chiết Khấu Chậm Garena</label>
                      <input type="number" class="form-control" name="cardvip_garena" value="<?=$cardvip_garena;?>"  >
                    </div>
                    </div>

              </div>
            </div>
          </div>
        </div>

        </div>
        <!-- /.row (main row) --> 
    </form> 
<?php include('foot.php');?>