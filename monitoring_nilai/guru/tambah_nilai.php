<?php include 'guru_header.php'; ?>
<?php include 'guru_sidebar.php'; ?>

<?php
include '../koneksi.php';
?>

<div class="content">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold;font-size:larger;">Tambah Materi</h3>
        </div>
        <form action="tambah_nilai_act.php" method="post">

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
                            <label for="data"><b>Nama Siswa</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <select name="data_id_siswa" id="data_id_siswa" class="form-control">
                                            <option value="0">Pilih Siswa</option>
                                            <?php
                                            $datasiswa = mysqli_query($koneksi, "SELECT * FROM group_kelas AS gk
                                                LEFT JOIN user AS u ON gk.id_siswa = u.id
                                                WHERE gk.id_guru = " . $_SESSION['id'] . "");
                                            while ($siswa = mysqli_fetch_array($datasiswa)) { ?>
                                                <option value="<?= $siswa['id'] ?>"> <?= ucfirst($siswa['name']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data"><b>Materi Pelajaran</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <select name="data_id_materi" id="data_id_materi" class="form-control">
                                            <option value="0">Pilih materi</option>
                                            <?php
                                            $datamateri = mysqli_query($koneksi, "SELECT DISTINCT id, nama_materi FROM materi_pembelajaran WHERE id_guru = " . $_SESSION['id'] . "");
                                            while ($materi = mysqli_fetch_array($datamateri)) { ?>
                                                <option value="<?= $materi['id'] ?>"> <?= ucfirst($materi['nama_materi']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="data"><b>Nilai</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <input type="text" name="data_nilai" id="data_nilai" class="form-control" placeholder="Masukkan nilai siswa..." style="width: 100%;" required>
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

<?php include 'guru_footer.php'; ?>