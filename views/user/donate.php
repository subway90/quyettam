<div class="h2 text-center text-danger text-uppercase mt-3">
    Quyên góp
</div>
<?php
# FORM DONATE SUCCESS
if (isset($success)) {
    ?>
    <div class="container">
        <div class="header clearfix">
            <h3 class="text-muted">VNPAY RESPONSE</h3>
        </div>
        <div class="table-responsive">
            <div class="form-group">
                <label>Mã đơn hàng:</label>

                <label><?php echo $_GET['vnp_TxnRef'] ?></label>
            </div>
            <div class="form-group">

                <label>Số tiền:</label>
                <label><?php echo number_format($_GET['vnp_Amount']/100) ?> vnđ</label>
            </div>
            <div class="form-group">
                <label>Nội dung thanh toán:</label>
                <label><?php echo $_GET['vnp_OrderInfo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã phản hồi (vnp_ResponseCode):</label>
                <label><?php echo $_GET['vnp_ResponseCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã GD Tại VNPAY:</label>
                <label><?php echo $_GET['vnp_TransactionNo'] ?></label>
            </div>
            <div class="form-group">
                <label>Mã Ngân hàng:</label>
                <label><?php echo $_GET['vnp_BankCode'] ?></label>
            </div>
            <div class="form-group">
                <label>Thời gian thanh toán:</label>
                <label><?php echo $_GET['vnp_PayDate'] ?></label>
            </div>
            <div class="form-group">
                <label>Kết quả:</label>
                <label>
                <?= $result_status ?>
                </label>
            </div>
            <div class="text-center">
                <a href="<?= URL ?>" class="nav-link text-danger">&rarr; quay về Trang chủ</a>
            </div>
        </div>
        <p>
            &nbsp;
        </p>
        <footer class="footer">
            <p>&copy; VNPAY <?php echo date('Y') ?></p>
        </footer>
    </div>
    <?php
    # FORM DONATE CREATE
} else { ?>
    <div class="row">
        <form id="frmCreateOrder" method="post">
            <div class="my-3">
                <label class="mb-2" for="amount">Số tiền bạn ủng hộ :</label>
                <input class="form-control" data-val="true" data-val-number="The field Amount must be a number."
                    data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount"
                    type="number" value="10000" />
            </div>
            <div class="h6">Chọn phương thức thanh toán</div>
                <div class="text-danger">Cách 1: Chuyển hướng sang Cổng VNPAY chọn phương thức thanh toán</div>
                
                <div class="form-check">
                    <input class="form-check-input" type="radio" Checked="True" id="bankCode" name="bankCode" value="">
                    <label class="form-check-label" for="bankCode">Cổng thanh toán VNPAYQR</label>
                </div>

                <div class="text-danger">Cách 2: Tách phương thức tại site của đơn vị kết nối</div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
                    <label class="form-check-label" for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="bankCode" name="bankCode" value="VNBANK">
                    <label class="form-check-label" for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="bankCode" name="bankCode" value="INTCARD">
                    <label class="form-check-label" for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
                </div>
            <div class="h6 mt-5">Chọn ngôn ngữ giao diện thanh toán:</div>
            <div class="form-check my-3">
                <input class="form-check-input" type="radio" id="language" Checked="True" name="language" value="vn">
                <label class="form-check-label" for="language">Tiếng việt</label><br>
                <input class="form-check-input" type="radio" id="language" name="language" value="en">
                <label class="form-check-label" for="language">Tiếng anh</label><br>

            </div>
            <button name="createVnpay" type="submit" class="btn btn-outline-danger" href>Tiếp tục</button>
        </form>
    </div>
<?php } ?>