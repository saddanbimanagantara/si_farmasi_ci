<div class="d-flex flex-row-reverse mb-1">
    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-tambah">
        <i class="fas fa-plus"></i>
    </button>
</div>
<table id="table_id" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Satuan Obat</th>
            <th>Harga Obat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<!-- modal edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="forObat">Nama Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pills"></i></span>
                        </div>
                        <input type="text" class="form-control" id="IdObatEdit" name="IdObatEdit" hidden>
                        <input type="text" class="form-control" id="NamaObatEdit" name="NamaObatEdit" placeholder="Masukan Nama Obat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forSatuanObat">Satuan Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        </div>
                        <input type="text" class="form-control" id="SatuanObatEdit" name="SatuanObatEdit" placeholder="Masukan Satuan Obat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forSatuanObat">Harga Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="HargaObatEdit" name="HargaObatEdit" placeholder="Masukan Harga Obat">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btn-simpan-edit">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- /. modal edit -->

<!-- modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Obat</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="forObat">Nama Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pills"></i></span>
                        </div>
                        <input type="text" class="form-control" id="NamaObat" name="NamaObat" placeholder="Masukan Nama Obat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forSatuanObat">Satuan Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        </div>
                        <input type="text" class="form-control" id="SatuanObat" name="SatuanObat" placeholder="Masukan Satuan Obat">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forSatuanObat">Harga Obat</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="HargaObat" name="HargaObat" placeholder="Masukan Harga Obat">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="SimpanData">Simpan Data</button>
            </div>
        </div>
    </div>
</div>
<!-- /. modal Tambah -->

<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                'url': '<?= base_url() ?>' + 'obat/data/jsonobat',
                'type': 'POST',
                'dataType': 'JSON'
            }
        });

        $('#SimpanData').click(function() {
            var NamaObat = $('#NamaObat').val();
            var SatuanObat = $('#SatuanObat').val();
            var HargaObat = $('#HargaObat').val();
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tambahkan!',
                cancelButtonText: 'Batalkan!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'obat/data/tambahobat',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            NamaObat: NamaObat,
                            SatuanObat: SatuanObat,
                            HargaObat: HargaObat
                        },
                        success: function(data) {
                            const error = data.error;
                            if (data.keterangan === 'Gagal') {
                                var html = '';
                                error.forEach(function(value, index, array) {
                                    html += value;
                                })
                                Swal.fire({
                                    title: 'Data Tidak Lengkap!',
                                    icon: 'error',
                                    html: '<div class="text-danger">' + html + '</div>'
                                })
                            } else {
                                Swal.fire(
                                    'Disimpan!',
                                    'Data berhasil disimpan.',
                                    'success'
                                )
                                $('#modal-tambah').modal('hide');
                                $('#table_id').DataTable().ajax.reload();
                            }
                        }
                    })
                }
            })
        });

        $('#btn-simpan-edit').click(function() {
            var IdObatEdit = $('#IdObatEdit').val();
            var NamaObatEdit = $('#NamaObatEdit').val();
            var SatuanObatEdit = $('#SatuanObatEdit').val();
            var HargaObatEdit = $('#HargaObatEdit').val();
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit!',
                cancelButtonText: 'Batalkan!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'obat/data/editobat',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            IdObat: IdObatEdit,
                            NamaObat: NamaObatEdit,
                            SatuanObat: SatuanObatEdit,
                            HargaObat: HargaObatEdit
                        },
                        success: function(data) {
                            const error = data.error;
                            if (data.keterangan === 'gagal') {

                                console.log(data);
                                var html = '';
                                error.forEach(function(value, index, array) {
                                    html += value;
                                })
                                Swal.fire({
                                    title: 'Data Tidak Lengkap!',
                                    icon: 'error',
                                    html: '<div class="text-danger">' + html + '</div>'
                                });
                            } else if (data.keterangan === true) {
                                Swal.fire(
                                    'Diedit!',
                                    'Data berhasil diedit.',
                                    'success'
                                )
                                $('#modal-edit').modal('hide');
                                $('#table_id').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Data gagal diedit.',
                                    'success'
                                )
                                $('#modal-edit').modal('hide');
                                $('#table_id').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
    })

    function edit(dataedit) {
        var IdObat = $(dataedit).attr('IdObat');
        $('#modal-edit').modal('show');
        getObatById(IdObat);
    }

    function hapus(datahapus) {
        var IdObat = $(datahapus).attr('IdObat');
        Swal.fire({
            title: 'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batalkan!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>' + 'obat/data/hapusobat',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        IdObat: IdObat
                    },
                    success: function(data) {
                        if (data.keterangan == 1) {
                            Swal.fire(
                                'Berhasil!',
                                'Data ' + data.dataobat[0].NamaObat + ' berhasil dihapus.',
                                'success'
                            )
                            $('#table_id').DataTable().ajax.reload();
                        } else {
                            Swal.fire(
                                'Gagal!',
                                'Data <b>' + data.dataobat[0].NamaObat + '</b> gagal dihapus.',
                                'success'
                            )
                            $('#table_id').DataTable().ajax.reload();
                        }
                    }
                })
            }
        });
    }

    function getObatById(IdObat) {
        var datalengkap;
        $.ajax({
            url: '<?= base_url() ?>' + 'obat/data/jsonobatbyid/' + IdObat,
            method: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#IdObatEdit').val(data[0].IdObat);
                $('#NamaObatEdit').val(data[0].NamaObat);
                $('#SatuanObatEdit').val(data[0].SatuanObat);
                $('#HargaObatEdit').val(data[0].HargaObat);
            }
        })
    }
</script>