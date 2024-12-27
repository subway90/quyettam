<?php
$oldImages =  [
    "building/6737c07370b15.jpg"
];
$currentImages = [ 
    "building/6737c07370b15.jpg",
    "building/6737c3a450ee1.jpg",
    "building/6737c3a4527a7.jpg"
];

$delete_image = [];
$finalImagePaths = [];

foreach ($currentImages as $image) {
    // Kiểm tra nếu ảnh cũ tồn tại trong ảnh hiện tại
    if (in_array($image, $oldImages)) {
        $finalImagePaths[] = $image; // Giữ lại ảnh cũ
    } else {
        // Xóa ảnh không còn sử dụng
        $delete_image[] = $image;
    }
}

echo 'List xóa: ';
print_r($delete_image);
echo '<br>';
echo 'List hiện tại: ';
print_r($finalImagePaths);
