@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'RUAS'])
    <div class="container-fluid py-4">
        <form id="form">
            <div class="row">
                <div class="col-lg-3" style="z-index: 0;">
                    <select class="form-control select2bs4" name="region" id="region">
                        <option value="">-- Jasa Marga Group --</option>
                        @foreach($regional as $k => $v)
                        <option value="{{$v->id_region}}" {{$v == request()->region ? 'selected' : ''}}> {{$v->region}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
        <div class="pt-4"></div>
        <div class="container">
            <h6>Daftar Ruas</h6>
            <a class="btn btn-info" href="javascript:void(0)" id="createRuas"> Tambah Ruas</a>
            <table class="table table-bordered table-striped" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ruas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        
        <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modelHeading"></h4>
                    </div>
                    <div class="modal-body">
                        <form id="postForm" name="postForm" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="title" class="col-sm-4 control-label">Pilih Region</label>
                                <select class="form-control select2bs4" name="region_id" id="region_id">
                                    <option value="">-- Pilih Region --</option>
                                    @foreach($regional as $k => $v)
                                    <option value="{{$v->id_region}}" {{$v == request()->region ? 'selected' : ''}}> {{$v->region}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-4 control-label">Nama Region</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_region" name="nama_region" value='-' readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-4 control-label">Nama Ruas</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_ruas" name="nama_ruas" placeholder="Masukan Nama Ruas" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="btnSimpanRuas" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
</div>
@endsection
@section('script')

    
<script type="text/javascript">
    $(document).ready(function () {
        var tableDataRuas;
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //onchange region
        $("#region").change(function() {
            var region = $('#region').val();
            
            tableDataRuas.draw();
        });

        //onchange region
        $("#region_id").change(function() {
            var region_id = $('#region_id').val();
            if (region_id == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Region Belum dipilih!!'
                })
            } else {
                $.ajax({
                    type: "POST",
                    data: {
                            "_token": "{{ csrf_token() }}",
                            region_id:region_id
                        },
                    url: "{{ route('ruas.getReg') }}",
                    dataType: "JSON",
                    success: function(response){
                        var lenData   = response.data.length;
                        var a;
                        for(a=0; a<lenData; a++){
                            $('#nama_region').val(response.data[a].name);
                        }
                    },error: function(textStatus, errorThrown) { 
                        Swal.fire({
                            icon: 'error',
                            title: 'gagal get Regional',
                            text: errorThrown
                        })
                    }
                });
            }
        });
        
        tableDataRuas = $('#example').DataTable( {
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
                    columns: [ 0, 1 ]
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
                "url": "{{ route('ruas.list') }}",
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
        
        $('#createRuas').click(function () {
            $('#region_id').val();
            $('#nama_region').val('-');
            $('#nama_ruas').val('');
            $('#modelHeading').html("Tambah Ruas");
            $('#ajaxModelexa').modal('show');
        });

        //save ruas baru 
        $('#btnSimpanRuas').click(function(){
            //get semua data
            var region_id = $('#region_id').val();
            var nama_region = $('#nama_region').val();
            var nama_ruas = $('#nama_ruas').val();

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('region_id', region_id);
            formData.append('nama_region', nama_region);
            formData.append('nama_ruas', nama_ruas);
            
            if(region_id == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Id Region Tidak Boleh kosong!!'
                })
            }else if(nama_region == '-'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama Region Tidak Boleh kosong!!'
                })
            }else if(nama_ruas == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama Ruas Tidak Boleh kosong!!'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    dataType: "JSON",
                    url: "{{ route('ruas.postRuas') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var sts     = response.data.status_id;
                        var code    = response.status;
                        if(sts == 1 && code == 200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Simpan Ruas Baru!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            location.href = "{{ route('ruas') }}";
                        }else if(sts == 2 && code == 200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Ruas Sudah Tersedia, Coba Ruas Lain!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Simpan Ruas Baru!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },error: function(textStatus, errorThrown, response) { 
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!!!',
                            text: errorThrown,
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $('body').loading('stop');
                    }
                });
            }

        });
        //end save
    
    });
    //hapus ruas satu item
    function hapus_ruas(id){
        var id      = id;

        if(id > 0){
            Swal.fire({
                title: 'Yakin mau hapus Ruas Ini ?',
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
                            url: "{{ route('ruas.delRuas') }}",
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
                                if(sts == 1){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Delete Ruas!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    location.href = "{{ route('ruas') }}";
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!!!',
                                        text: 'Gagal Delete Ruas!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            },
                            error: function(jqXHR, exception) {
                                $('body').loading('stop');
                                if (jqXHR.status === 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Not connect.\n Verify Network.'
                                    })
                                } else if (jqXHR.status == 404) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested page not found. [404]'
                                    })
                                } else if (jqXHR.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Internal Server Error [500].'
                                    })
                                } else if (exception === 'parsererror') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested JSON parse failed.'
                                    })
                                } else if (exception === 'timeout') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Time out error.'
                                    })
                                } else if (exception === 'abort') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Ajax request aborted.'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
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
                        text: 'Batal delete Data Ruas!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
    
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak ada data terpilih!'
            })
        }
    }
</script>
@endsection

