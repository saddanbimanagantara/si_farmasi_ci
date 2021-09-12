<div class="d-flex align-items-center justify-content-between mb-2">
    <div class="form-group">
        <label>Filter Tanggal:</label>

        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="text" class="form-control" id="Tahun" autocomplete="off">
        </div>
        <button class="btn btn-sm btn-danger mt-2" id="btn-reset-filter"><i class="fas fa-filter text-light mr-1"></i><span>reset filter</span></button>
    </div>
    <div class="button-add">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahtransaksi">
            <i class="fas fa-plus"></i>
        </button>
        <a href="<?= base_url() ?>gudang/satelit/distribusirekap" class="btn btn-sm btn-success"><i class="fas fa-file mr-1"></i></i><span>Laporan</span></a>
    </div>
</div>
<table id="satelitmutasi" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Tanggal</th>
            <th>Mutasi Keluar</th>
            <th>Mutasi Rusak</th>
            <th>Satelit</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

<!-- modal tambah transkasi -->
<div class="modal fade bd-example-modal-lg" id="tambahtransaksi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Transaksi Satelit</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="ture">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <blockquote class="quote-danger">
                    <small class="text-danger">Pastikan stok tersedia, jika tidak tersedia dan input lebih dari jumlah stok maka tidak bisa</small>
                </blockquote>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nama Obat</label>
                            <select class="form-control" id="IdObat" name="IdObat" style="width: 100%;">
                            </select>
                            <div id="errorobat" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label>Satelit</label>
                            <select class="form-control" id="IdSatelit" name="IdSatelit" style="width: 100%;">
                            </select>
                            <div id="errorsatelit" class="text-danger"></div>
                        </div>
                        <div class="form-group">
                            <label for="forTanggal">Tahun</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="Tanggal" name="Tanggal">
                            </div>
                            <div id="errortanggal" class="text-danger"></div>
                        </div>
                        <button class="btn btn-sm btn-success" type="button" class="btn-cekstok" id="btn-cekstok">Cek Stok</button>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Data</th>
                                    <th style="width: 40px">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Penerimaan</td>
                                    <td><span class="badge bg-info" id="Penerimaan"></span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Pemakian</td>
                                    <td><span class="badge bg-success" id="Pemakaian"></span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Sisa Stok</td>
                                    <td><span class="badge bg-warning" id="SisaStok"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <hr>
                <div class="form-group">
                    <label for="forTanggal">Tanggal</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control" id="TanggalData" name="TanggalData">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forJumlahDistri">Mutasi Keluar</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" id="MutasiKeluar" name="MutasiKeluar">
                    </div>
                </div>
                <div class="form-group">
                    <label for="forMutasiRusak">Mutasi Rusak</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-sort-numeric-up-alt"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control" id="MutasiRusak" name="MutasiRusak">
                    </div>
                </div>
                <div id="warningcheck" class="text-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="SimpanData">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    var IdStok = [];
    $(document).ready(function() {

        $('#Tanggal').datepicker({
            format: "yyyy",
            startView: "years",
            minViewMode: "years"
        })
        tabels = $('#satelitmutasi').DataTable({
            autoWidth: false,
            responsive: true,
            ajax: {
                url: '<?= base_url() ?>' + 'gudang/satelit/jsonsatelitmutasi',
                type: 'GET',
                dataType: 'JSON'
            },
            columnDefs: [{
                targets: 6,
                className: 'text-center'
            }]
        });

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

        $('#IdObat').on('select2:select', function(e) {
            IdObat = e.params.data;
            IdStok[0] = IdObat['id'];
        });

        $('#IdSatelit').on('select2:select', function(e) {
            IdSatelit = e.params.data;
            IdStok[1] = IdSatelit['id'];
        });

        $('#btn-cekstok').click(function() {
            var errorObat = document.getElementById('errorobat');
            var errorSatelit = document.getElementById('errorsatelit');
            var errorTanggal = document.getElementById('errortanggal');
            $.ajax({
                url: '<?= base_url() ?>' + 'gudang/satelit/getStok',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    IdObat: IdStok[0],
                    IdSatelit: IdStok[1],
                    Tanggal: $('#Tanggal').val()
                },
                success: function(data) {
                    if (data.keterangan === 'requiredfalse') {
                        errorObat.innerHTML = data.error[0];
                        errorSatelit.innerHTML = data.error[1];
                        errorTanggal.innerHTML = data.error[2];
                    } else {
                        $('#Penerimaan').text((data.stokPenerimaan != null) ? data.stokPenerimaan : 0);
                        // $('#StokAktif').text((data.StokAktif != null) ? data.StokAktif : 0);
                        // $('#StokPenerimaan').text((data.StokPenerimaan != null) ? data.StokPenerimaan : 0);
                        $('#Pemakaian').text((data.stokPemakaian != null) ? data.stokPemakaian : 0);
                        $('#SisaStok').text((data.sisaStok != null) ? data.sisaStok : 0);
                    }
                }
            });
            errorObat.innerHTML = ' ';
            errorSatelit.innerHTML = ' ';
            errorTanggal.innerHTML = ' ';
        });

        $('#SimpanData').click(() => {
            Swal.fire({
                icon: 'warning',
                title : 'Apakah anda yakin?',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batalkan!', 
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url() ?>' + 'gudang/satelit/tambahtransaksi',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            IdObat: $('#IdObat').val(),
                            IdSatelit: $('#IdSatelit').val(),
                            TanggalFilter: $('#Tanggal').val(),
                            Tanggal: $('#TanggalData').val(),
                            MutasiKeluar: $('#MutasiKeluar').val(),
                            mutasiRusak: $('#MutasiRusak').val(),
                            sisaStok: $('#SisaStok').text()
                        },
                        success: function(data) {
                            if (data.keterangan === 'requiredfalse') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'data tidak lengkap!',
                                });
                            } else if (data.keterangan === 'dataterlalubanyak') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'data mutasi terlalu banyak!',
                                    text: 'Jumlah mutasi keluar atau mutasi rusak melebihi jumlah sisa stok!'
                                });
                                
                            } else if(data.keterangan === 'datamiss'){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Data tidak sinkron!',
                                    text: 'Data tidak sinkron karena tanggal yang dipilih tidak sesuai dengan stok yang dicek!'
                                });
                            } else if(data.keterangan === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'data berhasil disimpan!',
                                });
                                tabels.ajax.reload();
                                $('#tambahtransaksi').modal('hide');
                            }else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'data gagal disimpan!',
                                });
                                $('#tambahtransaksi').modal('hide');
                            }
                        }
                    })
                }
            });

        })
        $('body').on('hidden.bs.modal', '.modal', function() {
            $(this).removeData('bs.modal');
        });
    });



    //filter daterange
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