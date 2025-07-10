<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
    <!-- Navigation -->
    <?php include ('side_bar.php');?>

  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title">Data User</h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="bi bi-plus-lg"></i> Tambah</button>
                <?php include ('add_user_modal.php');?>
                <hr>
                
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
											require 'dbcon.php';
											$bool = false;
                      $no=1; $id=$_SESSION['ID'];
                      $query = $conn->query("SELECT * FROM user order by id_user DESC");
                      while($row = $query->fetch_array()){
                        $id_user=$row['id_user'];
										?>
                  <tr>
                    <th scope="row"><?php echo $no; $no++;?></th>
                    <td><img src="upload/<?php echo $row['foto'];?>" width="100px"></td>
                    <td><?php echo $row['nama'];?></td>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['role'];?></td>
                    <td style="text-align:center">
                      <a rel="tooltip"  title="Edit" id="<?php echo $row['id_user'] ?>" href="#edit_user<?php echo $row['id_user'];?>"  data-toggle="modal"class="btn btn-success btn-outline"><i class="bi bi-pencil-square"></i> </a>
                      <a rel="tooltip"  title="Delete" id="<?php echo $row['id_user'] ?>" href="#delete_user<?php echo $row['id_user'];?>"  data-toggle="modal"class="btn btn-danger btn-outline"><i class="bi bi-trash-fill"></i> </a>		
										</td>
                        <?php 
                        require 'edit_user_modal.php';require 'delete_user_modal.php';
												?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include ('footer.php');?>
      <?php include ('script.php');?>

</body>

</html>