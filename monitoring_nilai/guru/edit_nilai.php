<?php include 'guru_header.php'; ?>
<?php include 'guru_sidebar.php'; ?>

<?php
include '../koneksi.php';
?>

<div class="content">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold;font-size:larger;">Edit Nilai</h3>
        </div>
        <form action="edit_nilai_act.php" method="post">

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

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT ns.id AS id_nilai, u.name, ns.nilai, ns.id_materi, mp.nama_materi FROM nilai_siswa AS ns 
                    LEFT JOIN user AS u ON ns.id_user = u.id 
                    LEFT JOIN materi_pembelajaran AS mp ON ns.id_materi = mp.id
                    WHERE ns.id = " . $_GET['id'] . "");
                    while ($d = mysqli_fetch_array($data)) {
                ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="data"><b>Nama Murid</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <input type="text" name="data_name" id="data_name" class="form-control" value="<?php echo $d['name'] ?>" style="width: 100%;" disabled>
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
                                                    <option value="<?php echo $d['id_materi'] ?>"><?php echo ucfirst($d['nama_materi']) ?> (saat ini)</option>
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
                                                <input type="text" name="data_nilai" id="data_nilai" class="form-control" value="<?php echo $d['nilai'] ?>" style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="data_id_nilai" id="data_id_nilai" class="form-control" value="<?php echo $_GET['id'] ?>" hidden>
                                </div>

                                <div class="col-md-12">
                                    <div style="display: float; margin-top:30px">
                                        <button type="submit" class="btn btn-primary submit-master float-right">Submit</button>
                                    </div>
                                </div>
                            </div>
        </form>
<?php }
                } ?>
    </div>
</div>

<?php include 'guru_footer.php'; ?>