$(function(){
    
    $('.tombolTambahData').on('click',function(){

        $('#formModalLabel').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#nama').val('');
        $('#npm').val('');
        $('#email').val('');
        $('#jurusan').val('');
        $('#id').val('');
    });
    
    $('.tampilModalUpdate').on('click',function(){
        
        $('#formModalLabel').html('Update Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Update Data');
        $('.modal-body form').attr('action', 'http://localhost/phpmvc/public/mahasiswa/ubah');


        const id = $(this).data('id');
        
        $.ajax({
            url: 'http://localhost/phpmvc/public/mahasiswa/getubah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#nama').val(data.nama);
                $('#npm').val(data.npm);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        });

    });
});