<?php
/*
* Template Name: bao-gia
*/
?>

<?php

  if (isset($_SERVER['HTTP_ORIGIN'])) {
    // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
    // you want to allow, and if so:
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
  }

  // Access-Control headers are received during OPTIONS requests
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        // may also be using PUT, PATCH, HEAD etc
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
  }
  $entityBody = file_get_contents('php://input');
  $arr = json_decode($entityBody);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Báo giá sản phẩm</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style>
    .list_table {
      border-collapse: collapse;
    }

    .list_table td {
      border: solid 1px #aaa;
      padding: 5px;
      vertical-align: middle;
    }

    .cart_first_tr {
      background-color: #cccccc;
    }

    BODY,
    FORM,
    TABLE,
    TD,
    SPAN,
    DIV {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    }

    .title a {
      color: #0000ff;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
      text-decoration: none;
    }

    .title a:hover {
      color: #0000ff;
      text-decoration: underline;
    }
  </style>
  <style>
    body {
      background: url(/template/default/images/bg_logo.png) center center no-repeat fixed #fff;
    }
  </style>
</head>

<body>
  <div style="max-width: 1200px; margin: 0 auto;">
    <table width="100%">
      <tr>
        <td colspan="3" valign="top">
          <img src="https://mscshop.vn/wp-content/themes/mscshop.vn/html/assets/images/logo1.jpg" alt="" width="80" height="80" />
        </td>
        <td colspan="5" align="right" style="line-height: 19px;">
          <b style="color: #e51f28; font-size: 20px;">Công ty TNHH Tin học MSC</b><br />
          Địa chỉ: 382 đường Kim Giang, Phường Đại Kim, Quận Hoàng Mai, Hà Nội<br />
          Điện thoại: 0886.886.139 <br />
          Email: duong_startok@gmail.com
        </td>
      </tr>
      <tr>
        <td colspan="8"></td>
      </tr>
      <tr>
        <td colspan="8" style="border-top: 4px double #ccc; font-size: 21px; font-weight: bold; text-align: center; padding: 15px 0;">BẢNG BÁO GIÁ THIẾT BỊ</td>
      </tr>
    </table>

    <table width="100%" style="line-height: 1.6;">
      <tr>
        <td colspan="4"></td>
        <td colspan="4"></td>
      </tr>
      <tr>
        <td colspan="4" width="45%">
          Ông/bà: <?= $arr->user_info->fullname ;?> <br />
          Đơn vị:<br />
          Địa chỉ:<?= $arr->user_info->address ;?><br />
          Điện thoại:<?= $arr->user_info->phone ;?><br />
        </td>
        <td colspan="4">
          &nbsp;<br />
          &nbsp;<br />
          Email:<?= $arr->user_info->email ;?><br />
          Fax:<br />
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td colspan="8">&nbsp;</td>
      </tr>
    </table>
    <table width="100%">
      <tr>
        <td colspan="5" align="left"></td>
        <td colspan="3" align="right">Ngày báo giá: <span id="price_time"><?= date("Y-m-d H:i:s") ?></span></td>
      </tr>
      <tr>
        <td colspan="5" align="left"></td>
        <td colspan="3" align="right">
          <i>Đơn vị tính: VNĐ</i>
        </td>
      </tr>
    </table>

    <div style="padding: 10px;"></div>
    <table class="list_table" width="100%">
      <tr style="color: #ffffff; background-color: #e00;">
        <td><strong>STT </strong></td>
        <td><strong>Mã sản phẩm</strong></td>
        <td><strong>Hình ảnh </strong></td>
        <td width="300"><strong>Tên sản phẩm </strong></td>
        <td><strong>Bảo hành </strong></td>
        <td><strong>Số lượng </strong></td>
        <td><strong>Đơn giá </strong></td>
        <td>Thành tiền</td>
      </tr>
<?php 
    $i= 1;
    foreach($arr->partPC as $item ){
      
?>

      <tr valign="middle">
        <td><?= $i ; ?></td>
        <td><?= $item->id ;?></td>
        <td>
          <img src="<?= $item->image ?>" align="absmiddle" width="70" alt="Phần mềm Office Home and Business 2021 All Lng APAC EM PK Lic Online DwnLd NR T5D-03483" />
        </td>
        <td><b><?= $item->name ?></b><br /></td>
        <td align="center">0 tháng</td>
        <td align="center">1</td>
        <td align="center"> <?= $item->price ?> VNĐ</td>
        <td>
        <?= $item->quantity ?> VNĐ
        </td>
      </tr>
<?php   $i++; }; ?>

      <tr>
        <td colspan="5"></td>
        <td colspan="2" align="right" style="background: #b8cce4;">Tổng tiền đơn hàng</td>
        <td style="background: #b8cce4;"><?= $arr->totalPrice ?></td>
      </tr>
    </table>

    <br />
    <br />

    <b>Quý khách lưu ý:</b> Giá bán, khuyến mại của sản phẩm và tình trạng còn hàng có thể bị thay đổi bất cứ lúc nào mà không kịp báo trước<br />
    Để biết thêm chi tiết, Quý khách vui lòng liên hệ Mega qua hotline: 0886.886.139 hoặc email:
    <a href="mailto:hotro@mega.com.vn">duong_startok@gmail.com</a><br />
    Một lần nữa MSC chúng tôi xin chân thành cảm ơn quý khách!
  </div>
</body>

</html>