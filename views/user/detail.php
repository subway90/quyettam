<div class="h2 text-center text-danger text-uppercase mt-3">
    <?= $product['name'] ?>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-lg-4">
        <div id="galery-product" class="carousel slide">
            <!-- [ẢNH LỚN] -->
            <?php
            $arrImage = explode(',', $product['imgList']);
            ?>
            <div class="carousel-inner position-relative">
                <?php
                for ($i = 0; $i < count($arrImage); $i++) { ?>
                    <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                        <img class="w-100" src="<?= URL . 'publics/image/product/' . $arrImage[$i] ?>"
                            alt="<?= $arrImage[$i] ?>">
                    </div>
                <?php } ?>
            </div>
            <span class="position-absolute top-50 w-100 d-flex justify-content-between">
                <button class="btn btn-danger rounded-pill" data-bs-target="#galery-product" data-bs-slide="prev">
                    <i class="fa fa-lg fa-angle-left text-center pe-1" aria-hidden="true"></i>
                </button>
                <button class="btn btn-danger rounded-pill " data-bs-target="#galery-product" data-bs-slide="next">
                    <i class="fa fa-lg fa-angle-right text-center ps-1" aria-hidden="true"></i>
                </button>
            </span>
        </div>
        <div class="container mt-3 d-flex justify-content-center">
            <!-- [ẢNH NHỎ] -->
            <div class="row d-flex justify-content-center">
                <?php
                for ($i = 0; $i < count($arrImage); $i++) {
                    ?>
                    <button class="col-2 border-0 hover-btn-galery-product" data-bs-target="#galery-product"
                        data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>">
                        <img class="w-100" src="<?= URL . 'publics/image/product/' . $arrImage[$i] ?>"
                            alt="<? $arrImage[$i] ?>">
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-8 mt-4 mt-lg-0 d-flex flex-column align-items-center  align-items-lg-start fs-5 ">
        <p><strong>Giá : </strong><span class="text-danger"><?= number_format($product['price']) ?> <sup>vnđ</sup></span></p>
        <p><strong>Mô tả: </strong><?= $product['decribe'] ?></p>
        <p><strong>Trạng thái: </strong><?= $product['quantity'] ? 'còn ' . $product['quantity'] : '<span class="text-danger">hết hàng</span>' ?></p>
        <div class="input-group d-flex" style="width:120px;" >
        <button id="minus" name="quantity" class="btn btn-success btn-sm"><i
                class="fas fa-minus"></i></button>
        <input class="form-control text-center" id="quantity" min="0" max="<?=$quantity?>" class="mx-2" name="quantity" value="0">
        <button id="plus" name="quantity" class="btn btn-success btn-sm"><i
                class="fas fa-plus"></i></button>
        </div>
        <div class="mt-3">
            <button class="btn btn-outline-danger me-2">Mua ngay</button>
            <button class="btn btn-warning bg-gradient">Thêm vào giỏ <i class="fas fa-shopping-cart"></i></button>
        </div>
    </div>
</div>
<script>
 // Get the quantity input and the plus/minus buttons
const quantityInput = document.getElementById('quantity');
const plusButton = document.getElementById('plus');
const minusButton = document.getElementById('minus');

// Add event listeners to the plus and minus buttons
plusButton.addEventListener('click', increaseQuantity);
minusButton.addEventListener('click', decreaseQuantity);

// Function to increase the quantity
function increaseQuantity() {
  let quantity = parseInt(quantityInput.value);
  quantity++;
  quantityInput.value = quantity;
  toggleButtonState();
}

// Function to decrease the quantity
function decreaseQuantity() {
  let quantity = parseInt(quantityInput.value);
  if (quantity > 0) {
    quantity--;
    quantityInput.value = quantity;
  }
  toggleButtonState();
}

// Function to toggle the disabled state of the buttons
function toggleButtonState() {
  let quantity = parseInt(quantityInput.value);
  if (quantity === 0) {
    minusButton.disabled = true;
  } else {
    minusButton.disabled = false;
  }
  if (quantity === <?=$product['quantity']?> || !<?=$product['quantity']?>) {
    plusButton.disabled = true;
  } else {
    plusButton.disabled = false;
  }
}
</script>