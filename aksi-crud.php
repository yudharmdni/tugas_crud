<?php
    include('config.php');

//tambah barang
if(isset($_POST['btntambah'])) {

    $image = $_FILES['gambar']['name'];
    
    $dir = "img/";
    $tmpfile = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmpfile, $dir.$image);

    $nbarang = $_POST['nama_barang'];
    $jbarang = $_POST['jenis_barang'];
    $hbarang = $_POST['harga'];
    $ket = $_POST['keterangan'];

        $query = "INSERT INTO tb_barang VALUES(null, '$image', '$nbarang', '$jbarang', '$hbarang', '$ket')";
        $tmbah = mysqli_query($config, $query);

    if($query) echo "<script>alert('Tambah Data Berhasil!');window.location='index.php'</script>";
}

//edit barang
if (isset($_POST['btnedit'])) {

    $id = $_POST['id_barang'];
    $nbarang = $_POST['nama_barang'];
    $jbarang = $_POST['jenis_barang'];
    $hbarang = $_POST['harga'];
    $ket = $_POST['keterangan'];

    $showimg = "SELECT * FROM tb_barang WHERE id_barang = '$id'";
    $sqlshow = mysqli_query($config, $showimg);
    $row = mysqli_fetch_assoc($sqlshow);

    if ($_FILES['gambar']['name'] == ''){
        $image = $row['gambar'];
    } else {
        $image = $_FILES['gambar']['name'];
        unlink("img/".$row['gambar']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], 'img/'.$_FILES['gambar']['name']);
    }
    
    $query = "UPDATE tb_barang SET gambar='$image', nama_barang='$nbarang', jenis_barang='$jbarang', harga='$hbarang', keterangan='$ket' WHERE id_barang='$id'";
    $edit = mysqli_query($config, $query);

    if($query) echo "<script>alert('Edit Data Berhasil!');window.location='index.php'</script>";
}

//hapus barang
if (isset($_GET['btnhapus'])) {
    $id = $_GET['id_barang'];

    $showimg = "SELECT * FROM tb_barang WHERE id_barang = '$id'";
    $sqlshow = mysqli_query($config, $showimg);
    $row = mysqli_fetch_assoc($sqlshow);

    unlink("img/".$row['gambar']);

    $hapus = mysqli_query($config, "DELETE FROM tb_barang WHERE id_barang='$id'");

    if($hapus) echo "<script>alert('Hapus Data Berhasil!');window.location='index.php'</script>";

}
?>