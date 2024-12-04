<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">

    <title>Beasiswa NVL</title>
  </head>
  <body> 

  <?php
// struktur kontrol dalam pemrograman yang memungkinkan untuk membuat keputusan berdasarkan kondisi tertentu. Jika kondisi benar, maka blok kode dalam if akan dieksekusi, jika tidak, maka blok else yang akan dijalankan.
    // mendeteksi apakah ada parameter link page yang dikirimkan
    if(isset($_GET['link_page'])){
       // untuk mengatur nilai halaman yang sedang aktif, dengan memeriksa parameter link_page yang dikirimkan melalui URL
       // tipe data yang digunakan untuk menyimpan beberapa nilai dalam satu variabel. Array dapat berisi data dari tipe yang sama atau berbeda.
       // di sini menggunakan 1 dimensi
       $link_page = $_GET['link_page'];
    }else{
        // jika parameter link page tidak aktif maka tampilan akan berubah ke halaman 1
        $link_page = 1;
    }

    // fungsi adalah sekumpulan kode yang dirancang untuk melakukan tugas tertentu dan dapat dipanggil berulang kali di seluruh program.
    // Fungsi ini digunakan untuk menambahkan kelas active pada elemen navbar yang relevan
    function SetLinkPage($actual_link, $reference_link){
        $result = "";
        if ($actual_link == $reference_link){
            $result = "active";
        }
        return $result;
    }
    function SetContentPage($actual_content, $reference_content){
        $result = "";
        if ($actual_content == $reference_content){
            $result = "show active";
        }
        return $result;
    }

    
    include_once("connection.php");
    $result = mysqli_query($conn, "SELECT*FROM form");


    // Untuk menambahkan data ipk secara acak 
    function generateRandomFloat(float $minValue, float $maxValue): float
    {
        return $minValue + mt_rand() / mt_getrandmax() * ($maxValue - $minValue);
    }

    function SetDisable($ipk){
        $result = "";
        if ($ipk < 3){
        $result = "disabled";
    }
        return $result;
    }
  ?>


  <div class="container">
    <nav class="navbar navbar-expand-lg" style="background-color: #ffffff;">
        <a class="navbar-brand" href="#">Beasiswa NVL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            </ul>
        </div>
        </nav>
</div> <!-- end of container -->

<div class="container">
    <nav>
        <nav>
    
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <!--elemen class ini digunakan untuk membuat link navigasi dalam tampilan tab navigasi. -->
        <a class="nav-item nav-link <?php echo SetLinkPage("1", $link_page)?>" id="nav-home-tab" data-toggle="tab" href="#beasiswa" role="tab" aria-controls="nav-home" aria-selected="true">Pilihan Beasiswa</a>
        
        <a class="nav-item nav-link <?php echo SetLinkPage("2", $link_page)?>" id="nav-profile-tab" data-toggle="tab" href="#daftar" role="tab" aria-controls="nav-profile" aria-selected="false">Daftar</a>
        
        <a class="nav-item nav-link <?php echo SetLinkPage("3", $link_page)?>" id="nav-contact-tab" data-toggle="tab" href="#hasil" role="tab" aria-controls="nav-contact" aria-selected="false">Hasil</a>
    </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
    
        <div class="tab-pane fade <?php echo SetContentPage("1", $link_page)?>" id="beasiswa" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="section-menu">
           
                <h4>Jenis Beasiswa</h4>
                <p>Saat ini, Beasiswa NVL memiliki dua program untuk mahasiswa perguruan tinggi, yaitu:</p>
                <ol>
                    <li><h5>Beasiswa Akademik</h5>
                        <p>Beasiswa Akademik adalah beasiswa yang diberikan kepada mahasiswa perguruan tinggi berdasarkan prestasi akademik. Adapun persyaratan yang dibutuhkan adalah:</p>
                        <ul>
                            <li><p>IPK minimal 3</p></li>
                            <li><p>Aktif dalam kegiatan akademik lainnya seperti penelitian, seminar, atau proyek-proyek terkait bidang studi</p></li>
                        </ul>
                    <li>
                        <h5>Beasiswa Non-Akademik</h5>
                        <p>Beasiswa Non-Akademik adalah beasiswa yang diberikan kepada mahasiswa perguruan tinggi berdasarkan pencapaian di luar bidang akademik. Adapun persyaratan yang dibutuhkan adalah:</p>
                        <ul>
                            <li><p>Sertifikat atau penghargaan yang menunjukkan prestasi</p></li>
                            <li><p>Keterlibatan dalam organisasi, klub, atau kegiatan yang berkaitan</p></li>
                        </ul>
                    </li>

                </ol>
                    

            </div>

        </div>
        
        <div class="tab-pane fade <?php echo SetContentPage("2", $link_page)?>" id="daftar" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="section-menu">
            
                <h4>Form Pendaftaran</h4>
                <form action="add_form.php" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Nama" placeholder="Masukkan Nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="Email" placeholder="Masukkan Email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="hp" placeholder="Masukkan Nomor Handphone" name="hp" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-2 col-form-label">Semester Saat Ini</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="semester" id="semester" required>
                                <?php
                                    for($i=1; $i<=8; $i++)
                                    {
      
                                ?>
                                    <option value="<?php echo $i ?>"><?php echo "Semester " . $i ?></option>
                                <?php
                                    }
                                ?>

                            </select>
                        </div>
                    </div>
                    <?php
                        $minValue = 2.9;
                        $maxValue = 3.4;
                        $ipk = round(generateRandomFloat($minValue, $maxValue), 1);
                    ?>

                    <div class="form-group row">
                        <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ipk" name="ipk" value="<?php echo $ipk ?>" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="beasiswa" class="col-sm-2 col-form-label">Jenis Beasiswa</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="beasiswa" id="beasiswa" required <?php echo SetDisable($ipk)?>>
                                <option value="Akademik">Akademik</option>
                                <option value="Non-Akademik">Non-Akademik</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="upload_file" class="col-sm-2 col-form-label">Upload Berkas Syarat</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="customfile" name="berkas" value="<?php echo $ipk ?>" required <?php echo SetDisable($ipk)?> accept=".jpg, .jpeg, .pdf">
                            
                        </div>

                    </div>

                    <input class="btn btn-primary btn-lg" type="submit" value="Daftar" <?php echo SetDisable($ipk)?>>

                    <a class="btn btn-warning btn-lg" href="index.php?link_page=2">Batal</a>

                </form>
            </div>   
            
        </div>
        
        <div class="tab-pane fade <?php echo SetContentPage("3", $link_page)?>" id="hasil" role="tabpanel" aria-labelledby="nav-contact-tab" style="margin-top: 40px; margin-bottom: 40px;">
            <div class="section-menu">
                <h4>List Pendaftar</h4>
                <?php
                    while($user_data = mysqli_fetch_array($result)) {
                
                ?>

                <div class="row grid-item d-flex align-items-stretch mb-4">
                    <div class="col-md-12 col-lg-4 d-flex flex-column">

                        <img class="img-fluid" src="uploads/<?php echo $user_data['berkas'];?>" alt="">
                    
                    </div>
                    <div class="col-md-12 col-lg-8 d-flex flex-column justify-content-between">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Nama</h4>
                                <h5><?php echo $user_data['nama'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Email</h4>
                                <h5><?php echo $user_data['email'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>No. HP</h4>
                                <h5><?php echo $user_data['hp'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Semester</h4>
                                <h5><?php echo $user_data['semester'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>IPK</h4>
                                <h5><?php echo $user_data['ipk'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Beasiswa</h4>
                                <h5><?php echo $user_data['beasiswa'];?></h5>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-4">
                                <h4>Status</h4>
                                <h5><?php echo $user_data['status'];?></h5>
                            </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

</div> <!-- end of container -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>