<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">    
                    <div class="form-group">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Harga Jual</label>
                        <input type="number" class="form-control" name="hrg_jual" required>
                    </div>
                    <button name="save" type="submit" class="btn btn-primary">Simpan</button>
                </form>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php 
require_once 'dbcon.php';

if (isset($_POST['save'])) {

    $nama = $_POST['nama'];
    $stok = $_POST['stok'];
    $hrg_jual = $_POST['hrg_jual'];
    $query1 = $conn->query("SELECT COUNT(*) as jml FROM barang where nm_barang='$nama'");
    $row1 = $query1->fetch_array();
    if($row1['jml']==0){
        $conn->query("INSERT INTO barang VALUES (NULL, '$nama', '$stok', '$hrg_jual', CURRENT_TIMESTAMP);");
        echo "<script>window.location.href='barang.php';</script>";
    }else{
        echo "<script>alert('Nama Barang Sudah Ada');</script>";
        echo "<script>window.location.href='barang.php';</script>";
    }

    }
?>
