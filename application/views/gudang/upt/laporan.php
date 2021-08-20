<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Filter Tahun:</label>
            <div class="input-group education-range">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input type="text" class="form-control float-right" id="Tahun" name="Tahun" placeholder="Masukan Tahun..." required>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="form-group">
            <label>Filter Jenis:</label>
            <div class="input-group education-range">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <select name="Jenis" id="Jenis" class="form-control">
                    <option value="Dinkes">Dinkes</option>
                    <option value="Blud">Blud</option>
                </select>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-sm btn-secondary mb-2" id="btn-filter"><i class="fas fa-filter text-light mr-1"></i><span> filter</span></button>
<table id="tabelLaporan" class="table table-bordered table-hover" style="display: none;">
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
            <th>Total Masuk</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>No</td>
            <td>Nama Obat</td>
            <td>Januari</td>
            <td>Februari</td>
            <td>Maret</td>
            <td>April</td>
            <td>Mei</td>
            <td>Juni</td>
            <td>Juli</td>
            <td>Agustus</td>
            <td>September</td>
            <td>Oktober</td>
            <td>November</td>
            <td>Desember</td>
            <td>Total Masuk</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Obat</td>
            <td>Januari</td>
            <td>Februari</td>
            <td>Maret</td>
            <td>April</td>
            <td>Mei</td>
            <td>Juni</td>
            <td>Juli</td>
            <td>Agustus</td>
            <td>September</td>
            <td>Oktober</td>
            <td>November</td>
            <td>Desember</td>
            <td>Total Masuk</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Obat</td>
            <td>Januari</td>
            <td>Februari</td>
            <td>Maret</td>
            <td>April</td>
            <td>Mei</td>
            <td>Juni</td>
            <td>Juli</td>
            <td>Agustus</td>
            <td>September</td>
            <td>Oktober</td>
            <td>November</td>
            <td>Desember</td>
            <td>Total Masuk</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Obat</td>
            <td>Januari</td>
            <td>Februari</td>
            <td>Maret</td>
            <td>April</td>
            <td>Mei</td>
            <td>Juni</td>
            <td>Juli</td>
            <td>Agustus</td>
            <td>September</td>
            <td>Oktober</td>
            <td>November</td>
            <td>Desember</td>
            <td>Total Masuk</td>
        </tr>
        <tr>
            <td>No</td>
            <td>Nama Obat</td>
            <td>Januari</td>
            <td>Februari</td>
            <td>Maret</td>
            <td>April</td>
            <td>Mei</td>
            <td>Juni</td>
            <td>Juli</td>
            <td>Agustus</td>
            <td>September</td>
            <td>Oktober</td>
            <td>November</td>
            <td>Desember</td>
            <td>Total Masuk</td>
        </tr>
    </tbody>
</table>
<script>
    $(document).ready(() => {
        $('#btn-filter').click(() => {
            if ($('#Tahun').val() && $('#Jenis').val()) {
                $('#tabelLaporan').css('display', '');
                tabel.ajax.reload();
                Swal.fire({
                    icon: 'success',
                    title: 'filter berhasil diterapkan!'
                })
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'filter tidak lengkap'
                })
            }
        })

        tabel = $('#tabelLaporan').DataTable({
            responsive: true,
            autoWidth: false,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    title: function(){
                        return 'Laporan Gudang UPT (' +$('#Jenis').val()+ ' - ' +$('#Tahun').val()+')';
                    },
                    className: 'btn-sm btn-success'
                },
                {
                    extend: 'pdfHtml5',
                    title: function(){
                        return 'Laporan Gudang UPT ' +$('#Jenis').val()+ ' - ' +$('#Tahun').val();
                    },
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    className: 'btn-sm btn-danger'
                }
            ],
            ajax: {
                url: '<?= base_url() ?>' + 'gudang/upt/getLaporan',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    Tahun: function() {
                        return $('#Tahun').val()
                    },
                    Jenis: function() {
                        return $('#Jenis').val()
                    }
                }
            }
        });

        $("#Tahun").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

    })
</script>