<?php include 'admin_header.php'; ?>
<?php include 'admin_sidebar.php'; ?>

<?php
include '../koneksi.php';
?>

<div class="content">
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title" style="font-weight: bold;font-size:larger;">Edit Data</h3>
        </div>
        <form action="edit_pengguna_act.php" method="post">

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
                    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
                    while ($d = mysqli_fetch_array($data)) {
                ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="data"><b>Nama pengguna</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <input type="text" name="data_name" id="data_name" class="form-control" value="<?php echo $d['name'] ?>" style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="data"><b>Username pengguna</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <input type="text" name="data_username" id="data_username" class="form-control" value="<?php echo $d['username'] ?>" style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="data"><b>Password Pengguna</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <input type="text" name="data_password" id="data_password" class="form-control" value="<?php echo $d['password'] ?>" style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="data"><b>Level Pengguna</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <select name="data_level" id="data_level" class="form-control">
                                                    <option value="<?php echo $d['level'] ?>"><?php echo ucfirst($d['level']) ?> (saat ini)</option>
                                                    <?php
                                                    $datalevel = mysqli_query($koneksi, "SELECT DISTINCT level FROM user WHERE level != 'admin'");
                                                    while ($level = mysqli_fetch_array($datalevel)) { ?>
                                                        <option value="<?= $level['level'] ?>"> <?= ucfirst($level['level']) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="data"><b>Guru pengguna</b></label>
                                    <div class="row">
                                        <div class="container">
                                            <div class="float-left" style="width: 100%;">
                                                <select name="data_guru" id="data_guru" class="form-control">
                                                    <?php
                                                    $dataguru = mysqli_query($koneksi, "SELECT * FROM user WHERE `level` = 'guru' AND `id` = " . $d['uplink'] . "");
                                                    while ($guru = mysqli_fetch_array($dataguru)) { ?>
                                                        <option value="<?= $guru['id'] ?>"><?= ucfirst($guru['name']) ?> - (Saat ini)</option>
                                                    <?php } ?>

                                                    <?php
                                                    $dataguru = mysqli_query($koneksi, "SELECT * FROM user WHERE `level` = 'guru'");
                                                    while ($guru = mysqli_fetch_array($dataguru)) { ?>
                                                        <option value="<?= $guru['id'] ?>"> <?= ucfirst($guru['name']) ?></option>
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
<?php }
                } ?>
    </div>
</div>

<?php include 'admin_footer.php'; ?>