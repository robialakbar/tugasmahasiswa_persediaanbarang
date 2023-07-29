$(document).ready(function () {

  function capitalize(s) {
    return s[0].toUpperCase() + s.slice(1);
  }

  $('.hapus-master').click(function() {
    const id = $(this).data('id');
    const jenis = $(this).data('jenis');
    Swal.fire({
      title: capitalize(jenis)+' akan dihapus!',
      text: "Anda yakin?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus '+capitalize(jenis)+'!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      
      if (result.value) {
        document.location.href = "http://localhost/inventory-system3/"+jenis+"/hapus/"+id;
      }
    })
  });

  let hasil = $('.result').data('hasil');
  let tindakan = $('.result').data('tindakan');
  let jenis = $('.result').data('jenis');
  let aksi, teks, judul;

  if ( hasil!='used' ) {
    if (hasil == 'success') {
      teks = 'berhasil';
    } else if (hasil == 'error') {
      teks = 'gagal';
    }

    if ( tindakan == 'add' ) {
      aksi = 'ditambahkan!';
    } else if( tindakan == 'update' ) {
      aksi = 'diubah!';
    } else if ( tindakan == 'delete' ) {
      aksi = 'dihapus!';
    }
    judul = teks;
  } else {
    hasil = 'error';
    judul = 'gagal';
    teks = 'sedang';
    aksi = 'digunakan! Hapus data terlebih dahulu!';
    // var used = true;
  }
  let timer = 3000;
  if (teks == "sedang") {
    timer = 5000;
  }
  if (hasil && tindakan && jenis && aksi && judul) {
    Swal.fire({
      title: capitalize(judul),
      text: capitalize(jenis)+' '+teks+' '+aksi,
      icon: hasil,
      showConfirmButton: true
      // timer: timer
    });

    if (teks == "sedang") {
      $("button").click(function () {
        if (jenis == "role") {
          document.location.href = "http://localhost/inventory-system3/users";
        } else {
          document.location.href = "http://localhost/inventory-system3/info";
        }
      });
    }
  }

});