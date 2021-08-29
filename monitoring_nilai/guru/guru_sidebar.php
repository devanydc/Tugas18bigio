<style>
    body {
        position: relative;
        height: 100%;
        width: 100%;
        font-family: "Lato", sans-serif;
    }

    .sidebar {
        margin: 0;
        padding: 0;
        width: 250px;
        background-color: #f1f1f1;
        position: absolute;
        height: 100%;
        display: inline-block;
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #04AA6D;
        color: white;
    }

    .sidebar a:hover {
        background-color: #555;
        color: white;
    }

    div.content {
        margin-left: 250px;
        padding: 1px 16px;
    }

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
</style>


<div class="sidebar">
    <div class="user-panel mt-3 mb-3 ml-4">
        <div class="row">
            <div class="admin-image">
                <img src="../assets/images/img_avatar.png" class="img-circle" alt="User Image" style="height: 65px; width: 65px; border-radius: 50%;">

            </div>
            <div class="ml-3">
                <div class="admin-info mt-1">
                    <span href="#" style="font-size:22px; font-weight:bold;"><?= ucfirst($_SESSION['name']); ?></span>
                </div>
                <div>
                    <span href="#" style="font-size:16px;"><?= ucfirst($_SESSION['level']); ?></a>
                </div>
            </div>
        </div>
    </div>
    <a href="halaman_index.php" class="list-group-item list-group-item-action d-flex justify-content-start align-items-center">
        <i class="fas fa-fw fa-comments mr-3"></i> Lihat Nilai
    </a>
    <a href="tambah_nilai.php" class="list-group-item list-group-item-action d-flex justify-content-start align-items-center">
        <i class="fas fa-fw fa-plus mr-3"></i> Tambah Nilai
    </a>
    <a href="tambah_materi.php" class="list-group-item list-group-item-action d-flex justify-content-start align-items-center">
        <i class="fas fa-fw fa-plus mr-3"></i> Tambah Materi
    </a>
    <a href="../logout.php" class="list-group-item list-group-item-action d-flex justify-content-start align-items-center table-danger text-white">
        <i class="fas fa-fw fa-sign-out-alt mr-3"></i> Logout
    </a>
</div>