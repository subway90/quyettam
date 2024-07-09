<div class="h2 text-center text-danger text-uppercase mt-3">
    Quyên góp
</div>
<div class="w-100" id="bannerContainer">
    <p id="bannerDonate">
        <?= $banner ?>
    </p>
</div>
<?php
// echo '<pre>';
// print_r($_SESSION['data']); 
// echo '</pre>';
// exit;
# RESULT
if ($success) {
    ?>
    <div class="mt-5">
        <table class="table table-hover table-responsive">
            <tr class="form-group">
                <td>Mã đơn hàng:</td>
                <td><?php echo $_GET['vnp_TxnRef'] ?></td>
            </tr>
            <tr class="form-group">

                <td>Số tiền:</td>
                <td><?php echo number_format($_GET['vnp_Amount'] / 100) ?> vnđ</td>
            </tr>
            <tr class="form-group">
                <td>Nội dung thanh toán:</td>
                <td><?php echo $_GET['vnp_OrderInfo'] ?></td>
            </tr>
            <tr class="form-group">
                <td>Mã phản hồi (vnp_ResponseCode):</td>
                <td><?php echo $_GET['vnp_ResponseCode'] ?></td>
            </tr>
            <tr class="form-group">
                <td>Mã GD Tại VNPAY:</td>
                <td><?php echo $_GET['vnp_TransactionNo'] ?></td>
            </tr>
            <tr class="form-group">
                <td>Mã Ngân hàng:</td>
                <td><?php echo $_GET['vnp_BankCode'] ?></td>
            </tr>
            <tr class="form-group">
                <td>Thời gian thanh toán:</td>
                <td><?php echo $_GET['vnp_PayDate'] ?></td>
            </tr>
            <tr class="form-group">
                <td>Kết quả:</td>
                <td>
                    <?= $result_status ?>
                </td>
            </tr>

        </table>
        <div class="text-center">
            <a href="<?= URL ?>quyen-gop" class="nav-link text-danger">&rarr; quay trở về</a>
        </div>
    </div>
<?php }
# CHOOSE PAY METHOD
if ($choose_pay === true) { ?>
    <div class="my-5 row d-flex justify-content-center pb-lg-5">
        <div class="col-12 text-center mb-3 h6">
            Chọn hình thức của bạn
        </div>
        <a href="<?= URL ?>quyen-gop/qr" class="css-box-donate col-12 col-lg-2 border shadow rounded-3 text-hover text-center py-2 mx-0 my-3 mx-lg-2 nav-link">
            <div class=""><i class="fas fa-qrcode"></i></div>
            <div class="">Quét mã QR E-banking</div>
        </a>
        <a href="<?= URL ?>quyen-gop/vnpay" class="css-box-donate col-12 col-lg-2 border shadow rounded-3 text-hover text-center py-2 mx-0 my-3 mx-lg-2 nav-link">
            <div class=""><i class="fas fa-qrcode"></i></div>
            <div class="">VNPAY tích hợp</div>
        </a><a href="<?= URL ?>quyen-gop/momo" class="css-box-donate col-12 col-lg-2 border shadow rounded-3 text-hover text-center py-2 mx-0 my-3 mx-lg-2 nav-link">
            <div class=""><i class="fas fa-qrcode"></i></div>
            <div class="">Ví momo</div>
        </a>
    </div>
<?php }
# VNPAY METHOD
if ($vnpay_method) { ?>
    <div class="mt-5">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-12 text-center mb-5 d-flex justify-content-center align-items-center">
                    <div class="text-hover">
                        <a href="<?= URL ?>quyen-gop" class="nav-link d-inline border border rounded-2 px-2 py-1">&larr; trở về</a>
                    </div>
                    <div class="text-danger border-start border-3 ms-2 ps-2">
                        <span class="">Phương thức chuyển khoản cổng thanh toán VNPAY</span>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="h6">Nhập họ và tên của bạn</p>
                </div>
                <div class="col-12 mb-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="form-floating">
                                <input name="name" value="<?= $name ?>"
                                    class="form-control text-center float-center text-danger" type="text" placeholder="a"
                                    id="name">
                                <label class="small" for="name">Tên của bạn, <i>ví dụ: NGUYỄN VĂN A</i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="h6">Chọn số tiền bạn muốn ủng hộ</p>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount10" name="chooseAmount"
                        value="10000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount10">10,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount20" name="chooseAmount"
                        value="20000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount20">20,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount30" name="chooseAmount"
                        value="30000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount30">30,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount40" name="chooseAmount"
                        value="40000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount40">40,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount50" name="chooseAmount"
                        value="50000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount50">50,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount100" name="chooseAmount"
                        value="100000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount100">100,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount200" name="chooseAmount"
                        value="200000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount200">200,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmountOther" name="chooseAmount"
                        value="0">
                    <label onclick="showInputOther()" class="form-check-label css-label-input" for="chooseAmountOther">số
                        tiền khác</label>
                </div>
                <div id="inputOther" class="col-12 mt-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-lg-3">
                            <div class="form-floating">
                                <input min="1000" max="900000000" value="" class="form-control text-center float-center"
                                    placeholder="" type="number" id="chooseAmountOther" name="chooseAmountOther">
                                <label for="chooseAmountOther">Nhập số tiền bạn ủng hộ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <button name="createVnpay" value="true" type="submit" class="btn btn-sm btn-outline-danger">Tiếp tục</button>
                </div>
            </div>
        </form>
    </div>
<?php }
# QR METHOD
if ($qr_method) { ?>

<div class="mt-5">
    <form method="post">
        <div class="row d-flex justify-content-center">
            <div class="col-12 text-center mb-5 d-flex justify-content-center align-items-center">
                <div class="text-hover">
                    <a href="<?= URL ?>quyen-gop" class="nav-link d-inline border border rounded-2 px-2 py-1">&larr; trở về</a>
                </div>
                <div class="text-danger border-start border-3 ms-2 ps-2">
                    <span class="">Phương thức chuyển khoản điện tử E-banking - quét mã QR</span>
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <p class="h6">Nhập họ và tên của bạn</p>
            </div>
            <div class="col-12 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-12 col-lg-3">
                        <div class="form-floating">
                            <input name="name" value="<?= $name ?>"
                                class="form-control text-center float-center text-danger" type="text" placeholder="a"
                                id="name">
                            <label class="small" for="name">Tên của bạn, <i>ví dụ: NGUYỄN VĂN A</i></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <p class="h6">Chọn số tiền bạn muốn ủng hộ</p>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount10" name="chooseAmount"
                    value="10000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount10">10,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount20" name="chooseAmount"
                    value="20000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount20">20,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount30" name="chooseAmount"
                    value="30000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount30">30,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount40" name="chooseAmount"
                    value="40000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount40">40,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount50" name="chooseAmount"
                    value="50000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount50">50,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount100" name="chooseAmount"
                    value="100000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount100">100,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmount200" name="chooseAmount"
                    value="200000">
                <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount200">200,000
                    <small>vnđ</small></label>
            </div>
            <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                <input class="form-check-input css-input" type="radio" id="chooseAmountOther" name="chooseAmount"
                    value="0">
                <label onclick="showInputOther()" class="form-check-label css-label-input" for="chooseAmountOther">số
                    tiền khác</label>
            </div>
            <div id="inputOther" class="col-12 mt-3">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-lg-3">
                        <div class="form-floating">
                            <input min="1000" max="900000000" value="" class="form-control text-center float-center"
                                placeholder="" type="number" id="chooseAmountOther" name="chooseAmountOther">
                            <label for="chooseAmountOther">Nhập số tiền bạn ủng hộ</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <button name="createQR" value="true" type="submit" class="btn btn-sm btn-outline-danger">Tiếp tục</button>
                <a href="<?= URL ?>quyen-gop" class="nav-link text-center text-danger mt-3">&rarr; quay lại trang trước</a>
            </div>
        </div>
    </form>
</div>

<?php } 
# MOMO METHOD
if ($momo_method) {
?>

<div class="mt-5">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-12 text-center mb-5 d-flex justify-content-center align-items-center">
                    <div class="text-hover">
                        <a href="<?= URL ?>quyen-gop" class="nav-link d-inline border border rounded-2 px-2 py-1">&larr; trở về</a>
                    </div>
                    <div class="text-danger border-start border-3 ms-2 ps-2">
                        <span class="">Phương thức chuyển khoản ví điện tử Momo</span>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="h6">Nhập họ và tên của bạn</p>
                </div>
                <div class="col-12 mb-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="form-floating">
                                <input name="name" value="<?= $name ?>"
                                    class="form-control text-center float-center text-danger" type="text" placeholder="a"
                                    id="name">
                                <label class="small" for="name">Tên của bạn, <i>ví dụ: NGUYỄN VĂN A</i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="h6">Chọn số tiền bạn muốn ủng hộ</p>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount10" name="chooseAmount"
                        value="10000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount10">10,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount20" name="chooseAmount"
                        value="20000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount20">20,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount30" name="chooseAmount"
                        value="30000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount30">30,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount40" name="chooseAmount"
                        value="40000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount40">40,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount50" name="chooseAmount"
                        value="50000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount50">50,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount100" name="chooseAmount"
                        value="100000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount100">100,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount200" name="chooseAmount"
                        value="200000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount200">200,000
                        <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmountOther" name="chooseAmount"
                        value="0">
                    <label onclick="showInputOther()" class="form-check-label css-label-input" for="chooseAmountOther">số
                        tiền khác</label>
                </div>
                <div id="inputOther" class="col-12 mt-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-lg-3">
                            <div class="form-floating">
                                <input min="1000" max="900000000" value="" class="form-control text-center float-center"
                                    placeholder="" type="number" id="chooseAmountOther" name="chooseAmountOther">
                                <label for="chooseAmountOther">Nhập số tiền bạn ủng hộ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <button name="createMomo" value="true" type="submit" class="btn btn-sm btn-outline-danger">Tiếp tục</button>
                    <a href="<?= URL ?>quyen-gop" class="nav-link text-center text-danger mt-3">&larr; quay lại trang trước</a>
                </div>
            </div>
        </form>
    </div>


<?php }

# SHOW QR CREATED
if($qr_show){ ?>

<div class="row">
    <div class="col-8">
        <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" value="<?= $qr_token ?>" id="floatingInput" placeholder="null">
            <label for="floatingInput">Token lịch sử giao dịch</label>
        </div>
        <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" value="<?= $qr_name ?>" id="floatingInput" placeholder="null">
            <label for="floatingInput">Tên của bạn</label>
        </div>
        <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" value="<?= $qr_amount ?>" id="floatingInput" placeholder="null">
            <label for="floatingInput">Số tiền ủng hộ</label>
        </div>
        <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" value="<?= $qr_content ?>" id="floatingInput" placeholder="null">
            <label for="floatingInput">Nội dung chuyển khoản</label>
        </div>
        <div class="form-floating mb-3">
            <input disabled type="text" class="form-control" value="<?= $qr_info_host ?>" id="floatingInput" placeholder="null">
            <label for="floatingInput">Thông tin TK thụ hưởng</label>
        </div>
        <div class="">
            <a href="<?= URL ?>quyen-gop/qr" class="btn rounded-2 text-hover px-2 py-1">&larr; quay lại</a>
            <a href="<?= URL ?>quyen-gop/qr/check/<?=$qr_token?>" class="btn btn-sm btn-danger">Tôi đã chuyển khoản</a>
        </div>
        <div class="w-100 mt-2">
            <p class="text-danger h6">Xin hãy lưu ý :</p>
            <p>
                <strong>Các trường hợp ngừng chuyển khoản :</strong>
                <ol class="small">
                    <li>
                    Chỉ thanh toán bằng cách quét mã QR trên, nếu khi quét mã mà thông tin chuyển khoản không chính xác như trong ảnh.
                    </li>
                    <li>
                    Nếu thông tin thụ hưởng TK không trùng khớp với thông tin như trong ảnh.
                    </li>
                </ol>
            </p>
            <p>Sau khi thanh toán vui lòng đợi 5 &rarr; 10 phút thông tin sẽ được cập nhật, bạn có thể nhấn <a href="<?= URL ?>quyen-gop/qr/check/<?=$qr_token?>" class="text-decoration-none text-danger">Tôi đã chuyển khoản</a></p> để kiểm tra cập nhật.
            <p><strong>Hotline hỗ trợ :</strong> 0965 279 041 (Mr. Hiếu)</p>

        </div>
    </div>
    <div class="col-4">
        <img class="w-100" src="<?= $qr_image ?>" alt="qr quyên góp">
    </div>
</div>

<?php }
# RESULT MOMO
if($result_momo) {
?>
Kết quả... <?= $abc ?>
<?php }?>
<script>
    const inputOtherElement = document.getElementById('inputOther');
    inputOtherElement.style.display = 'none';

    function showInputOther() {
        const inputOtherElement = document.getElementById('inputOther');
        inputOtherElement.style.display = 'inline-block';
    }
    function hideInputOther() {
        const inputOtherElement = document.getElementById('inputOther');
        inputOtherElement.style.display = 'none';
    }
</script>