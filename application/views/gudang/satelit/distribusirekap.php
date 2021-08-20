<p class="text-danger">Secara Default filter mengarah pada seluruh tahun dan seluruh satelit, untuk filter gunakan filter dibawah:</p>
<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Filter Tahun:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="text" class="form-control" id="Tahun" autocomplete="off">
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Filter Satelit:</label>
            <select name="IdSatelit" id="IdSatelit" class="form-control">
            </select>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-secondary mb-2" id="btn-filter"><i class="fas fa-filter text-light mr-1"></i><span> filter</span></button>
<table id="tabelLaporan" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Januari</th>
            <th>Februari</th>
            <th>Maret</th>
            <th>April</th>
            <th>Mei</th>
            <th>Juni</th>
            <th>Juli</th>
            <th>Agustus</th>
            <th>September</th>
            <th>Oktober</th>
            <th>November</th>
            <th>Desember</th>
            <th>Total Distribusi</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


<!-- script -->
<script>
    var tabel;
    $(document).ready(function() {
        tabel = $('#tabelLaporan').DataTable({
            responsive: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: function() {
                        return 'Laporan Distribusi ke (' + $('#IdSatelit').text() + ' - ' + $('#Tahun').val() + ')';
                    },
                    className: 'btn-sm btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    title: function() {
                        if ($('#IdSatelit :selected').text() === '' && $('#Tahun').val() === '') {
                            var titledepan = 'Laporan Distribusi ke Seluruh Satelit Setiap Tahun';
                            return titledepan;
                        } else {
                            var titledepan = 'Laporan Distribusi ke';
                            var str = $('#IdSatelit :selected').text();
                            var satelit = str.trim();
                            var tahun = $('#Tahun').val();
                            return titledepan + ' ' + satelit + ' ' + tahun;
                        }
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    className: 'btn-sm btn-danger',
                    customize: function(doc) {
                        doc.content[1].margin = [100, 0, 100, 0] //left, top, right, bottom
                    }
                }
            ],
            ajax: {
                url: '<?= base_url() ?>' + 'gudang/satelit/jsondistribusirekap',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    Tahun: function() {
                        return $('#Tahun').val()
                    },
                    IdSatelit: function() {
                        return $('#IdSatelit').val()
                    }
                }
            },

        });

        $("#Tahun").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
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

        $('#btn-filter').click(() => {
            if ($('#Tahun').val() && $('#IdSatelit').val()) {
                Swal.fire({
                    icon: 'success',
                    title: 'filter berhasil diterapkan'
                })
                tabel.ajax.reload();

            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'filter tidak lengkap'
                })
            }
        })
    })
</script>