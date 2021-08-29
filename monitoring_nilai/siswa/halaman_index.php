<?php include 'siswa_header.php'; ?>
<?php include 'siswa_sidebar.php'; ?>

<script>
	var tableContextMenu = null;

	$(document).ready(function() {
		tableContextMenu = new ContextMenu("context-menu-items", menuItemClickListener);

		document.getElementById('SearchBox').onkeypress = function searchKeyPress(event) {
			var pencarian = $("#SearchBox").val();
			if (event.keyCode == 13) {
				if (pencarian) {
					location.href = ("halaman_index.php?pencarian=" + pencarian);
				} else {
					location.href = ("halaman_index.php");
				}
			}
		};
	});

	function search() {
		var pencarian = $("#SearchBox").val();
		if (pencarian) {
			location.href = ("halaman_index.php?pencarian=" + pencarian);
		} else {
			location.href = ("halaman_index.php");
		}
	}
</script>

<div class="content">
	<div class="card mt-3">
		<div class="card-header">
			<h3 class="card-title" style="font-weight: bold;font-size:larger;">Lihat Nilai</h3>
		</div>

		<div class="card-body">
			<?php
			if (isset($_GET['pesan'])) {
				if ($_GET['pesan'] == 'berhasil') {
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Data berhasil dihapus!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
				} else if ($_GET['pesan'] == 'gagal') {
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Data gagal dihapus!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>';
				}
			}
			?>

			<div class="Search row" style="margin-bottom: 10px;">
				<div class="container">
					<input type="text" class="float-left" placeholder="Search" id="SearchBox" name="SearchBox" style="width: 35%" autofocus>
					<input type="button" class="float-left" id="SearchButton" name="SearchButton" value="search" onclick="search()" style="margin-left: 10px;">
				</div>
			</div>

			<!-- Table Data -->
			<table class="table table-bordered table-hover" id="table-master">
				<thead class="text-center table-primary">
					<tr>
						<th>#</th>
						<th class="w-30">Materi</th>
						<th class="w-40">Guru</th>
						<th class="w-30">Nilai</th>
					</tr>
				</thead>

				<tbody>
					<?php
					include '../koneksi.php';
					if (!empty($_GET['pencarian'])) {
						$pencarian = filter_input(INPUT_GET, 'pencarian', FILTER_SANITIZE_ADD_SLASHES);
						$SqlQuery = "SELECT u2.name AS nama_guru, ns.nilai, mp.nama_materi FROM nilai_siswa AS ns 
						LEFT JOIN user AS u ON ns.id_user = u.id 
						LEFT JOIN materi_pembelajaran AS mp ON ns.id_materi = mp.id
                        LEFT JOIN user AS u2 ON mp.id_guru = u2.id
						WHERE mp.nama_materi LIKE '%" . $pencarian . "%' 
						AND u.id = " . $_SESSION['id'] . "";
					} else {
						$SqlQuery = "SELECT u2.name AS nama_guru, ns.nilai, mp.nama_materi FROM nilai_siswa AS ns 
						LEFT JOIN user AS u ON ns.id_user = u.id 
						LEFT JOIN materi_pembelajaran AS mp ON ns.id_materi = mp.id
                        LEFT JOIN user AS u2 ON mp.id_guru = u2.id
						WHERE u.id = " . $_SESSION['id'] . "";
					}

					$data = mysqli_query($koneksi, $SqlQuery);
					$totalData = mysqli_num_rows($data); //4
					$halaman = 10;
					$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
					$pages = ceil($totalData / $halaman);
					$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
					$no = $mulai + 1;
					$dataPagination = mysqli_query($koneksi, $SqlQuery . " LIMIT $mulai, $halaman");

					// Data per baris
					while ($d = mysqli_fetch_assoc($dataPagination)) {
					?>
						<tr>
							<td><?= $no++; ?></td>
							<td><?= $d['nama_materi']; ?></td>
							<td><?= $d['nama_guru']; ?></td>
							<td><?= $d['nilai']; ?></td>
						</tr>
					<?php } ?>

				</tbody>
			</table>

			<!-- Tombol pada Bottom Right -->
			<div class="container">
				<div class="float-right">
					<p class="float-left" style="font-weight: bold; margin-right: 50px;">Row per page: <?php echo $halaman ?></p>

					<p class="float-left" style="font-weight:lighter; margin-right: 50px;">
						<?php echo $page ?> - <?php echo $pages ?>
						of <?php echo $totalData ?>
					</p>

					<a href=<?php
							if ($page > 1) {
								echo "halaman_index.php?halaman=" . ($page - 1);
							} else {
								echo "halaman_index.php?halaman=1";
							}
							?> style=" color: black; margin-right: 5px;"><i class="fa fa-angle-left" aria-hidden="true"></i></a>

					<?php for ($i = 1; $i <= $pages; $i++) {
						if ($i == $page) { ?>
							<a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: black"><?php echo $i; ?></a>
						<?php } else { ?>
							<a href="?halaman=<?php echo $i; ?>" style="font-weight: lighter; color: rgba(0, 0, 0, 0.7)"><?php echo $i; ?></a>
					<?php }
					} ?>

					<a href=<?php
							if ($page < $pages) {
								echo "halaman_index.php?halaman=" . ($page + 1);
							} else {
								echo "halaman_index.php?halaman=" . $pages;
							}
							?> style="color: black; margin-left: 5px;"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
				</div>
			</div>

		</div>
	</div>
</div>
<?php include 'siswa_footer.php'; ?>