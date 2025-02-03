<?php 
include'header.php'; ?>

<head>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>
</head>

    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            	<h3 class="box-title">Jadwal Event</h3>
            </div>
            <div class="box-body no-padding">
          		<div class="table-responsive">
              		<table class="table table-striped">
					<tr>
					<th>Bulan</th>
					<th>Nama Kegiatan</th>
					<th>Detail</th>
					<th width="5%" colspan="2">Action</th>
					</tr>
                	<?php
                      	$qry = mysqli_query($konek,"SELECT * FROM tbl_jadwal WHERE kode='EVE'");
                        while ($data=mysqli_fetch_array($qry)) {
                  	?>
                	<tr>
					<td><?php echo $data['bulan']; ?></td>
					<td><?php echo $data['nama']; ?></td>
					<td><?php echo $data['keterangan']; ?></td>
						<td> <a href="project_edit.php?id=<?php echo base64_encode($data['bulan']); ?>" class="fa fa-edit"></td>
						<td> 
							<a href="project_bersih.php?id=<?php echo $data['bulan']; ?>" 
							class="fa fa-times"
							onclick="return confirm('Apakah Anda yakin ingin membersihkan data ini?')">
							</a>
						</td>
                	</tr>
                	<?php } ?>
              		</table>
				</div>
            </div>
        </div>
    </div>

	<div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
            	<h3 class="box-title">Jadwal Latihan</h3>
            </div>
            <div class="box-body no-padding">
          		<div class="table-responsive">
              		<table class="table table-striped">
					<tr>
					<th>Hari</th>
					<th>Nama Kegiatan</th>
					<th>Detail</th>
					<th width="5%" colspan="2">Action</th>
					</tr>
                	<?php
                      	$qry = mysqli_query($konek,"SELECT * FROM tbl_jadwal WHERE kode='LAT'");
                        while ($data=mysqli_fetch_array($qry)) {
                  	?>
                	<tr>
						<td><?php echo $data['bulan']; ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['keterangan']; ?></td>
						<td> <a href="project_edit.php?id=<?php echo base64_encode($data['bulan']); ?>" class="fa fa-edit"></td>
						<td> 
							<a href="project_bersih.php?id=<?php echo $data['bulan']; ?>" 
							class="fa fa-times"
							onclick="return confirm('Apakah Anda yakin ingin membersihkan data ini?')">
							</a>
						</td>
					</tr>
                	<?php } ?>
              		</table>
				</div>
            </div>
        </div>
    </div>

<?php include'footer.php'; ?>