@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'CCTV'])
    <div class="container-fluid py-4">
        <div class="pt-4"></div>
        <div class="pt-4"></div>
        <div class="container">
            <h6>Daftar CCTV</h6>
            <a class="btn btn-info" href="{{ route('tambahCctv') }}"> Tambah CCTV</a>
            <table class="table table-bordered table-striped" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruas</th>
                        <th>Location CCTV</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        @include('layouts.footers.auth.footer')
</div>
@endsection
@section('script')

    
<script type="text/javascript">
    $(document).ready(function () {
        var tableDataCctv;
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        tableDataCctv = $('#example').DataTable( {
            "lengthChange": true,
            "dom": "<'row'<'col-sm-3'l><'col-sm-6 text-center'B><'col-sm-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                extend: 'excelHtml5',
                footer: true,
                text: 'Download',
                className: 'btn-success',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            }],
            "processing": true,
            "serverSide": true,
            "searching": false,
            "responsive": true,
            "ordering": [[ 0, "asc" ]],
            "autoWidth": false,
            "language": {
                sZeroRecords: "<center>Data tidak ditemukan</center>",
                sLengthMenu: "Tampilkan _MENU_ data   ",
                sInfo: "Menampilkan: _START_ - _END_ dari total : _TOTAL_ data",
                oPaginate: {
                    sFirst: "Awal",
                    "sPrevious": "Sebelumnya",
                    sNext: "Selanjutnya",
                    "sLast": "Akhir"
                },
            },

            "ajax": {
                "url": "{{ route('cctv.list') }}",
                "data": function(data) {
                    data.region = $('#region').val();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        'Maaf!',
                        'Ada Kesalahan Get API',
                        'error'
                    );
                }
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ruas', name: 'ruas'},
                {data: 'location', name: 'location'},
                {
                    data: 'aksi', 
                    name: 'aksi', 
                    orderable: false, 
                    searchable: false
                },
            ],
            "lengthMenu": [
                [10, 25, 100, -1],
                [10, 25, 100, "All"]
            ],
            drawCallback: function() {
                var hasRows = this.api().rows({
                    filter: 'applied'
                }).data().length > 0;
                $('.buttons-excel')[0].style.visibility = hasRows ? 'visible' : 'hidden'
            }
        } );
    
    });
    //hapus cctv satu item
    function hapus_cctv(id){
        var id      = id;

        if(id > 0){
            Swal.fire({
                title: 'Yakin mau hapus CCTV Ini ?',
                customClass: 'swal-wide',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0000cc',
                confirmButtonText: 'Ya, Hapus',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                        $.ajax({
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id:id
                            },
                            url: "{{ route('delCctv') }}",
                            dataType: "JSON",
                            async: false,
                            beforeSend: function() {
                                $('body').loading();
                            },
                            success: function(response)
                            {
                                var sts     = response.data.status_id;
                                var code    = response.status;
                                $('body').loading('stop');
                                if(code == 200){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Delete CCTV!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    location.href = "{{ route('cctv') }}";
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!!!',
                                        text: 'Gagal Delete CCTV!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            },
                            error: function(jqXHR, exception) {
                                $('body').loading('stop');
                                if (jqXHR.status === 0) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Not connect.\n Verify Network.'
                                    })
                                } else if (jqXHR.status == 404) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested page not found. [404]'
                                    })
                                } else if (jqXHR.status == 500) {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Internal Server Error [500].'
                                    })
                                } else if (exception === 'parsererror') {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested JSON parse failed.'
                                    })
                                } else if (exception === 'timeout') {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Time out error.'
                                    })
                                } else if (exception === 'abort') {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Ajax request aborted.'
                                    })
                                } else {
                                    Swal.fire({
                                        type: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Uncaught Error.\n' + jqXHR.responseText
                                    })
                                }
                            }
                        });
                }else{
                    $('body').loading('stop');
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Batal delete Data CCTV!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
    
            })
        }else{
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Tidak ada data terpilih!'
            })
        }
    }
</script>
@endsection

