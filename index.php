<?php
	include('config.php');
?>
	
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	 <script src="js/bootstrap.bundle.min.js"></script>

	 <!-- Font Awesome -->
	 <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

	<title>Crud Barang</title>
</head>
<body>
	<nav class="navbar navbar-light bg-light">
  		<div class="container-fluid">
    		<a class="navbar-brand" href="#">CRUD</a>
  		</div>
	</nav>
	<!-- Judul -->
	<div class="container mt-3">
		<h3 class="mt-4"> CRUD BARANG </h3>
	
		<div class="card mt-2 t-2">
      <div class="card-header">
        <button type="button" class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#tambahbarang">
          <i class="fa fa-plus"></i>
          <span>Tambah Barang</span>
        </button>
      </div>

      <div class="card-body">
        <!-- Table with stripped rows -->
        <table class="table datatable table table-striped text-center">
          <thead>
            <tr>
              <th>No</th>
              <th>Gambar</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Harga</th>
              <th>Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $query = mysqli_query($config, "SELECT * FROM `tb_barang`");
              $no = 1;
              while($row = mysqli_fetch_assoc($query)){
                if ($row['gambar'] == null) $img = 'No Photo';
                else $img = '<img/ src="img/' . $row['gambar'] . '" width="65px" class="zoomable">';
              $id = $row['id_barang'];
              $namabarang = $row['nama_barang'];
              $jbarang = $row['jenis_barang'];
              $hbarang = $row['harga'];
              $keterangan = $row['keterangan'];
            ?>
            <tr>
              <td><?php echo $no ++ ?></td>
              <td><?php echo $img ?></td>
              <td><?php echo $namabarang ?></td>
              <td><?php echo $jbarang ?></td>
              <td><?php echo $hbarang ?></td>
              <td><?php echo $keterangan ?></td>
              <td>
                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editbarang<?php echo $no ?>">
                  <i class="fa fa-pencil"></i></a>
                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusbarang<?php echo $no ?>">
                  <i class="fa fa-trash"></i></a>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editbarang<?php echo $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel<?php echo $idjadwal ?>" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                  <form action="aksi-crud.php" enctype="multipart/form-data" method="POST" id="form1">
                    <input type="hidden" name="id_barang" value="<?php echo $id ?>" class="form-control">
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Gambar</label>
                      <div class="col-sm-10">
                        <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Nama Barang</label>
                      <div class="col-sm-10">
                        <input type="text" name="nama_barang" class="form-control" value="<?php echo $namabarang ?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Jenis Barang</label>
                      <div class="col-sm-10">
                        <select class="form-select" name="jenis_barang">
                          <option <?php if($jbarang == 'Grosir'){ echo "selected";} ?> value="Grosir">Grosir</option>
                          <option <?php if($jbarang == 'Eceran'){ echo "selected";} ?> value="Satuan">Satuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                      <div class="col-sm-10">
                      <input type="text" name="harga" class="form-control" value="<?php echo $hbarang ?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
                      <div class="col-sm-10">
                      <textarea class="form-control" name="keterangan" style="height: 100px"><?php echo $keterangan ?></textarea>
                      </div>
                    </div>
                    <div class="text-center">
                      <input type="submit" class="btn btn-primary" name="btnedit" value="EDIT">
                      <button type="reset" class="btn btn-secondary">RESET</button>
                    </div>
                  </form>
                  </div>
              </div>
            </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="hapusbarang<?php echo $no ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form action="aksi-crud.php" method="GET" id="form1">
                      <h5 class="text-center">Apakah anda yakin menghapus data ini? <br>
                      <span class="text-danger"><?php echo $namabarang ?></span>
                      </h5>
                      <div class="text-center">
                        <input type="hidden" value="<?php echo $id ?>" name="id_barang">
                        <input type="submit" class="btn btn-danger" name="btnhapus" value="HAPUS">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                      </div>
                    </form>
                  </div>
              </div>
            </div>

            <?php } ?>
          </tbody>
        </table>
        <!-- End Table with stripped rows -->
      </div>
    </div>

	</div>
</body>
	
	<!-- Modal Tambah -->
	<div class="modal fade" id="tambahbarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<form action="aksi-crud.php" enctype="multipart/form-data" method="POST" id="form1">
			<div class="row mb-3">
				<label for="inputText" class="col-sm-2 col-form-label">Gambar</label>
				<div class="col-sm-10">
				<input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
				</div>
			</div>
			<div class="row mb-3">
				<label for="inputText" class="col-sm-2 col-form-label">Nama Barang</label>
				<div class="col-sm-10">
				<input required type="text" name="nama_barang" class="form-control">
				</div>
			</div>
      <div class="row mb-3">
        <label class="col-sm-2 col-form-label">Jenis Barang</label>
        <div class="col-sm-10">
          <select class="form-select" name="jenis_barang">
            <option value="Grosir">Grosir</option>
            <option value="Satuan">Satuan</option>
          </select>
        </div>
      </div>
      <div class="row mb-3">
				<label for="inputText" class="col-sm-2 col-form-label">Harga</label>
				<div class="col-sm-10">
				<input required type="text" name="harga" class="form-control">
				</div>
			</div>
			<div class="row mb-3">
				<label for="inputText" class="col-sm-2 col-form-label">Keterangan</label>
				<div class="col-sm-10">
				<textarea required class="form-control" name="keterangan" style="height: 100px"></textarea>
				</div>
			</div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" name="btntambah" value="TAMBAH">
				<button type="reset" class="btn btn-secondary">RESET</button>
			</div>
			</form>
		</div>
	</div>
	</div>
</html>