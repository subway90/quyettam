<div class="h2 text-center text-danger text-uppercase mt-3">
    mua sản phẩm
</div>
<div class="row">
    <?php
    for ($i = 0; $i < count($list_product); $i++) {
        extract($list_product[$i]);
        ?>
        <div class="col-6 col-md-4 col-lg-2 pb-3 pb-md-4 pb-lg-5">
            <div style="min-height: 100%;" class="card shadow product">
                <div class="position-relative hover-trigger">
                    <img src="<?= URL . 'publics/image/product/' . $imgDefault ?>" class="card-img img-product"
                        alt="<?= $imgDefault ?>">
                    <span style="left: 84%; top: -4%; width: 45px; height: 45px"
                        class="btn bg-<?= $quantity ? 'warning ' . $quantity : 'danger' ?> text-light rounded-circle position-absolute small p-0 fw-bold "><small
                            class="d-block"><?= $quantity ? 'còn ' . $quantity : 'hết hàng' ?></small></span>
                    <span class="show-hover position-absolute end-0 bottom-0 w-100">
                        <form method="post">
                            <div class="d-flex justify-content-evenly">
                                <button name="share" type="submit" class="btn btn-success">
                                    <i class="far fa-share-square"></i>
                                    <div class="small"><small>chia sẻ</small></div>
                                </button>
                                <button <?= $quantity ? ' ' . $quantity : 'disabled' ?> name="buyNow" type="submit"
                                    class="btn btn-success">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <div class="small"><small>mua ngay</small></div>
                                </button>
                            </div>
                        </form>
                    </span>
                </div>
                <div class="ms-2">
                    <span class="badge bg-warning"><?= $view ?><i class="fas fa-eye ms-1"></i></span>
                    <span class="badge bg-success"><?= 1 ?> <i class="fas fa-shopping-bag ms-1"></i></span>
                    <span class="badge bg-danger"><?= 5 ?> <i class="fas fa-star ms-1"></i></i></span>
                </div>
                <a class="nav-link" href="<?= URL . 'chi-tiet/' . $slug ?>/">
                    <div class="card-body">
                        <h5 class="card-title fs-6 fw-bold text-hover"> <?= $name ?> </h5>
                        <form action="" method="post">
                            <div class="d-flex justify-content-between">
                                <span class="w-50 text-danger fw-bold"><?= number_format($price) ?> <sup>vnđ</sup></span>
                                <button type="submit" name="addCart" value="<?=$id?>" <?= $quantity ? ' ' . $quantity : 'disabled' ?>
                                    class="w-50 btn btn-sm btn-outline-danger p-0"><small>thêm vào giỏ</small></button>
                            </div>
                        </form>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</div>