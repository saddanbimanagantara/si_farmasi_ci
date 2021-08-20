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
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
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
                            <label for="forTanggal">Bulan dan Tahun</label>
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
                        <blockquote class="quote-danger">
                            <span class="text-danger">Pastikan stok tersedia, jika tidak tersedia dan input lebih dari jumlah stok maka tidak bisa</span>
                        </blockquote>
                    </div>
                    <div class=" col-md-6 col-sm-12 col-xs-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Data</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Stok Penerimaan</td>
                                    <td><span class="badge bg-success" id="StokPenerimaan"></span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Stok Aktif <span style="font-size: 12px;">(sisa stok sebelumnya + stok penerimaan bulan dipilih)</span></td>
                                    <td><span class="badge bg-info" id="StokAktif"></span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Mutasi Keluar <p><small>(Mutasi Keluar Bulan Dipilih)</small></p></td>
                                    <td><span class="badge bg-danger" id="MutasiKeluar"></span></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Mutasi Rusak <p><small>(Mutasi Rusak Bulan Dipilih)</small></p></td>
                                    <td><span class="badge bg-danger" id="MutasiRusak"></span></td>
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Total Mutasi</td>
                                    <td><span class="badge bg-danger" id="SatelitPemakianBulanDipilih"></span></td>
                                </tr>
                                <tr>
                                    <td>6.</td>
                                    <td>Sisa Stok</td>
                                    <td><span class="badge bg-warning"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <hr>
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
            format: "mm-yyyy",
            startView: "months",
            minViewMode: "months"
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
                    console.log(data);
                    if (data.keterangan === 'requiredfalse') {
                        errorObat.innerHTML = data.error[0];
                        errorSatelit.innerHTML = data.error[1];
                        errorTanggal.innerHTML = data.error[2];
                    } else {
                        $('#StokPenerimaan').text(data.StokPenerimaan[0].StokPenerimaan);
                        $('#SatelitPemakianBulanDipilih').text(data.SatelitPemakianBulanDipilih[0].TotalMutasi);
                        $('#MutasiKeluar').text(data.SatelitPemakianBulanDipilih[0].MutasiKeluar);
                        $('#MutasiRusak').text(data.SatelitPemakianBulanDipilih[0].MutasiRusak);
                        // $('#stokgudangsatelit').text(data.StokGudangSatelit[0].Jumlah - data.JumlahSemuaMutasiSatelit[0].SemuaMutasi);
                        // $('#mutasisatelit').text(data.MutasiSatelit[0].Mutasi);
                        // $('#sisastok').text(data.StokGudangSatelit[0].Jumlah - data.MutasiSatelit[0].Mutasi);
                    }
                }
            });
            errorObat.innerHTML = ' ';
            errorSatelit.innerHTML = ' ';
            errorTanggal.innerHTML = ' ';
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