<div class="h2 text-center text-danger text-uppercase mt-3">
    bảng kết quả
</div>

<div class="mt-5 row d-flex justify-content-center">

<?php
# [TASKBAR ADMIN]
if($admin) {
?>
    <div class="col-12 col-lg-10 mb-4">
        <form method="post">
        <?php 
        # RESULT STATUS
        if($status_result == '1')  {?>
        <button name="status_result_show" type="submit" class="btn btn-sm border text-hover p-0 px-2">
            <small class="fw-bold">
                <i class="fas fa-eye"></i> Hiện đáp án
            </small>
        </button>
        <?php }else{ ?>
        <button name="status_result_hide" type="submit" class="btn btn-sm border text-hover p-0 px-2">
            <small class="fw-bold">
                <i class="fas fa-eye-slash"></i>Ẩn đáp án
            </small>
        </button>
        <?php } 

        # ACTIVE STATUS
        if($status_active == '1')  {?>
        <button name="status_active_false" type="submit" class="btn btn-sm border text-hover p-0 px-2">
            <small class="fw-bold">
            <i class="fas fa-stop-circle"></i> Kết thúc
            </small>
        </button>
        <?php }else{ ?>
        <button name="status_active_true" type="submit" class="btn btn-sm border text-hover p-0 px-2">
            <small class="fw-bold">
            <i class="fas fa-play-circle"></i> Tiếp tục
            </small>
        </button>
        <?php } ?>
        <button name="refresh" type="submit" class="btn btn-sm border text-hover p-0 px-2">
            <small class="fw-bold">
            <i class="fas fa-sync-alt"></i> Làm mới
            </small>
        </button>
        <input id="b_r" class="w-25 d-inline form-control form-control-sm p-0 ps-2 fst-italic text-danger float-end" name="reason_band" value="<?= $reason_band?>" placeholder="Nhập lí do trước khi cấm" type="text">
        <label for="b_r" class="float-end small btn btn-sm">Banned reason:</label>
        </form>
    </div>
<?php }?>

    <div class="col-12 col-lg-10">
        <table class="table border table-hover table-responsive">
            <thead>
                <tr>
                    <th class="ps-4">Thời gian gửi</th>
                    <th>Tên</th>
                    <th>Đáp án</th>
                    <th class="pe-4 text-end">Trạng thái</th>
                    <?php if($admin) {?>
                    <th class="text-end text-danger">Hành động</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($list_result) {
                    foreach ($list_result as $row) {
                ?>
                <tr>
                    <td class="ps-4">
                        <?= format_time($row['date_create'],'hh:mm:ss') ?>
                    </td>
                    <td>
                        <?= $row['name'] ?>
                    </td>
                    <td>
                        <?= $status_result == '1' ? '**********' : $row['value'] ?>
                    </td>
                    <td class="pe-4 text-end">
                        <?php
                            if($row['status'] === 1) echo '<span class="text-success">Thành công</span>' 
                        ?>
                    </td>
                    <?php
                    if($admin) { ?>
                    <td class="text-end">
                        <button type="submit" class="btn btn-sm border text-hover p-0 px-2">
                            <small class="fw-bold">
                                <i class="fas fa-ban"></i> band
                            </small>
                        </button>
                        <button type="submit" class="btn btn-sm border text-hover p-0 px-2">
                            <small class="fw-bold">
                                <i class="fas fa-trash"></i> hard
                            </small>
                        </button>
                    </td>
                    <?php }?>
                </tr>
                <?php }
                }else {?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Không có dữ liệu</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>