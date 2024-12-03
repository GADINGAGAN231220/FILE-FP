<!-- <?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
// if (!isset($_SESSION['user'])) {
//     header('Location: index.php');
//     exit;
// }

// Ambil data dari form
$user_id = $_POST['user_id'];
$bus_id = $_POST['bus_id'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$jumlah_kursi = $_POST['jumlah_kursi'];

// Mengambil data bus untuk mendapatkan harga dan jumlah kursi yang tersedia
$query = "SELECT * FROM buses WHERE id = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$bus = $stmt->get_result()->fetch_assoc();

// Cek apakah bus ditemukan
if (!$bus) {
    echo "Bus tidak ditemukan.";
    exit;
}

// Cek apakah kursi tersedia
if ($bus['available_seats'] >= $jumlah_kursi) {
    // Insert data reservasi ke database
    $query_reservation = "INSERT INTO reservation (user_id, bus_id, tanggal, jam, kursi) VALUES (?, ?, ?, ?, ?)";
    $stmt_reservation = $koneksi->prepare($query_reservation);
    $stmt_reservation->bind_param("iissi", $user_id, $bus_id, $tanggal, $jam, $jumlah_kursi);

    if ($stmt_reservation->execute()) {
        // Kurangi jumlah kursi yang tersedia di bus
        $new_available_seats = $bus['available_seats'] - $jumlah_kursi;
        $query_update_bus = "UPDATE buses SET available_seats = ? WHERE id = ?";
        $stmt_update_bus = $koneksi->prepare($query_update_bus);
        $stmt_update_bus->bind_param("ii", $new_available_seats, $bus_id);
        $stmt_update_bus->execute();

        // Redirect ke halaman sukses atau konfirmasi
        header('Location: pembayaran.php');
        exit;
    } else {
        echo "Gagal melakukan reservasi: " . $stmt_reservation->error;
    }
} else {
    // Jika kursi tidak tersedia
    echo "Maaf, kursi yang tersedia tidak cukup untuk jumlah yang Anda pilih.";
}
?> -->