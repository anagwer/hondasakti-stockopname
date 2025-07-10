<?php include ('session.php');?>
<?php include ('head.php');?>


<body>
    <!-- Navigation -->
    <?php include ('side_bar.php');?>

  <main id="main" class="main">
    <section class="section profile">
      <div class="row">
        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <?php 
                    require 'dbcon.php';
                    $id=$_SESSION['ID'];
                    $query = $conn->query("SELECT * FROM user WHERE id_user='$id'");
                    $row = $query->fetch_array();
                    ?>
                  <!-- Profile Edit Form -->
                  <form method = "post" enctype = "multipart/form-data">
                  <input name="id_user" type="hidden" class="form-control" id="id_user" value="<?php echo $row['id_user'];?>">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="upload/<?php echo $row['foto'];?>" alt="Profile">
                        <div class="pt-2">
                        <input type="file" name="image"  class="form-control" value="<?php echo $row['foto'];?>"/>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                      <div class="col-md-8 ">
                        <input name="nama" type="text" class="form-control" id="nama" value="<?php echo $row['nama'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="username" type="text" class="form-control" id="username" value="<?php echo $row['username'];?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password" value="<?php echo $row['password'];?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name = "update" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php 
		require 'dbcon.php';
		
		if(ISSET($_POST['update'])){
			$id_user=$_POST['id_user'];
			$nama=$_POST['nama'];
			$username=$_POST['username'];
			$password=$_POST['password'];
			$password1=md5($_POST['password']);
            $query1 = $conn->query("SELECT * FROM user WHERE id_user='$id_user'");
            $row1 = $query1->fetch_array();

            $file=$_FILES['image']['name'];
            if (empty($file)){
                //jika password sama
                if ($password==$row1['password']){
                    $conn->query("UPDATE user SET nama = '$nama',username = '$username' WHERE id_user = '$id_user'")or die(mysql_error());
                    echo "<script> window.location='profil.php' </script>";
                }else{
                    $conn->query("UPDATE user SET nama = '$nama',username = '$username',password = '$password1' WHERE id_user = '$id_user'")or die(mysql_error());
                    echo "<script> window.location='profil.php' </script>";
                }
            }else{
                if (in_array($_FILES['image']['type'], ['image/jpeg', 'image/jpg', 'image/webp', 'image/png'])) {
                    $image_name = addslashes($_FILES['image']['name']);
                    $image_size = $_FILES['image']['size'];
                    
                    // Pastikan direktori upload ada dan sudah dibuat sebelumnya
                    $upload_dir = "upload/"; // Ubah sesuai dengan direktori penyimpanan Anda
                    $target_file = $upload_dir . basename($image_name);
                    
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $image_location = $image_name;
                        //jika password sama
                        if ($password==$row1['password']){
                            $conn->query("UPDATE user SET nama = '$nama',username = '$username',foto = '$image_location' WHERE id_user = '$id_user'")or die(mysql_error());
                            echo "<script> window.location='profil.php' </script>";
                        }else{
                            $conn->query("UPDATE user SET nama = '$nama',username = '$username',password = '$password1',foto = '$image_location' WHERE id_user = '$id_user'")or die(mysql_error());
                            echo "<script> window.location='profil.php' </script>";
                        }
                    } else {
                        echo "<script>alert('Gagal mengunggah file.');</script>";
                    }
                } else {
                    echo "<script>alert('Hanya file dengan ekstensi jpg, jpeg, webp, atau png yang diizinkan.');</script>";
                }
            }
		}	
	?>

  <?php include ('footer.php');?>
      <?php include ('script.php');?>

</body>

</html>