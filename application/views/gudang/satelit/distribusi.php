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
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahgudangsatelit">
            <i class="fas fa-plus"></i>
        </button>
        <a href="<?= base_url() ?>gudang/satelit/distribusirekap" class="btn btn-sm btn-success"><i class="fas fa-file mr-1"></i></i><span>Laporan</span></a>
    </div>
</div>
<table id="gudangsatelit" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Jumlah Distri</th>
            <th>Tanggal</th>
            <th>Satelit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- modal tambah -->
<div class="modal fade" id="tambahgudangsatelit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Distribusi Satelit</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="ture">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <select class="form-control" id="IdObat" name="IdObat" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="forJumlahDistri">Jumlah Distribusi</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" id="Jumlah" name="Jumlah">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forTanggal">Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control" id="Tanggal" name="Tanggal">
                    </div>
                </div>
                <div class="form-group">
                    <label>Satelit</label>
                    <select class="form-control" id="IdSatelit" name="IdSatelit" style="width: 100%;">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SimpanData">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal edit -->
<div class="modal fade" id="editgudangsatelit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Distribusi Satelit</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="ture">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Obat</label>
                    <input type="text" id="IdGudangSatelitEdit" name="IdGudangSatelitEdit" hidden>
                    <select class="form-control" id="IdObatEdit" name="IdObatEdit" style="width: 100%;">
                    </select>
                </div>
                <div class="form-group">
                    <label for="forJumlahDistri">Jumlah Distribusi</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" id="JumlahEdit" name="JumlahEdit">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forTanggal">Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control" id="TanggalEdit" name="TanggalEdit">
                    </div>
                </div>
                <div class="form-group">
                    <label>Satelit</label>
                    <select class="form-control" id="IdSatelitEdit" name="IdSatelitEdit" style="width: 100%;">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SimpanEdit">Simpan</button>
            </div>
        </div>
    </div>
</div>
<script>
    var selectIdObatEdit, selectIdSatelitEdit , tables;
    $(document).ready(function() {
        tables = $('#gudangsatelit').DataTable({
            autoWidth: false,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?= base_url() ?>' + 'gudang/satelit/jsongudangsatelit',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    filterDate: function(d) {
                        var dt_params = $('#gudangsatelit').data('dt_params');
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

        $('#SimpanData').click(function() {
            var IdObat = $('#IdObat').val();
            var Jumlah = $('#Jumlah').val();
            var Tanggal = $('#Tanggal').val();
            var IdSatelit = $('#IdSatelit').val();
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
                        url: '<?= base_url() ?>' + 'gudang/satelit/tambahdatadistri',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            IdObat: IdObat,
                            Jumlah: Jumlah,
                            Tanggal: Tanggal,
                            IdSatelit: IdSatelit
                        },
                        success: function(data) {
                            if (data.keterangan === 'errordata') {
                                const errors = data.dataerror;
                                var html = '';
                                errors.forEach((value, index) => {
                                    html += value;
                                })
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Data Tidak Lengkap!',
                                    html: '<div class="text-danger">' + html + '</div>'
                                });
                            } else if (data.keterangan === 'duplikasi') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Data Sudah Ada!',
                                    text: 'Silahkan cari dan edit!'
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil diSimpan!'
                                });
                                $('#gudangsatelit').DataTable().ajax.reload();
                                $('#tambahgudangsatelit').modal('hide');
                            }
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'dibatalkan',
                        text: 'data tidak jadi disimpan!'
                    });
                }
            });

        });

        $('#SimpanEdit').click(function() {
            var IdGudangSatelitEdit = $('#IdGudangSatelitEdit').val();
            var IdObatEdit = $('#IdObatEdit').val();
            var JumlahEdit = $('#JumlahEdit').val();
            var TanggalEdit = $('#TanggalEdit').val();
            var IdSatelitEdit = $('#IdSatelitEdit').val();

            Swal.fire({
                title: 'Apakah anda yakin?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Batalkan!',
                confirmButtonText: 'Ya, Edit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'gudang/satelit/editdatadistri',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            IdGudangSatelitEdit: IdGudangSatelitEdit,
                            IdObatEdit: IdObatEdit,
                            JumlahEdit: JumlahEdit,
                            TanggalEdit: TanggalEdit,
                            IdSatelitEdit: IdSatelitEdit
                        },
                        success: function(data) {
                            if (data.keterangan === 'required') {
                                const errors = data.dataerror;
                                var html = '';
                                errors.forEach((value, index) => {
                                    html += value;
                                });
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Data Tidak Lengkap',
                                    html: '<div class="text-danger">' + html + '</div>'
                                })
                            } else if (data.keterangan === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil diedit!'
                                });
                                $('#gudangsatelit').DataTable().ajax.reload();
                                $('#editgudangsatelit').modal('hide');
                            }
                        }
                    });
                }
            })
        });

        //filter daterange
        $('#filterdate').daterangepicker();
        $('.applyBtn').click(() => {
            var dateValue = $('.drp-selected')[0].innerText;
            $('#gudangsatelit').data('dt_params', {
                filterDate: filteredbydate(dateValue)
            });
            tables.draw();
        })

        $('#btn-reset-filter').click(() => {
            $('#gudangsatelit').data('dt_params', {
                filterDate: null
            });
            tables.draw();
        })
    });



    // tambah section
    $('#IdObat').select2({
        placeholder: 'Pilih data obat!',
        ajax: {
            url: '<?= base_url() ?>' + 'gudang/satelit/getDataObat',
            dataType: 'JSON',
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
    $('#IdSatelit').select2({
        placeholder: 'Pilih Satelit!',
        ajax: {
            url: '<?= base_url() ?>' + 'gudang/satelit/getDataSatelit',
            dataType: 'JSON',
            type: 'GET',
            delay: 300,
            data: function(params) {
                return {
                    searchTermSatelit: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.NamaSatelit,
                            id: item.IdSatelit
                        }
                    })
                }
            }
        }
    });

    // edit section
    function edit(dataedit) {
        $('#editgudangsatelit').modal('show');
        var IdGudangSatelit = $(dataedit).attr('IdGudangSatelit');
        getEditData(IdGudangSatelit);
    }

    function getEditData(IdGudangSatelit) {
        $.ajax({
            url: '<?= base_url() ?>' + 'gudang/satelit/getData/' + IdGudangSatelit,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#IdGudangSatelitEdit').val(data[0].IdGudangSatelit);
                $('#IdObatEdit').val(data[0].NamaObat);
                $('#JumlahEdit').val(data[0].Jumlah);
                $('#TanggalEdit').val(data[0].Tanggal);
                var option = new Option(data[0].NamaObat, data[0].IdObat, true, true);
                selectIdObatEdit.append(option).trigger('change');
                selectIdObatEdit.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
                var option2 = new Option(data[0].NamaSatelit, data[0].IdSatelit, true, true);
                selectIdSatelitEdit.append(option2).trigger('change');
                selectIdSatelitEdit.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                });
            }
        })
    }

    selectIdObatEdit = $('#IdObatEdit').select2({
        placeholder: 'Pilih data obat!',
        ajax: {
            url: '<?= base_url() ?>' + 'gudang/satelit/getDataObat',
            dataType: 'JSON',
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

    selectIdSatelitEdit = $('#IdSatelitEdit').select2({
        placeholder: 'Pilih Satelit!',
        ajax: {
            url: '<?= base_url() ?>' + 'gudang/satelit/getDataSatelit',
            dataType: 'JSON',
            type: 'GET',
            delay: 300,
            data: function(params) {
                return {
                    searchTermSatelit: params.term // search term
                };
            },
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.NamaSatelit,
                            id: item.IdSatelit
                        }
                    })
                }
            }
        }
    });

    // hapus section
    function hapus(datahapus) {
        var IdGudangSatelit = $(datahapus).attr('IdGudangSatelit');
        Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            showCancelButton: true,
            cancelButtonText: 'Batalkan!',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>' + 'gudang/satelit/hapusdatadistri/' + IdGudangSatelit,
                    type: 'DELETE',
                    dataType: 'JSON',
                    success: function(data) {
                        if (data === true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil diHapus'
                            });
                            $('#gudangsatelit').DataTable().ajax.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Data Gagal diHapus'
                            });
                        }
                    }
                })
            }
        })
    }

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
</script>