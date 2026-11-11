
<?php

//cek button
if (isset($_POST['Submit']) && $_POST['Submit'] == "Submit") {

    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];

    //validasi data data kosong
    if (
        empty($_POST['id_mahasiswa']) ||
        empty($_POST['nama']) ||
        empty($_POST['alamat']) ||
        empty($_POST['telepon'])
    ) {
?>

<script language="JavaScript">
alert('Data Harap Dilengkapi!');
document.location='download-script-form-input-data.php';
</script>

<?php

    }

    else {

        include "koneksi-tutor.php";

        //cek NIM di database
        $id_mahasiswa = mysqli_real_escape_string($Open, $id_mahasiswa);

        $cek = mysqli_num_rows(mysqli_query($Open,
        "SELECT id_mahasiswa FROM mahasiswa WHERE id_mahasiswa='$id_mahasiswa'"));

        if ($cek > 0) {
?>

<script language="JavaScript">
alert('NIM sudah dipakai!, silahkan ganti NIM yang lain');
document.location='download-script-form-input-data.php';
</script>

<?php

        }

        else {

            //Masukan data ke Table
            $nama = mysqli_real_escape_string($Open, $nama);
            $jurusan = mysqli_real_escape_string($Open, $jurusan);
            $alamat = mysqli_real_escape_string($Open, $alamat);
            $telepon = mysqli_real_escape_string($Open, $telepon);

            $input = "INSERT INTO mahasiswa
            (id_mahasiswa,nama,jurusan,alamat,telepon)
            VALUES
            ('$id_mahasiswa','$nama','$jurusan','$alamat','$telepon')";

            $query_input = mysqli_query($Open, $input);

            if ($query_input) {

                //Jika Sukses
?>

<script language="JavaScript">
alert('Input Data Mahasiswa Berhasil');
document.location='download-script-form-input-data.php';
</script>

<?php

            }

            else {

                //Jika Gagal
                echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
                echo "<br>";
                echo mysqli_error($Open);

            }

        }

        //Tutup koneksi engine MySQL
        mysqli_close($Open);

    }

}

else {

    header("Location: download-script-form-input-data.php");
    exit();

}

?>
