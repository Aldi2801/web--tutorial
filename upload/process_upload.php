<?php
// Tampilkan semua error untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Proses dimulai.");

    // Folder untuk menyimpan file yang diunggah
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Gagal membuat folder uploads.");
        }
    }

    // Mengambil data dari form
    $judul = htmlspecialchars($_POST['judul'] ?? '');
    $konten = htmlspecialchars($_POST['konten'] ?? '');
    $halaman = htmlspecialchars($_POST['halaman'] ?? '');

    // Validasi input
    if (empty($judul) || empty($konten) || empty($halaman)) {
        die("Judul, konten, dan halaman harus diisi.");
    }

    // Proses unggah file
    if (isset($_FILES['fileUpload']) && $_FILES['fileUpload']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fileUpload']['tmp_name'];
        $fileName = basename($_FILES['fileUpload']['name']);
        $fileDestination = $uploadDir . $fileName;

        if (!is_uploaded_file($fileTmpPath)) {
            die("File yang diunggah tidak valid.");
        }

        // Memindahkan file ke folder uploads
        if (move_uploaded_file($fileTmpPath, $fileDestination)) {
            error_log("File berhasil diunggah ke $fileDestination.");

            // Tambahkan konten ke halaman tujuan
            $filePath = __DIR__ . '/' . $halaman;

            if (file_exists($filePath)) {
                $additionalContent = "<h2>$judul</h2>\n<p>$konten</p>\n<a href='uploads/$fileName'>Download File</a><hr>\n";

                if (is_writable($filePath)) {
                    if (file_put_contents($filePath, $additionalContent, FILE_APPEND)) {
                        echo "Artikel dan file berhasil ditambahkan ke $halaman.";
                    } else {
                        die("Gagal menulis konten ke file $halaman.");
                    }
                } else {
                    die("File $halaman tidak dapat ditulisi.");
                }
            } else {
                die("File $halaman tidak ditemukan.");
            }
        } else {
            die("Gagal memindahkan file yang diunggah.");
        }
    } else {
        // Handle error code dari $_FILES['fileUpload']['error']
        $error = $_FILES['fileUpload']['error'] ?? UPLOAD_ERR_NO_FILE;
        switch ($error) {
            case UPLOAD_ERR_INI_SIZE:
                die("File terlalu besar. Maksimal " . ini_get('upload_max_filesize') . ".");
            case UPLOAD_ERR_FORM_SIZE:
                die("File melebihi batas maksimal formulir.");
            case UPLOAD_ERR_PARTIAL:
                die("File hanya terunggah sebagian.");
            case UPLOAD_ERR_NO_FILE:
                die("Tidak ada file yang diunggah.");
            case UPLOAD_ERR_NO_TMP_DIR:
                die("Folder temporary hilang.");
            case UPLOAD_ERR_CANT_WRITE:
                die("Gagal menulis file ke disk.");
            case UPLOAD_ERR_EXTENSION:
                die("Upload dihentikan oleh ekstensi.");
            default:
                die("Terjadi kesalahan tidak dikenal ($error).");
        }
    }
} else {
    die("Metode tidak valid.");
}
?>
