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
        <form action="tambah_materi_act.php" method="post">

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
                            <label for="data"><b>Nama Materi</b></label>
                            <div class="row">
                                <div class="container">
                                    <div class="float-left" style="width: 100%;">
                                        <input type="text" name="data_materi" id="data_materi" class="form-control" placeholder="Masukkan nama materi..." style="width: 100%;" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" name="data_guru" id="data_guru" class="form-control" value="<?= $_SESSION['id'] ?>" hidden>
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