
<div class="h2 text-center text-danger text-uppercase mt-3">
    Khu vực kiểm thử
</div>
<p>Your IP: <?= $your_ip ?></p>
<p>Time: <span id="current-time"></span></p>
<div class="border border-1 border-danger p-5 mx-2 mx-lg-0">

    <div class="row justify-content-center">
        <div class="col-6">
            <h4 class="mb-5">Mô phỏng tính năng Bình luận không xử lí <span class="text-danger">lỗi XSS</span></h4>
            <div class="mb-2">
                <form action="" method="post">
                    <button name="refresh_data" type="submit" class="border border-1 btn btn-sm btn-outline-danger">
                        <i class="fas fa-refresh small"></i>
                        Refresh Data
                    </button>
                    <button onclick="window.open('<?=URL?>log')" class="border border-1 btn btn-sm btn-outline-danger">
                        <i class="fas fa-sign-in small"></i>
                        Log data
                    </button>
                </form>
                
            </div>
            <h5 class="mb-3">Bình luận bài viết</h5>

            <form action="" method="get">
                <div class="mb-2">
                    <label for="cmt" class="mb-2">Nhập tên của bạn</label>
                    <input id="cmt" type="text" name="name" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="cmt" class="mb-2">Nhập bình luận của bạn</label>
                    <textarea id="cmt" type="text" name="content" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-outline-primary">Gửi</button>
            </form>

            <h5 class="my-5">Hiển thị bình luận (<?= ($count_cmt) ? ($count_cmt) : 0 ?>)</h5>

            <?php
            if ($count_cmt) {
                foreach ($list_cmt as $cmt) {
                    ?>
                    <div class="card px-5 pt-4 mb-4">
                        <div class="d-flex">
                            <img class="rounded-circle" style="width: 50px; height: 50px"
                                src="https://www.shutterstock.com/image-vector/blank-avatar-photo-place-holder-600nw-1095249842.jpg"
                                alt="">
                            <div class="ms-2">
                                <h5> <?= $cmt['name'] ?> </h5>
                                <small> <?= format_time($cmt['create_at'], "hh:mm:ss ngày DD/MM") ?> </small>
                            </div>
                        </div>
                        <p class="my-3"> <?= $cmt['content'] ?> </p>
                    </div>

                <?php }
            } ?>
        </div>
    </div>

</div>

<script src="<?= URL ?>publics/js/time.js"></script>