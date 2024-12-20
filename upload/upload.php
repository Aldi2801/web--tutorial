<?php
$uploadDir = __DIR__ . '/uploads/';
if (!is_dir($uploadDir)) {
    if (mkdir($uploadDir, 0777, true)) {
        echo "Folder 'uploads' berhasil dibuat.";
    } else {
        echo "Gagal membuat folder 'uploads'.";
    }
} else {
    echo "Folder 'uploads' sudah ada.";
}
?>