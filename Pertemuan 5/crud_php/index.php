<?php
include 'database.php';
$db = new Database;
// var_dump($db);
// $db->tampilData();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD OOP PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>OOP PHP CRUD</h1>
        <hr>

        <a href="input.php" class="btn btn-success">Tambah Data</a>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                foreach ($db->tampilData() as $dataUser) {

                    ?>
                    <tr>
                        <th scope="row"><?php echo $nomor++ ?></th>
                        <td><?php echo $dataUser['nama']; ?></td>
                        <td><?php echo $dataUser['alamat']; ?></td>
                        <td><?php echo $dataUser['nohp']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $dataUser['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="proses.php?id=<?php echo $dataUser['id'] ?>&aksi=hapus" class="btn btn-danger btn-sm">Hapus</a>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>