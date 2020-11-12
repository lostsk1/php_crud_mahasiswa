<?php


/*
    | nama : candra dwi cahyo
    | umur : 16 tahun
    | kota : malang
    | email : candradwicahyo18@gmail.com
    | github : github.com/candradwicahyo
    | codepen : codepen.io/candradwicahyo
*/


$conn = mysqli_connect('localhost', 'root', '', 'php_crud_image');


function query($param) {
  global $conn;
  
  $query = mysqli_query($conn, $param);
  $rows = [];
  
  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
      $rows[] = $row;
    }
  }
  
  return $rows;
}


function base_url($param = []) {
  
  
  /*
      | kalian bisa menggunakan fungsi base_url() ini untuk memanggil berbagai vendor yang berada di folder vendor
      | jika kalian menjalankam program ini di desktop, maka variabel $base_url harus diubah terlebih dahulu sesuai alamat url kalian
      | dikarenakan saya membuat program ini di mobile, otomatis alamat url saya memakai port
      | untuk pengguna desktop, kalian bisa merunah variabel $base_url seperti berikut
      |
      | contoh : 'http://localhost/folder-htdocs-kalian/php_crud_image/'
      |
      | dan untuk pengguna mobile, kalian hanya cukup merubau nama folder htdocs sesuai folder kalian dan merubah port nya sesuai port yang kalian gunakan
      | dikarenakan saya memakai apache, maka port yang saya pakai adalah 8000
      | jika kalian memakai lighttpd, maka port yang akan kalian gunakan adalah 8080
  */
  
  
  $base_url = 'http://localhost:8000/page/php_crud_image/';
  
  
  /*
      | variabel $result berisikan pengkondisian tarnary
      | dimana jika $param kosong atau tidak diisi, maka alamat url default nya adalah isi dari variabel $base_url
  */
  
  
  $result = (!$param) ? $base_url : $base_url . $param;
  
  return $result;
}


function view($target, $data = []) {
  
  
  /*
      | fungsi view bisa kalian gunakan untuk memanggil file yang berada di folder templates
      | kalian bisa menggunakan fungsi ini untuk mengubah format html menjadi templating
      | jika kalian menggunakan require / include, maka kalian harus menuliskan seperti contoh dibawah ini
      |
      | contoh 1 : require_once 'templates/file_tujuan.php'
      | contoh 2 : include_once 'templates/file_tujuan.php'
      |
      | namun bila kalian menggunakan fungsi view, kalian hanya perlu menulis seperti contoh dibawah ini
      | 
      | contoh : view('templates/file_tujuan') 
      |
      | dan fungsi dari variabel $data adalah untuk dikirimkan ke file header.php dan footer.php
      | variabel data bisa digunakan untuk memberi nama judul halaman dan nama script javasvript
      |
      | contoh : $data['judul'] = 'isi nama judul sesuai keinginan kalian, sesuaikan dengan halaman yang ingin kalian buat'
      | contoh : $data['javascript'] = 'nama_script.js', saya buat seperti ini karena ingin memisahkan file yang digunakan halaman utama dan form supaya tidak terjadi error
  */
  
  
  require_once $target . '.php';
}


function set_flashdata($param1, $param2, $param3) {
  
  
  /*
      | fungsi dari set_flashdata() berfungsi untuk membuat alert atau pemberitahuan dengan pesan sesuai keinginan pengguna
      | fungsi set_flashdata() memiliki 3 parameter yang harus diisi
      | parameter ke 1 adalah pesan, isikan pesan sesuai keinginan anda
      | parameter ke 2 adalah aksi, isikan aksi sesuai aksi yang ingin anda lakukan
      | parameter ke 3 adalah tipe, tipe ini berguna untuk memberikan warna kepada alert tersebut sesuai isi dari paramter $param3
      | tipe ini ada berbagai macam, ada success untuk warna hijau, ada danger untuk warna merah, ara warning untuk warna kuning
      |
      | contoh : eet_flashdata('berhasil', 'ditambahkan', 'success');
  */
  
  
  // diberi keamanan terlebih dahulu agar tidak ada celah bagi hacker untuk meretas program ini
  $message = trim(stripslashes(htmlspecialchars($param1)));
  $action = trim(rtrim(stripslashes(htmlspecialchars($param2))));
  $type = trim(rtrim(stripslashes(htmlspecialchars($param3))));
  
  return $_SESSION['flash'] = [
    'message' => $message,
    'action' => $action,
    'type' => $type
  ];
}


function flashdata() {
  
  
  /*
      | fungsi dari flashdata() untuk menampilkan pemberitahuan yang sebelumnya dibuat di halaman tertentu
      | fungsi ini tidak memiliki parameter
      | lakukan pengecekan terlebih dahulu, jika sebelumnya pengguna belum membuat alert terlebih dahulu namun langsung menjalankan fungsi ini, maka jangan tampilkan pemberitahuan tersebut
  */
  
  
  if (isset($_SESSION['flash'])) {
    echo '<div class="alert alert-'. $_SESSION['flash']['type'] .' alert-dismissible fade show" role="alert">
            Data mahasiswa <strong>'. $_SESSION['flash']['message'] .'</strong> '. $_SESSION['flash']['action']  .'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    
    
    // jika pemberitahuan sudah tampil 1 kali, maka hapus session tersebut supaya ketika web di refresh, pemberitahuan tersebut sudah hilang        
    unset($_SESSION['flash']);
  }
}


function set_userdata($param1, $param2) {
  
  
  /*
      | fungsi dari set_userdata() berfungsi untuk membuat alert atau pemberitahuan dengan pesan sesuai keinginan pengguna
      | fungsi set_userdata() memiliki 2 parameter yang harus diisi
      | parameter ke 1 adalah pesan, isikan pesan sesuai keinginan anda
      | parameter ke 2 adalah tipe, tipe ini berguna untuk memberikan warna kepada alert tersebut sesuai isi dari paramter $param3
      | tipe ini ada berbagai macam, ada success untuk warna hijau, ada danger untuk warna merah, ara warning untuk warna kuning
      |
      | contoh : eet_flashdata('berhasil', 'ditambahkan', 'success');
  */
  
  
  // diberi keamanan terlebih dahulu agar tidak ada celah bagi hacker untuk meretas program ini
  $message = trim(stripslashes(htmlspecialchars($param1)));
  $type = trim(rtrim(stripslashes(htmlspecialchars($param2))));
  
  return $_SESSION['error'] = [
    'message' => $message,
    'type' => $type
  ];
}


function userdata() {
  
  
  /*
      | fungsi dari userdata() untuk menampilkan pemberitahuan yang sebelumnya dibuat di halaman tertentu
      | fungsi ini tidak memiliki parameter
      | lakukan pengecekan terlebih dahulu, jika sebelumnya pengguna belum membuat alert terlebih dahulu namun langsung menjalankan fungsi ini, maka jangan tampilkan pemberitahuan tersebut
  */
  
  
  if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-'. $_SESSION['error']['type'] .' alert-dismissible fade show" role="alert">
            '. $_SESSION['error']['message'] .'
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    
    
    // jika pemberitahuan sudah tampil 1 kali, maka hapus session tersebut supaya ketika web di refresh, pemberitahuan tersebut sudah hilang        
    unset($_SESSION['error']);
  }
}


function set_value($nama, $nrp, $email, $jurusan) {
  
  
  // kegunaan fungsi set_value() adalah untuk mencatat semua inputan pengguna setelah tombol submit ditekan
  return $_SESSION['value'] = [
    'nama' => $nama,
    'nrp' => $nrp,
    'email' => $email,
    'jurusan' => $jurusan
  ];
}


function list_jurusan() {
  
  
  // kumpulan list jurusan mahasiswa
  $list = ['teknik informatika', 'teknik planologi', 'teknik industri', 'teknik pangan', 'teknik mesin'];
  
  return $list;
}


function insert($nama, $nrp, $email, $jurusan) {
  global $conn;
  
  if (!validation($nama, $nrp, $email, $jurusan)) {
    
    
    // jika fungsi validation() mengembalikan nilai boolean false, maka arahkan pengguna ke halaman insert.php
    header('Location: insert.php');
    exit();
  } else {
    
    
    /*
        | jika fungsi validation() mengembalikan nilai boolean true
        | jalankan fungsi query()
        | jika fungsi query() mengembalikan nilai boolean true, maka nrp sudah digunakan oleh pengguna lain
        | nrp hanya boleh dimiliki oleh 1 pengguna, jika ada pengguna lain yang memakai nrp yang sama, maka berikan pemberitahuan
    */
    
    
    if (query("SELECT nrp FROM mahasiswa WHERE nrp = '$nrp'")) {
      
      
      // jika nrp sudah digunakan oleh pengguna lain
      set_userdata('maaf, nrp ini sudah digunakan oleh pengguna lain', 'danger');

      header('Location: insert.php');
      exit();
    }
    
    
    // jika nrp belum pernah dugunakan
    // cek email, apakah email sudah digunakan oleh pengguna lain atau belum
      
      
    if (query("SELECT email FROM mahasiswa WHERE email = '$email'")) {
        
        
      // jika email sudah digunakan oleh pengguna lain
      set_userdata('maaf, email ini sudah digunakan oleh pengguna lain', 'danger');

      header('Location: insert.php');
      exit();
    }
    
    
    // jalankan fungsi upload()
    $gambar = upload();
    
    if (!$gambar) {
          
          
      //jika variabel $gambar mengembalikan nilai false, maka arahkan pengguma ke halaman insert.php lagi
      header('Location: insert.php');
      exit();
    }
    
    
    // jika variabel $gambar mengembalikan nilai boolean true
    // perintah query
    $query = "INSERT INTO mahasiswa VALUES('', '$nama', '$nrp', '$email', '$jurusan', '$gambar')";


    // jalankan perintah query
    mysqli_query($conn, $query);
    
    
    /*
        | jika mysqli_affected_rows() mengembalikan nilai angka lebih besar dari 0, maka data baru berhasl ditambahkan ke database
        | namun jika mysqli_affected_rows() mengembalikan nilai angka 0, maka data baru gagal ditambahkan ke database
    */


    return mysqli_affected_rows($conn);
  }
}


function validation($nama, $nrp, $email, $jurusan) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (empty($nama) && empty($nrp) && empty($email) && empty($jurusan)) {
      
      
      // jika semua field kosong
      set_userdata('isi semua field terlebih dahulu dengan benar', 'danger');
      
      return false;
    }
    
    if (empty($nama)) {
      
      
      // jika field nama kosong
      set_userdata('field nama tidak boleh kosong', 'danger');
      
      return false;
    } else if (strlen($nama) <= 5) {
      
      
      // jika nama pengguna terlalu pendek
      set_userdata('nama anda terlalu pendek', 'danger');
      
      return false;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
      
      
      // jika field nama diisi selain dengan huruf
      set_userdata('field nama hanya boleh diisi dengan huruf saja', 'danger');
      
      return false;
    }
    
    if (empty($nrp)) {
      
      
      // jika field nrp kosong
      set_userdata('field umur tidak boleh kosong', 'danger');
      
      return false;
    } else if (!preg_match("/^[0-9]*$/", $nrp)) {
      
      
      // jika field nrp diisi selain dengan angka
      set_userdata('field nrp hanya boleh diisi dengan angka', 'danger');
      
      return false;
    } else if (strlen($nrp) <= 8 || strlen($nrp) >= 10) {
      
      // jika panjang karakter field nrp kurang dari aturan dan melebihi aturan
      set_userdata('field nrp minimal dan maximal adalah 9 character', 'danger');
      
      return false;
    }
    
    if (empty($email)) {
      
      
      // jika field email kosong
      set_userdata('field email tidak boleh kosong', 'danger');
      
      return false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      
      
      // jika field email diisi dengan format email yang tidak valid
      set_userdata('bukan berupa format email yang valid', 'danger');
      
      return false;
    }
    
    if (empty($jurusan)) {
      
      
      // jika field jurusan kosong
      set_userdata('field jurusan tidak boleh kosong', 'danger');
      
      return false;
    }
    
    
    // jika lolos dsri semua uji validasi, maka kembalikan nilai boolean true
    return true;
  }
}


function upload() {
  $nama_file = $_FILES['gambar']['name'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_name = $_FILES['gambar']['tmp_name'];
  
  if ($error === 4) {
    
    
    // jika pengguna tidak mengupload file apapun
    set_userdata('harap upload file terlebih dahulu', 'danger');
    
    return false;
  }
  
  
  // kumpulan ekstensi yang boleh untuk diupload, selain itu tidak boleh
  $ekstensi_gambar_valid = ['jpg', 'jpeg', 'png', 'gif'];
  
  
  /*
      | pecah isi dari variabel $nama_file menjadi array terlebih dahulu
      | jika di dalam variabel $nama_file ditemukan tanda . atau titik, maka pecah isi dari variabel $nama_file menjadi array
      | contoh : candra.jpg, maka akan dirubah seperti ini ['candra', 'jpg']
  */
  
  
  $ekstensi_gambar = explode('.', $nama_file);
  
  
  /*
      | strtolower berfungsi sebagai pengecil semua huruf, yanh tadinya seperti ini CANDRA.JPG, menjadi seperti imi candra.jpg
      | end berfungsi untuk mengambil index terakhir di sebuah array variabel $ekstensi_gambar
      | end digunakan untuk mengambil sebuah ekstensi file yang diupload oleh pengguna untuk dicek, apakah ekstensi nya berupa gambar atau tidak
      | contoh : candra.dwi.cahyo.jpg, maka akan di jadikan array terlebih dahulu seperti berikut ['candra', 'dwi', 'cahyo', 'jpg'], maka yang diambil oleh tag end adalah jpg
  */
  
  
  $ekstensi_gambar = strtolower(end($ekstensi_gambar));
  
  if (!in_array($ekstensi_gambar, $ekstensi_gambar_valid)) {
    
    
    // jika file yang diupload oleh pengguna bukanlah gambar
    set_userdata('yang anda upload bukanlah tipe file gambar', 'danger');
    
    return false;
  }
  
  if ($ukuran_file > 5000000) {
    
    
    // jika file yang diupload oleh pengguna terlalu besar
    set_userdata('ukuran file yang anda upload terlalu nesar', 'danger');
    
    return false;
  }
  
  
  // generate ke nama baru
  $nama_file_baru = 'my_program_2020_' . uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_gambar;
  
  move_uploaded_file($tmp_name, 'assets/images/' . $nama_file_baru);
  
  return $nama_file_baru;
}


function delete($id) {
  global $conn;
  
  
  // perintah query
  $query = "DELETE FROM mahasiswa WHERE id = '$id'";
  
  
  // jalankan perintah query
  mysqli_query($conn, $query);
  
  
   /*
        | jika mysqli_affected_rows() mengembalikan nilai angka lebih besar dari 0, maka data berhasil dihapus dari dayabase
        | namun jika mysqli_affected_rows() mengembalikan nilai angka 0, maka data gagal dihapus dari database
   */
  
  
  return mysqli_affected_rows($conn);
}


function edit($id, $nama, $nrp, $email, $jurusan, $nrp_lama, $email_lama, $gambar_lama) {
  global $conn;
  
  if (!validation($nama, $nrp, $email, $jurusan)) {
    
    
    // jika fungsi validation() mengembalikan nilai boolean false, maka arahkan pengguna ke halaman insert.php
    header('Location: edit.php?id=' . $id);
    exit();
  } else {
    
    
    // jika fungsi validation() mengembalikan nilai boolean true
    // jika nrp yang berada di input tidak sama dengan nrp yang ada di database
    if ($nrp !== $nrp_lama) {
      
      
      // cek apakah nrp yang baru saja diketik sudah digunakan oleh pengguna lain atau belum
      if (query("SELECT nrp FROM mahasisea WHERE nrp = '$nrp'")) {
        
        
        // jika nrp sudah digunakan oleh pengguna lain
        set_userdata('maaf, nrp ini sudah digunakan oleh pengguna lain', 'danger');
        
        header('Location: edit.php?id=' . $id);
        exit();
      } 
    }
    
    
    // jika email yang berada di input tidak sama dengan email yang ada di database
    if ($email !== $email_lama) {
      
      
      // cek apakah email yang baru saja diketik sudah digunakan oleh pengguna lain atau belum
      if (query("SELECT email FROM mahasiswa WHERE email = '$email'")) {
        
        
        // jika email sudah pernah digunakan oleh pengguna lain
        set_userdata('maaf, email ini sudah digunakan oleh pengguna lain', 'danger');
        
        header('Location: edit.php?id=' . $id);
        exit();
      }
    }
    
    
    // cek apakah pengguna sudah mengupload file atau belum
    $result = ($_FILES['gambar']['error'] === 4) ? $gambar = $gambar_lama : $gambar = upload();
    
    
    // perintah query
    $query = "UPDATE mahasiswa SET nama = '$nama', nrp = '$nrp', email = '$email', jurusan = '$jurusan', gambar = '$result' WHERE id = '$id'";
    
    
    // jalankan perintah query
    mysqli_query($conn, $query);
    
    
    /*
        | jika mysqli_affected_rows() mengembalikan nilai angka lebih besar dari 0, maka data berhasil diubah dari dayabase
        | namun jika mysqli_affected_rows() mengembalikan nilai angka 0, maka data gagal diubah dari database
    */
  
  
    return mysqli_affected_rows($conn);
  }
}


function search($keyword) {
  
  
  // perintah query
  $query = "SELECT * FROM mahasiswa WHERE
              nama LIKE '%$keyword%' OR
              nrp LIKE '%$keyword%' OR
              email LIKE '%$keyword%' OR
              jurusan LIKE '%$keyword%' 
            ORDER BY id DESC";
            
            
  // jalankan perintah query
  return query($query);
}
