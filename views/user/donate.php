<div class="h2 text-center text-danger text-uppercase mt-3">
    Quyên góp
</div>
<div class="w-100" id="bannerContainer">
    <p id="bannerDonate">
        <?= $banner ?>
    </p>
</div>
<?php
# FORM DONATE SUCCESS
if (isset($success)) {
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
    <?php
# FORM DONATE CREATE
} else { ?>
    <div class="mt-5">
        <form method="post">
            <div class="row d-flex justify-content-center">
                <div class="col-12 text-center mb-3">
                    <p class="h6">Nhập họ và tên của bạn</p>
                </div>
                <div class="col-12 mb-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-md-12 col-lg-3">
                            <div class="form-floating">
                                <input name="name" value="<?= $name ?>" class="form-control text-center float-center text-danger" type="text" placeholder="a" id="name">
                                <label class="small" for="name">Tên của bạn, <i>ví dụ: NGUYỄN VĂN A</i></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <p class="h6">Chọn số tiền bạn muốn ủng hộ</p>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount10" name="chooseAmount" value="10000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount10">10,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount20" name="chooseAmount" value="20000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount20">20,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount30" name="chooseAmount" value="30000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount30">30,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount40" name="chooseAmount" value="40000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount40">40,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount50" name="chooseAmount" value="50000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount50">50,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount100" name="chooseAmount" value="100000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount100">100,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmount200" name="chooseAmount" value="200000">
                    <label onclick="hideInputOther()" class="form-check-label css-label-input" for="chooseAmount200">200,000 <small>vnđ</small></label>
                </div>
                <div class="col-3 col-lg-1 my-1 my-lg-0 p-0 d-flex align-items-center justify-content-center">
                    <input class="form-check-input css-input" type="radio" id="chooseAmountOther" name="chooseAmount" value="0">
                    <label onclick="showInputOther()" class="form-check-label css-label-input" for="chooseAmountOther">số tiền khác</label>
                </div>
                <div id="inputOther" class="col-12 mt-3">
                    <div class="row d-flex justify-content-center">
                        <div class="col-12 col-lg-3">
                            <div class="form-floating">
                                <input min="1000" max="900000000" value="" class="form-control text-center float-center" placeholder="" type="number" id="chooseAmountOther" name="chooseAmountOther">
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
<?php } ?>
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