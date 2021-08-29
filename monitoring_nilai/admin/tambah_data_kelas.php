<?php include 'admin_header.php'; ?>
<?php include 'admin_sidebar.php'; ?>

<?php
include '../koneksi.php';
?>

<div class="content">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold;font-size:larger;">Tambah Data Kelas</h3>
        </div>
        <form action="tambah_data_kelas_act.php" method="post">

            <div class="card-body">
                <?php
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == 'berhasil') {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data berhasil ditambahkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    } else if ($_GET['pesan'] == 'gagal') {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Data gagal ditambahkan!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
                    }
                }
                ?>

                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="data"><b>Nama Mahasiswa</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <select name="data_siswa" id="data_siswa" class="form-control">
                                            <option value="0">Pilih Siswa</option>
                                            <?php
                                            $data = mysqli_query($koneksi, "SELECT id, name FROM user WHERE level = 'siswa'");
                                            while ($d = mysqli_fetch_array($data)) { ?>
                                                <option value="<?= $d['id'] ?>"> <?= ucfirst($d['name']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data"><b>Nama Guru</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <select name="data_guru" id="data_guru" class="form-control">
                                            <option value="0">Pilih Guru</option>
                                            <?php
                                            $data = mysqli_query($koneksi, "SELECT id, name FROM user WHERE level = 'guru'");
                                            while ($d = mysqli_fetch_array($data)) { ?>
                                                <option value="<?= $d['id'] ?>"> <?= ucfirst($d['name']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div style="display: float; margin-top:30px">
                                <button type="submit" class="btn btn-primary submit-master float-right">Submit</button>
                            </div>
                        </div>
                    </div>
        </form>
    </div>
</div>

<?php include 'admin_footer.php'; ?>