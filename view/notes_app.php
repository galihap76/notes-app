<?php

// cek jika belum login
if(!$this->session->userdata("nama")){
  // paksa alihkan ke halaman auth
    redirect('auth');
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes App</title>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .white {
             color: white;
        }
        .bi-person-circle{
                margin-right: 40px;
        }
        .dropdown-menu{
                margin-left: -80px;
        }
        .logout{
                text-decoration: none;
        }
        </style>
  </head>

  <body>
    <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <i class="bi bi-app-indicator"></i> Notes App</a>

    <!-- Profile -->
    <div class="dropdown">
        <a href="#" data-bs-toggle="dropdown" aria-expanded="false" > <i class="bi bi-person-circle fs-1" style="color:white"></i></a>

  <ul class="dropdown-menu">
    <li><button class="dropdown-item" type="button"><?php echo $_SERVER['REMOTE_ADDR']; ?></button></li>
    <li><a class="logout" href="<?php echo base_url('auth/logout'); ?>"><button class="dropdown-item" type="button">Log out</button></a></li>
  </ul>
</div>

  </div>
</nav>
<!-- Akhir navbar -->

<!-- Main -->
      <div class="container">
        <div class="text-center">
            <div class="row">
                <div class="col">

                <!-- Textarea -->
                <div class="form-floating mt-5 mb-5">
                <textarea class="form-control" id="textarea1" style="height: 450px;"></textarea> 
                  </div> 

                </div>
            </div>

            <!-- Button save-->
            <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success mb-5 btnSave" onclick="btnSave()">Save</button>
                    </div>
            </div>
        </div>
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        // function untuk save text berupa ekstensi .txt
       function btnSave(){
                let textArea = document.getElementById('textarea1');

                // cek jika text area masing kosong
                if(textArea.value == ''){
                        // beri pesan untuk tidak bisa di save
                        swal("Oops", "Tidak bisa di save karena text area masih kosong.", "error");
                }else{
                        // misal terisi textarea nya maka akan melakukan pengunduhan file pada textarea
                        let a = document.createElement("a");
                        a.href = window.URL.createObjectURL(new Blob([textArea.value], {type: "text/plain"}));
                        a.download = "notes.txt";
                        a.click();
                }
        }
        
    </script>
  </body>
</html>