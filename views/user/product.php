<div class="row">
    <?php
    for ($i=0; $i < count($list_product); $i++) { 
        extract($list_product[$i]);
        ?>
        <div class="col-6 col-md-4 col-lg-2 pb-3 pb-md-4 pb-lg-5">
            <div style="min-height: 100%;" class="card shadow">
                <div class="position-relative hover-trigger">
                    <img src="<?= URL .'publics/image/product/'. $imgDefault ?>" class="card-img img-product" alt="<?= $imgDefault ?>">
                    <span style="left: 84%; top: -4%; width: 45px; height: 45px"
                        class="btn bg-danger text-light rounded-circle position-absolute small p-0 pt-2 fw-bold ">0%</span>
                    <span class="show-hover position-absolute end-0 bottom-0 w-100">
                        <div class="d-flex justify-content-evenly">
                            <form method="post">
                                <button name="addProduct" type="submit" class="btn btn-success">
                                    <i class="fa fa-cart-plus"></i>
                                    <div class="fs-6 small"><small>giỏ hàng</small></div>
                                </button>
                                <button name="addNowProduct" type="submit" class="btn btn-success">
                                    <i class="fas fa-cart-arrow-down"></i>
                                    <div class="fs-6 small"><small>mua ngay</small></div>
                                </button>
                            </form>
                        </div>
                    </span>
                </div>
                <div class="ms-2">
                    <span class="badge bg-warning">KM</span>
                    <span class="badge bg-success">Trả góp 0%</span>
                </div>
                <a class="text-decoration-none" href="<?= URL . 'chi-tiet/' . $slug ?>/">
                    <div class="card-body">
                        <h5 class="card-title fs-6 fw-bold text-dark"> <?= $name ?> </h5>
                        <p class="card-text">
                            <span ng-if="product.priceSale!=0">
                                <span class="text-secondary small"><del><small><?= number_format($price) ?> đ</small></del></span>
                            </span>
                        </p>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</div>