<?php include 'guru_header.php'; ?>
<?php include 'guru_sidebar.php'; ?>

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/context-menu.js"></script>

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

	function menuItemClickListener(menu_item, parent) {
		if (menu_item.text() == "Edit") {
			location.href = ("edit_nilai.php?id=" + parent.attr("value"));
			// alert("Menu Item Clicked: " + menu_item.text() + "\nRecord ID: " + parent.attr("value"));
		} else {
			var check = confirm("Warning! Are you sure want to delete keyword with id " + parent.attr("value") + "?");
			if (check == true) {
				location.href = ("delete_nilai_act.php?id=" + parent.attr("value"));
			} else {
				return false;
			}
		}
	}

	function search() {
		var pencarian = $("#SearchBox").val();
		if (pencarian) {
			location.href = ("halaman_index.php?pencarian=" + pencarian);
		} else {
			location.href = ("halaman_index.php");
		}
	}
</script>

<style>
	.context-menu-container {
		background-color: white;
		z-index: 1000 !important;
		border-radius: 5px;
		position: absolute;
		display: none;
		border: solid thin black;
		padding: 3px;
		-webkit-box-shadow: 4px 4px 8px 0px rgba(0, 0, 0, 0.18);
		-moz-box-shadow: 4px 4px 8px 0px rgba(0, 0, 0, 0.18);
		box-shadow: 4px 4px 8px 0px rgba(0, 0, 0, 0.18);
		min-width: 90px;
	}

	.context-menu-container>ul {
		margin: 0;
		padding: 0;
		list-style-type: none;
	}

	.context-menu-container>ul>li {
		padding: 5px;
		cursor: hand;
		cursor: pointer;
		border-radius: 5px;
	}

	.context-menu-container>ul>li.danger {
		color: red;
	}

	.context-menu-container>ul>li.disabled {
		color: #b7b7b7;
	}

	.context-menu-container>ul>li.disabled:hover {
		background-color: white;
	}

	.context-menu-container>ul>li:hover {
		background-color: #c4c4c4;
	}

	.context-menu-container>ul>li.danger:hover {
		color: white;
		background-color: red;
	}

	.context-menu-container>ul>li.warning:hover {
		background-color: #fff27c;
	}

	.context-menu-container>ul>li.danger.disabled:hover,
	.context-menu-container>ul>li.warning.disabled:hover {
		background-color: white;
	}
</style>

<div class="context-menu-container" id="context-menu-items">
	<ul>
		<li data-toggle="modal" data-target="#inputModal">Edit</li>
		<li class="danger">Delete</li>
	</ul>
</div>

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
						<th class="w-35">Nama Murid</th>
						<th class="w-30">Materi</th>
						<th class="w-35">Nilai</th>
					</tr>
				</thead>

				<tbody>
					<?php
					include '../koneksi.php';
					if (!empty($_GET['pencarian'])) {
						$pencarian = filter_input(INPUT_GET, 'pencarian', FILTER_SANITIZE_ADD_SLASHES);
						$SqlQuery = "SELECT ns.id, u.name, ns.nilai, mp.nama_materi FROM nilai_siswa AS ns 
						LEFT JOIN user AS u ON ns.id_user = u.id 
						LEFT JOIN materi_pembelajaran AS mp ON ns.id_materi = mp.id
                        LEFT JOIN user AS u2 ON mp.id_guru = u2.id
						WHERE u.name LIKE '%" . $pencarian . "%'";
					} else {
						$SqlQuery = "SELECT ns.id, u.name, ns.nilai, mp.nama_materi FROM nilai_siswa AS ns 
						LEFT JOIN user AS u ON ns.id_user = u.id 
						LEFT JOIN materi_pembelajaran AS mp ON ns.id_materi = mp.id
                        LEFT JOIN user AS u2 ON mp.id_guru = u2.id
						WHERE u2.id = " . $_SESSION['id'] . "";
					}

					// Pagination
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
							<td><?= $d['name']; ?></td>
							<td><?= $d['nama_materi']; ?></td>
							<td>
								<div class="container" style="display: float;">
									<div class="row">
										<div class="col-md-11" id="uplink">
											<p class="float-left"><?php echo $d['nilai'] ?></p>
										</div>
										<div class="col" id="3-dot-menu">
											<p class="context-menu float-right" data-container-id="context-menu-items" name="uplink" value="<?php echo $d["id"] ?>" location="<?php echo $page ?>" style=" margin-top: -25px; font-weight:bold; cursor: pointer; cursor: hand;">&#10247;</p>
										</div>
									</div>
								</div>
							</td>
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
<?php include 'guru_footer.php'; ?>