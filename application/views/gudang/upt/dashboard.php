<div class="d-flex align-items-center justify-content-between mb-2">
    <div class="form-group">
        <label>Filter Tanggal:</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" class="form-control float-right" id="filterdate" name="filterdate">
        </div>
        <button class="btn btn-sm btn-danger mt-2" id="btn-reset-filter"><i class="fas fa-filter text-light mr-1"></i><span>reset filter</span></button>
    </div>
    <div class="button-add">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahgudangupt">
            <i class="fas fa-plus"></i>
        </button>
        <a href="<?= base_url()?>gudang/upt/laporan" class="btn btn-sm btn-success"><i class="fas fa-file mr-1"></i></i><span>Laporan</span></a>
    </div>
</div>
<table id="gudangupt" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Dinkes</th>
            <th>Blud</th>
            <th>Tanggal Masuk</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<!-- modal tambah -->
<div class="modal fade" id="tambahgudangupt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Tambah Data Gudang UPT</div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <select class="form-control" id="IdObat" name="IdObat" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="forBlud">Blud</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="Dinkes" name="Dinkes" placeholder="Masukan jumlah dari dinkes">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forBlud">Blud</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="Blud" name="Blud" placeholder="Masukan jumlah dari blud">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forTanggal">Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" id="Tanggal" name="Tanggal">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btn-simpan-data">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal edit -->
<div class="modal fade" id="editgudangupt">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Edit Data Gudang UPT</div>
            </div>
            <div class="modal-body">
                <input type="text" id="IdGudangUptEdit" name="IdGudangUptEdit" hidden>
                <div class="form-group">
                    <label>Nama Obat</label>
                    <select class="form-control" id="IdObatEdit" name="IdObatEdit" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="forBlud">Blud</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="DinkesEdit" name="DinkesEdit" placeholder="Masukan jumlah dari dinkes">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forBlud">Blud</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="BludEdit" name="BludEdit" placeholder="Masukan jumlah dari blud">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forTanggal">Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" id="TanggalEdit" name="TanggalEdit">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btn-edit-simpan-data">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    var selectIdObatEdit;
    var tables;
    var tanggaMulai, tanggalAkhir;
    $(document).ready(function() {
        table();

        function table(filterDateRange = '') {
            tables = $('#gudangupt').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                ajax: {
                    url: '<?= base_url() ?>' + 'gudang/upt/jsongudangupt',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        filterDate : function(d) {
                            var dt_params = $('#gudangupt').data('dt_params');
                            if (dt_params) {
                                $.extend(d, dt_params);
                                return dt_params.filterDate;
                            }
                        }
                    },
                },
                columnDefs: [{
                    targets: 5,
                    className: 'text-center'
                }]
            });
        }

        $('#filterdate').daterangepicker();
        $('#IdObat').select2({
            placeholder: 'Cari nama obat',
            ajax: {
                dataType: 'JSON',
                url: '<?= base_url() ?>' + 'gudang/upt/jsondataobat',
                type: 'GET',
                delay: 300,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.NamaObat,
                                id: item.IdObat
                            }
                        })
                    }
                }
            }
        });
        selectIdObatEdit = $('#IdObatEdit').select2({
            placeholder: 'Cari nama obat',
            ajax: {
                dataType: 'JSON',
                url: '<?= base_url() ?>' + 'gudang/upt/jsondataobat',
                type: 'GET',
                delay: 300,
                data: function(params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.NamaObat,
                                id: item.IdObat
                            }
                        })
                    }
                }
            }
        });
        $('#btn-simpan-data').click(function() {
            var IdObat = $('#IdObat').val();
            var Dinkes = $('#Dinkes').val();
            var Blud = $('#Blud').val();
            var Tanggal = $('#Tanggal').val();
            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batalkan!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'gudang/upt/tambahgudangupt',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            IdObat: IdObat,
                            Dinkes: Dinkes,
                            Blud: Blud,
                            Tanggal: Tanggal
                        },
                        success: function(data) {
                            if (data.keterangan === 'kosong') {
                                const errors = data.error;
                                var html = '';
                                errors.forEach(function(value, index, array) {
                                    html += value;
                                })
                                Swal.fire({
                                    title: 'Data Tidak Lengkap!',
                                    icon: 'error',
                                    html: '<div class="text-danger">' + html + '</div>'
                                });
                            } else if (data.keterangan === true) {
                                Swal.fire(
                                    'Disimpan!',
                                    'Data berhasil disimpan.',
                                    'success'
                                )
                                $('#tambahgudangupt').modal('hide');
                                $('#gudangupt').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    'Data gagal disimpan.',
                                    'info'
                                )
                                $('#tambahgudangupt').modal('hide');
                                $('#gudangupt').DataTable().ajax.reload();
                            }
                        }
                    });
                }
            });
        });
        $('#btn-edit-simpan-data').click(function() {
            var IdGudangUpt = $('#IdGudangUptEdit').val();
            var IdObat = $('#IdObatEdit').val();
            var Dinkes = $('#DinkesEdit').val();
            var Blud = $('#BludEdit').val();
            var Tanggal = $('#TanggalEdit').val();
            $.ajax({
                url: '<?= base_url() ?>' + 'gudang/upt/editgudangupt',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    IdGudangUpt: IdGudangUpt,
                    IdObat: IdObat,
                    Dinkes: Dinkes,
                    Blud: Blud,
                    Tanggal: Tanggal
                },
                success: function(data) {
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
                            if (data.keterangan === 'kosong') {
                                const errors = data.error;
                                var html = '';
                                errors.forEach((value, index) => {
                                    html += value;
                                })
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Data tidak lengkap!',
                                    html: '<div class="text-danger">' + html + '</div>'
                                })
                            } else if (data.keterangan === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil diedit!',
                                })
                                $('#editgudangupt').modal('hide');
                                $('#gudangupt').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Data gagal diedit!',
                                    text: 'format data tidak benar atau tidak tersimpan didatabase'
                                })
                                $('#gudangupt').DataTable().ajax.reload();
                            }
                        }
                    });
                }

            })
        });

        $('.applyBtn').click(() => {
            var dateValue = $('.drp-selected')[0].innerText;
            $('#gudangupt').data('dt_params', {
                filterDate: filteredbydate(dateValue)
            });
            tables.draw();
        })

        $('#btn-reset-filter').click(()=>{
            $('#gudangupt').data('dt_params', {
                filterDate: null
            });
            tables.draw();
        })

    });

    function filteredbydate(dateValue) {
        if (dateValue != undefined) {
            var split = dateValue.split('-');
            var tanggalAwal = formatdate(split[0]);
            var tanggalAkhir = formatdate(split[1]);
            var date = [tanggalAwal, tanggalAkhir];
            return date;
        } else {
            return null;
        }
        return date;
    }

    function formatdate(date) {
        var mentah = date.split('/');
        var dateReady = mentah[2] + '/' + mentah[0] + '/' + mentah[1];
        return dateReady.replace(/\s/g, '');
    }

    function edit(dataedit) {
        $('#editgudangupt').modal('show');
        getDataEdit($(dataedit).attr('IdGudangUpt'))
    }

    function getDataEdit(IdGudangUpt) {
        $.ajax({
            url: '<?= base_url() ?>' + 'gudang/upt/jsonGetGudangUpt/' + IdGudangUpt,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#IdGudangUptEdit').val(data[0].IdGudangUpt);
                $('#IdObatEdit').val(data[0].NamaObat);
                $('#DinkesEdit').val(data[0].Dinkes);
                $('#BludEdit').val(data[0].Blud);
                $('#TanggalEdit').val(data[0].Tanggal);
                var option = new Option(data[0].NamaObat, data[0].IdObat, true, true);
                selectIdObatEdit.append(option).trigger('change');
                selectIdObatEdit.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            }
        })
    }

    function hapus(datahapus) {
        var IdGudangUpt = $(datahapus).attr('IdGudangUpt');
        Swal.fire({
            title: 'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Batalkan',
            confirmButtonText: 'Ya, Hapus!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>' + 'gudang/upt/hapusgudangupt',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        IdGudangUpt: IdGudangUpt
                    },
                    success: function(data) {
                        if (data === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil dihapus',
                            })
                            $('#gudangupt').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data gagal dihapus',
                            })
                        }
                    }
                })
            }
        })
    }
</script>