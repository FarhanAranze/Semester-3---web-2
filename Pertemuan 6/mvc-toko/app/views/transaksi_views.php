<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Ambacomputer</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=index">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php?page=produk">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=pelanggan  ">Pelanggan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=transaksi">Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <br>

        <h2>Transaksi Views</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID Barang</th>
                    <th scope="col">ID Pelanggan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($data as $d => $tr) {
                ?>
                <tr>
                    <th scope="row"><?= $d+1 ?></th>
                    <td><?= $tr['kode_barang']; ?></td>
                    <td><?= $tr['id_pelanggan']; ?></td>
                    <td><?= $tr['total_harga']; ?></td>
                    <td><?= $tr['tanggal']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
