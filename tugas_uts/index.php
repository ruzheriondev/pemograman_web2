
<?php
// ========================================
// KONEKSI DATABASE XAMPP
// ========================================
$host = "localhost";
$user = "root";
$pass = "";
$db   = "calon_mhs";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

function aman($data) {
    return htmlspecialchars((string)$data, ENT_QUOTES, 'UTF-8');
}

$pesan = "";
$error = "";

// ========================================
// PROSES SIMPAN DATA
// ========================================
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
    $kode = strtoupper(trim($_POST["kode_pendaftaran"] ?? ""));
    $nama = trim($_POST["nama_pendaftar"] ?? "");
    $jk = $_POST["jenis_kelamin"] ?? "";
    $ttl = trim($_POST["ttl"] ?? "");
    $sekolah = trim($_POST["asal_sekolah"] ?? "");
    $pekerjaan = trim($_POST["pekerjaan_ortu"] ?? "");

    $matematika = filter_var(
        $_POST["matematika"] ?? null,
        FILTER_VALIDATE_INT
    );
    $inggris = filter_var(
        $_POST["bahasa_inggris"] ?? null,
        FILTER_VALIDATE_INT
    );
    $umum = filter_var(
        $_POST["umum"] ?? null,
        FILTER_VALIDATE_INT
    );

    // Validasi input
    if (
        $kode === "" || $nama === "" || $ttl === "" ||
        $sekolah === "" || $pekerjaan === ""
    ) {
        $error = "Semua data wajib diisi.";
    } elseif (!in_array($jk, ["Laki-laki", "Perempuan"], true)) {
        $error = "Silakan pilih jenis kelamin.";
    } elseif (
        $matematika === false || $matematika === null ||
        $inggris === false || $inggris === null ||
        $umum === false || $umum === null ||
        $matematika < 0 || $matematika > 100 ||
        $inggris < 0 || $inggris > 100 ||
        $umum < 0 || $umum > 100
    ) {
        $error = "Nilai tes harus berupa angka dari 0 sampai 100.";
    } else {
        // Menghitung rata-rata
        $rata = round(
            ($matematika + $inggris + $umum) / 3,
            2
        );

        // Menentukan keterangan
        if ($rata >= 70) {
            $keterangan = "Lulus";
        } elseif ($rata >= 60) {
            $keterangan = "Cadangan";
        } else {
            $keterangan = "Tidak Lulus";
        }

        // Menyimpan ke database
        $stmt = $conn->prepare(
            "INSERT INTO calon_mhs
            (
                kode_pendaftaran,
                nama_pendaftar,
                jenis_kelamin,
                ttl,
                asal_sekolah,
                pekerjaan_ortu,
                matematika,
                bahasa_inggris,
                umum,
                rata_rata,
                keterangan
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssssiiids",
            $kode,
            $nama,
            $jk,
            $ttl,
            $sekolah,
            $pekerjaan,
            $matematika,
            $inggris,
            $umum,
            $rata,
            $keterangan
        );

        if ($stmt->execute()) {
            // Redirect agar data tidak terkirim ulang saat refresh
            header("Location: index.php?status=berhasil");
            exit;
        } else {
            if ($stmt->errno == 1062) {
                $error = "Kode pendaftaran sudah digunakan.";
            } else {
                $error = "Gagal menyimpan data. Periksa struktur tabel.";
            }
        }

        $stmt->close();
    }
}

// Pesan setelah penyimpanan berhasil
if (isset($_GET["status"]) && $_GET["status"] === "berhasil") {
    $pesan = "Data calon mahasiswa berhasil disimpan!";
}

// ========================================
// MENGAMBIL DATA DARI DATABASE
// ========================================
$sql = "SELECT * FROM calon_mhs ORDER BY id ASC";
$result = $conn->query($sql);

$jumlahPendaftar = $result->num_rows;
$jumlahLulus = 0;
$jumlahTidakLulus = 0;
$jumlahCadangan = 0;

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;

    if ($row["keterangan"] === "Lulus") {
        $jumlahLulus++;
    } elseif ($row["keterangan"] === "Cadangan") {
        $jumlahCadangan++;
    } elseif ($row["keterangan"] === "Tidak Lulus") {
        $jumlahTidakLulus++;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Mahasiswa Baru</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f3f6;
            margin: 0;
            padding: 20px;
            color: #222;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            background: #173b70;
            color: white;
            padding: 22px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 8px;
            font-size: 25px;
        }

        .header p {
            margin: 0;
        }

        .card {
            background: white;
            padding: 22px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,.07);
        }

        .card h2 {
            margin-top: 0;
            color: #173b70;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
        }

        input:focus, select:focus {
            outline: 2px solid #c8dcff;
            border-color: #173b70;
        }

        .buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        button {
            border: none;
            padding: 10px 22px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-submit {
            background: #173b70;
            color: white;
        }

        .btn-batal {
            background: #ddd;
            color: #222;
        }

        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 9px;
            text-align: center;
            white-space: nowrap;
        }

        th {
            background: #dce5f1;
        }

        .status-lulus {
            color: green;
            font-weight: bold;
        }

        .status-cadangan {
            color: #a16a00;
            font-weight: bold;
        }

        .status-tidak {
            color: red;
            font-weight: bold;
        }

        .summary {
            margin-top: 18px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
        }

        .summary div {
            background: #edf2f8;
            padding: 12px;
            border-radius: 5px;
            font-size: 13px;
        }

        @media (max-width: 650px) {
            body {
                padding: 10px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <h1>PENDAFTARAN CALON MAHASISWA BARU</h1>
        <p>Program Studi Teknik Informatika</p>
    </div>

    <!-- FORM INPUT -->
    <div class="card">
        <h2>Input Pendaftaran</h2>

        <?php if ($pesan !== ""): ?>
            <div class="alert success">
                <?= aman($pesan) ?>
            </div>
        <?php endif; ?>

        <?php if ($error !== ""): ?>
            <div class="alert error">
                <?= aman($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php">
            <div class="form-grid">

                <div class="form-group">
                    <label for="kode_pendaftaran">Kode Pendaftaran</label>
                    <input
                        type="text"
                        id="kode_pendaftaran"
                        name="kode_pendaftaran"
                        placeholder="Contoh: A2-101-9"
                        maxlength="30"
                        required
                        value="<?= aman($_POST['kode_pendaftaran'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="nama_pendaftar">Nama Pendaftar</label>
                    <input
                        type="text"
                        id="nama_pendaftar"
                        name="nama_pendaftar"
                        maxlength="100"
                        required
                        value="<?= aman($_POST['nama_pendaftar'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki"
                            <?= (($_POST['jenis_kelamin'] ?? '') === 'Laki-laki') ? 'selected' : '' ?>>
                            Laki-laki
                        </option>
                        <option value="Perempuan"
                            <?= (($_POST['jenis_kelamin'] ?? '') === 'Perempuan') ? 'selected' : '' ?>>
                            Perempuan
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ttl">TTL</label>
                    <input
                        type="text"
                        id="ttl"
                        name="ttl"
                        placeholder="Tempat, tanggal lahir"
                        maxlength="100"
                        required
                        value="<?= aman($_POST['ttl'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="asal_sekolah">Asal Sekolah</label>
                    <input
                        type="text"
                        id="asal_sekolah"
                        name="asal_sekolah"
                        maxlength="100"
                        required
                        value="<?= aman($_POST['asal_sekolah'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ortu">Pekerjaan Orang Tua</label>
                    <input
                        type="text"
                        id="pekerjaan_ortu"
                        name="pekerjaan_ortu"
                        maxlength="100"
                        required
                        value="<?= aman($_POST['pekerjaan_ortu'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="matematika">Nilai Matematika</label>
                    <input
                        type="number"
                        id="matematika"
                        name="matematika"
                        min="0"
                        max="100"
                        required
                        value="<?= aman($_POST['matematika'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="bahasa_inggris">Nilai Bahasa Inggris</label>
                    <input
                        type="number"
                        id="bahasa_inggris"
                        name="bahasa_inggris"
                        min="0"
                        max="100"
                        required
                        value="<?= aman($_POST['bahasa_inggris'] ?? '') ?>"
                    >
                </div>

                <div class="form-group">
                    <label for="umum">Nilai Umum</label>
                    <input
                        type="number"
                        id="umum"
                        name="umum"
                        min="0"
                        max="100"
                        required
                        value="<?= aman($_POST['umum'] ?? '') ?>"
                    >
                </div>

            </div>

            <div class="buttons">
                <button
                    type="submit"
                    name="submit"
                    value="1"
                    class="btn-submit"
                >
                    SUBMIT
                </button>

                <button
                    type="reset"
                    class="btn-batal"
                >
                    BATAL
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="card">
        <h2>Tabel Data Pendaftar</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode</th>
                        <th>Kode Pendaftaran</th>
                        <th>Nama Pendaftar</th>
                        <th>Jenis Kelamin</th>
                        <th>TTL</th>
                        <th>Asal Sekolah</th>
                        <th>Pekerjaan Ortu</th>
                        <th>Matematika</th>
                        <th>B. Inggris</th>
                        <th>Umum</th>
                        <th>Rata-rata</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (count($data) === 0): ?>
                        <tr>
                            <td colspan="13">Belum ada data pendaftar.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data as $i => $row): ?>
                            <?php
                            $kelasStatus = "";

                            if ($row["keterangan"] === "Lulus") {
                                $kelasStatus = "status-lulus";
                            } elseif ($row["keterangan"] === "Cadangan") {
                                $kelasStatus = "status-cadangan";
                            } else {
                                $kelasStatus = "status-tidak";
                            }
                            ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= aman($row["id"]) ?></td>
                                <td><?= aman($row["kode_pendaftaran"]) ?></td>
                                <td><?= aman($row["nama_pendaftar"]) ?></td>
                                <td><?= aman($row["jenis_kelamin"]) ?></td>
                                <td><?= aman($row["ttl"]) ?></td>
                                <td><?= aman($row["asal_sekolah"]) ?></td>
                                <td><?= aman($row["pekerjaan_ortu"]) ?></td>
                                <td><?= aman($row["matematika"]) ?></td>
                                <td><?= aman($row["bahasa_inggris"]) ?></td>
                                <td><?= aman($row["umum"]) ?></td>
                                <td><?= number_format((float)$row["rata_rata"], 2) ?></td>
                                <td class="<?= $kelasStatus ?>">
                                    <?= aman($row["keterangan"]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- REKAP DATA -->
        <div class="summary">
            <div>
                Jumlah Pendaftar:
                <strong><?= $jumlahPendaftar ?></strong>
            </div>

            <div>
                Jumlah Peserta Lulus:
                <strong><?= $jumlahLulus ?></strong>
            </div>

            <div>
                Jumlah Cadangan:
                <strong><?= $jumlahCadangan ?></strong>
            </div>

            <div>
                Jumlah Tidak Lulus:
                <strong><?= $jumlahTidakLulus ?></strong>
            </div>
        </div>

        <p>
            <strong>Ketentuan kelulusan:</strong><br>
            Rata-rata ≥ 70 = Lulus<br>
            Rata-rata 60–69,99 = Cadangan<br>
            Rata-rata &lt; 60 = Tidak Lulus
        </p>
    </div>

</div>
</body>
</html>

<?php
$conn->close();
?>
