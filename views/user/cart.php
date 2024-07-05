<div class="h2 text-center text-danger text-uppercase mt-3">
    giỏ hàng
</div>
<div class="row">
    <div class="col-12 col-md-12 col-lg-8 p-0">
        <div class="table-responsive-sm">
            <table class="table table-hover rounded-3 small">
                <thead class="align-middle text-end">
                    <th class="text-start">Sản phẩm</th>
                    <th>Giá</th>
                    <th class="text-center">Số lượng</th>
                    <th>Thành tiền</th>
                    <th>Xóa</th>
                </thead>
                <tbody class="align-middle text-end">
                    <?php 
                        if($total){ 
                            foreach ($array_product_in_cart as $row) {
                    ?>
                    <tr class="align-middle">
                        <td class="text-start d-flex align-items-center"> 
                            <div><img width="50" src="<?=URL_IMAGE_PRODUCT.$row['imgDefault']?>" alt="<?=$row['imgDefault']?>"></div>
                            <div>
                                <span class="text-danger ms-2 fw-bold"><?= $row['name'] ?> </span>
                            </div>
                        </td>
                        <td> <?= number_format($row['price']) ?> đ</td>
                        <td>
                            <form method="post">
                            <input type="hidden" name="idCart" value="<?= null ?>">
                            <div class="btn-group d-flex align-items-center mx-auto w-25 justify-content-center">
                                <button name="quantity" value="<?=$row['quantity']-1?>" class="btn btn-outline-danger btn-sm" <?php if($row['quantity']==1) echo'disabled'?>><i class="fas fa-minus"></i></button>
                                    <span class="mx-2"> <?= $row['quantity'] ?> </span>
                                <button name="quantity" value="<?=$row['quantity']+1?>" class="btn btn-outline-danger btn-sm" <?php if($row['quantity']==$row['quantityMax']) echo'disabled'?>><i class="fas fa-plus"></i></button>
                            </div>
                            </form>
                        </td>
                        <td class="text-end"><?= number_format($row['quantity'] * $row['price']) ?> đ</td>
                        <td class="text-end">
                            <button name="removeCart" value="???" type="submit" class="btn btn-sm border text-hover">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-end">
                                <button name="removeCart" type="submit" class="btn btn-sm border text-hover">
                                    <i class="fa-solid fa-trash"></i> tất cả
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                    <?php }else{?>
                    <tr>
                        <td colspan="6" class="text-center">Chưa có sản phẩm nào <a class="nav-link text-danger" href="<?=URL?>mua-san-pham">&rarr; Cửa hàng</a></td>
                    </tr>
                    <?php }?>
            </table>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-4 p-0 ps-lg-3">
        <form method="post">
            <label for="voucher">Mã giảm giá</label>
            <div class="input-group mt-1">
                <input type="text" name="voucher" id="voucher" class="form-control text-danger" placeholder="Nhập mã giảm giá tại đây...">
                <button <?= $total ? '' : 'disabled' ?> type="submit" class="btn btn-outline-danger">Áp dụng</button>
            </div>
        </form>
        <div class="border px-4 py-2 rounded-3 mt-3">
            <div class="h5 py-3 text-center text-lg-start">Giỏ hàng</div>
            <?php 
            if($total) { 
                foreach ($array_product_in_cart as $row) {
            ?>
            <div class="w-100 d-flex justify-content-between py-2">
                <div class="">
                    <?= $row['name'] ?>
                    <div class="small text-muted">số lượng: <?= $row['quantity'] ?></div>
                </div>
                <div class=""><?= number_format( $row['price'] * $row['quantity'] )?> đ</div>
            </div>
            <?php } ?>
            <div class="h5 mt-3 text-center text-lg-start">Hóa đơn</div>
            <div class="w-100 d-flex justify-content-between py-2">
                <div class="">Sản phẩm</div>
                <div class=""><?= number_format($total) ?> đ</div>
            </div>
            <div class="w-100 d-flex justify-content-between py-2">
                <div class="">Mã giảm giá</div>
                <div class=""><?= 0 ?> đ</div>
            </div>
            <hr class="w-100 border border-success border-1 my-1">
            <div class="w-100 d-flex justify-content-between py-2 fw-bold">
                <div class="">TỔNG THANH TOÁN</div>
                <div class="text-danger"><?= number_format($total) ?> đ</div>
            </div>
            <?php }else {?>
            <div class="w-100 d-flex justify-content-center py-2">
                Chưa có sản phẩm
            </div>
            <?php }?>
        </div>
        <?php
        if($total) {?>
        <div class="py-3">
            <button type="submit" class="w-100 btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#<?=$show_invoice?>">Thanh toán</button>
        </div>
        <?php }?>
    </div>
</div>

<!-- Modal Thanh Toán -->
<?php if($total) {?>
  <div class="modal modal-lg fade" id="<?=$show_invoice?>" tabindex="-1" aria-labelledby="ModalPay" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ModalPay">Tạo hóa đơn</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <?php if(!$_SESSION['account']) {?>
                <div class="col-12">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Bạn chưa đăng nhập ! Hãy đăng nhập để <strong>lưu lịch sử mua hàng</strong> và <strong>tích điểm</strong> 
                        <a class="text-decoration-none text-danger fw-bold" href="<?=URL?>dang-nhap&addCart">&rarr; Đăng nhập</a> hoặc  
                        <a class="text-decoration-none text-danger fw-bold" href="<?=URL?>dang-ky&addCart">&rarr; Đăng ký</a>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <?php }?>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="fs-6 fw-bold mb-2 text-center text-lg-start">Danh sách sản phẩm</div>
                    <table class="table responsive table-hover align-middle text-end">
                        <thead class="fw-bold">
                            <tr>
                                <td class="text-start">Tên sản phẩm</td>
                                <td>Giá</td>
                                <td>Số lượng</td>
                                <td>Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody class="small">
                        <?php 
                        foreach ($array_product_in_cart as $row_product) {
                        ?>
                            <tr>
                                <td class="text-start">
                                    <img width="50" src="<?=URL_IMAGE_PRODUCT.$row_product['imgDefault']?>" alt="<?=$row_product['imgDefault']?>">
                                    <?= $row_product['name'] ?>
                                </td>
                                <td><?=number_format($row_product['price'])?> đ</td>
                                <td><?= $row_product['quantity'] ?></td>
                                <td><?=number_format($row_product['price'] * $row_product['quantity'])?> đ</td>
                            </tr>
                        <?php }?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end text-danger"><strong>TỔNG </strong><?= number_format($total) ?> đ</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="fs-6 mb-2 text-center text-lg-start"><span class="fw-bold">Thông tin giao hàng</span> <span>(<span class="text-danger">&#10033;</span> : thông tin bắt buộc điền)</span></div>
                    <form method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="fullName" value="<?= $info_name ?>" class="form-control" id="fullName" placeholder="none">
                                    <label for="fullName">Họ và tên <span class="text-danger">&#10033;</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="phone" value="<?= $info_phone ?>" class="form-control" id="phone" placeholder="none">
                                    <label for="phone">Số điện thoại <span class="text-danger">&#10033;</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="address" value="<?= $info_address ?>" class="form-control" id="address" placeholder="none">
                                    <label for="address">Địa chỉ giao hàng <span class="text-danger">&#10033;</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <select name="payment_method" type="text" class="form-control" id="pay" placeholder="none">
                                        <?php
                                            // alert($payment_method);
                                        ?>
                                        <option <?php $payment_method == 1 ? 'selected' : '' ?> value="1">Tiền mặt (Cash On Delivery - Trả tiền lúc nhận hàng)</option>
                                        <option <?php $payment_method == 2 ? 'selected' : '' ?> value="2">Chuyển khoản trực tuyến ( Ebanking - quét mã QR )</option>
                                        <option <?php $payment_method == 3 ? 'selected' : '' ?> value="3">Ví điện tử momo ( Chuyển tiền hoặc quét mã QR )</option>
                                    </select>
                                    <label for="pay">Phương thức thanh toán <span class="text-danger">&#10033;</span></label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="email" value="<?= $info_email ?>" class="form-control" id="email" placeholder="none">
                                    <label for="email">E-mail (nhận thông báo)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="message" value="<?= $message ?>" class="form-control" id="scription" placeholder="none">
                                    <label for="scription">Mô tả (link FB, SĐT khác, ghi chú)</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- show error -->
                        </div>
                        <div class="col-12 text-center text-lg-start">
                            <button name="createInvoice" type="submit" class="btn btn-danger">Tiếp tục</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
      </div>
    </div>
  </div>
<?php }?>