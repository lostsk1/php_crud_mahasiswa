/*
    | nama : candra dwi cahyo
    | umur : 16 tahun
    | email : candradwicahyo18@gmail.com
*/


$(document).ready(function() {
  
  
  // menggunakan plugin datatables()
  $('#myTable').dataTable();

  $('.badge-deletes').on('click', function(e) {


    // matikan fitur href pada tombol hapus
    event.preventDefault();


    // tujuan utama untuk menghapus data
    const target = this.dataset.target;


    // berikan alert atau popup menggunakan plugin sweetalert2
    swal.fire({
      position: 'center',
      icon: 'warning',
      title: 'apakah anda sudah yakin',
      text: 'ingin menghapus data tersebut?',
      showCancelButton: true,
      cancelButtonText: 'tidak',
      confirmButtonText: 'yakin'
    }).then(result => {


      /*
          | jika tombol yakin ditekan, maka arahkan pengguna ke file delete.php
          | karena jika tombol yakin ditekan, variabel result akan menghasilkan nilai boolean true
      */


      if (result.value) document.location.href = target;
    });
  });
});
