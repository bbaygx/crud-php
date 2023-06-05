<?php
    session_start();
    require 'conn.php';

    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit();
    }
    
    // Proses Hapus Siswa
    if (isset($_GET['hapus'])) {
        $id = $_GET['hapus'];

        echo $id;
        $query = "DELETE FROM siswa WHERE id = $id";
        mysqli_query($koneksi, $query);
    }

    // Ambil Data Siswa
    $query = "SELECT * FROM siswa";
    $result = mysqli_query($koneksi, $query);
        

    // Ambil username admin dari session
    $admin = $_SESSION['admin'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Pendaftaran Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Siswa</h1>
       <a href="tambah.php" class="btn btn-sm btn-primary">Tambah +</a>
       <a href="logout.php" class="btn btn-danger">Logout</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?=$no++; ?></td>
                        <td><?=$row['nama']; ?></td>
                        <td><?=$row['alamat']; ?></td>
                        <td><?=$row['no_telepon']; ?></td>
                        <td><?=$row['jenis_kelamin']; ?></td>
                        <td><?=$row['tanggal_lahir']; ?></td>
                        <td>
                            <a href="edit.php?id=<?=$row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="index.php?hapus=<?=$row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus siswa ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                 }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
