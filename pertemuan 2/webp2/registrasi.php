<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Registrasi</title>
</head>

<body>
    <?php
    $kembali = "<a href ='formRegistrasi.php'>Kembali</a>";
    if ($_POST['nama'] == "" || $_POST['email'] == "" || $_POST['alamat'] == "") {
        if ($_POST['nama'] == "") {
            echo "Maaf, nama harus diisi" . "<br>";
        }
        if ($_POST['email'] == "") {
            echo "Maaf, email harus diisi" . "<br>";
        }
        if ($_POST['alamat'] == "") {
            echo "Maaf, alamat harus diisi" . "<br>";
        }
        echo $kembali;
    } else {
    ?>

        <h2>Registrasi Berhasil</h2>
        <table border="1">
            <tr>
                <td>Nama</td>
                <td><?php echo $_POST['nama'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $_POST['email'] ?></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td><?php echo $_POST['jenis_kelamin'] ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><?php echo $_POST['alamat'] ?></td>
            </tr>
            <tr>
                <td></td>
                <td><a href="formRegistrasi.php">Kembali</a></td>
            </tr>A
        </table>
    <?php
    }
    ?>
</body>

</html>