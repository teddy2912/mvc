<?php if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) unset($_SESSION['cart']) ?>
<?php
function xoa()
{
    if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
        array_splice($_SESSION['cart'], $_GET['delid'], 1);
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <!-- hiệu ứng button -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .cart_navigation button {
            background: #fff;
        }
    </style>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="./public/css/gioithieu.css">
    <link rel="stylesheet" href="./public/css/giohang.css">
</head>

<body>
    <!-- start header -->
    <?php include_once './View/inc/header.php' ?>
    <!-- end header -->
    <!-- start content -->
    <div class="content">
        <div class="container">
            <div class="container">
                <div class="top-content">
                    <div>
                        <p> <a href="index.php">Trang chủ</a>
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            Liên hệ
                        </p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="wrapper">
                <table class="table table-bordered cart_summary">
                    <thead>
                        <tr>
                            <th class="cart_product">Ảnh sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th class="action"><i class="fa fa-trash-o"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($productList as $product) { ?>
                            <tr>
                                <td>
                                    <img style="width: 100px; height: 100px;" src="<?php echo $product['image']; ?>" alt="">
                                </td>
                                <td><?php echo $product['name']; ?></td>
                                <td><?php echo $product['price']; ?>,000đ</td>
                                <td><?php echo $product['quantity']; ?></td>
                                <td><?php echo calc_product_price($product); ?>,000đ</td>
                                <td><a href="<?php echo url_pattern('homeController', 'cartDelete', $product['productId']); ?>"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                        <?php    } ?>
                    </tbody>
                    <tfoot>
                        <?php $total_all = 0; ?>
                        <?php if (count($productList) > 0) foreach ($productList as $product) { ?>
                        <?php
                            $total_all += $product['price'] * $product['quantity'];
                        } ?>
                        <tr>
                            <th>Tổng</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <th> <?= number_format($total_all) ?>,000đ</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="cart_navigation ">
                    <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3">
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-top:0px">THANH TOÁN</button>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">HÓA ĐƠN</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="formPay" method="post">
                                                    <input type="hidden" name="controller" value="homeController">
                                                    <input type="hidden" name="page" value="payProcess">
                                                    <label for="inputPassword5" class="form-label">Họ và tên</label>
                                                    <input type="text" class="form-control" placeholder="Họ và tên" value="<?php echo $user['name']; ?>" name="name">
                                                    <label for="inputPassword5" class="form-label">Số điện thoại</label>
                                                    <input type="text" class="form-control" placeholder="Số điện thoại" value="<?php echo $user['phone']; ?>" name="phone">
                                                    <label for="inputPassword5" class="form-label">Địa chỉ</label>
                                                    <input type="text" class="form-control" placeholder="Địa chỉ" value="<?php echo $user['address']; ?>" name="address">
                                                    <label for="exampleFormControlTextarea1" class="form-label">Ghi chú về đơn hàng</label>
                                                    <textarea name="note" class="form-control" placeholder="Ghi chú đơn hàng, ví dụ: thời gian giao hay địa điểm giao chi tiết" rows="3"></textarea>
                                                    <input name="paymentMethod" id="paymentMethod-93948" type="radio" class="input-radio" data-bind="paymentMethod" value="93948"> Thanh toán khi nhận hàng
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" form="formPay" class="btn btn-outline-danger">THANH TOÁN</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end content -->
        <!-- start footer -->
        <?php include_once './View/inc/footer.php' ?>
        <!-- end footer -->
        <button id="myBtn" title="Lên đầu trang"><img src="https://cdn.pixabay.com/photo/2013/07/12/19/20/arrow-154593_960_720.png" title='lên đầu trang' width='14px' /></button>

        <script src="./public/js/lendautrang.js"></script>


        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>