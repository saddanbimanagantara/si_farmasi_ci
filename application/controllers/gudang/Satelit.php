<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satelit extends CI_Controller
{
    function distribusi()
    {
        $data = array(
            'title' => 'Data Gudang Distribusi ke Satelit',
            'titledashboard' => 'Data Gudang Distribusi ke Satelit'
        );
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('gudang/satelit/distribusi', $data);
        $this->load->view('_layout/footer', $data);
    }

    function jsongudangsatelit()
    {
        $list = $this->m_satelit->_getgudangsatelit();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->NamaObat;
            $row[] = $item->Jumlah;
            $row[] = $item->Tanggal;
            $row[] = $item->NamaSatelit;
            $row[] = '<button class="btn btn-sm btn-primary" onclick="edit(this)"  IdGudangSatelit="' . $item->IdGudangSatelit . '" style="margin: 1px"><i class="fas fa-edit"></i></button><button class="btn btn-sm btn-danger" onclick="hapus(this)" IdGudangSatelit="' . $item->IdGudangSatelit . '" style="margin:1px"><i class="fas fa-trash-alt"></i></button>';
            $data[] = $row;
        }
        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_satelit->countAll(),
            'recordsFiltered'   => $this->m_satelit->countFiltered(),
            'data'              => $data
        );

        echo json_encode($result);
    }

    function getData($IdGudangSatelit)
    {
        $data = $this->m_satelit->getData($IdGudangSatelit);
        echo json_encode($data);
    }

    function getDataObat()
    {
        $data = $this->m_satelit->dataobat();
        echo json_encode($data);
    }

    function getDataSatelit()
    {
        $data = $this->m_satelit->datasatelit();
        echo json_encode($data);
    }

    function tambahdatadistri()
    {
        // validation 
        $this->form_validation->set_rules('IdObat', 'Obat', 'required');
        $this->form_validation->set_rules('Jumlah', 'Jumlah Distribusi', 'required');
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('IdSatelit', 'Satelit', 'required');
        $this->form_validation->set_message('required', 'Data %s Wajib di isi!');

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'data'          => array(
                    'IdObat'    => $this->input->post('IdObat'),
                    'Jumlah'    => $this->input->post('Jumlah'),
                    'Tanggal'   => $this->input->post('Tanggal'),
                    'IdSatelit' => $this->input->post('IdSatelit')
                ),
                'dataerror'     => array(form_error('IdObat'), form_error('Jumlah'), form_error('Tanggal'), form_error('IdSatelit')),
                'keterangan'    => 'errordata'

            );
            echo json_encode($datakembali);
        } else {
            $data = array(
                'IdObat'        => $this->input->post('IdObat'),
                'Jumlah'        => $this->input->post('Jumlah'),
                'Tanggal'       => $this->input->post('Tanggal'),
                'IdSatelit'     => $this->input->post('IdSatelit')
            );

            $resulttambahdatadistri = $this->m_satelit->tambahdatadistri($data);

            $datakembali = array(
                'data'          => $data,
                'keterangan'    => $resulttambahdatadistri
            );

            echo json_encode($datakembali);
        }
    }

    function editdatadistri()
    {
        // validation 
        $this->form_validation->set_rules('IdObatEdit', 'Obat', 'required');
        $this->form_validation->set_rules('JumlahEdit', 'Jumlah', 'required');
        $this->form_validation->set_rules('TanggalEdit', 'Tanggal', 'required');
        $this->form_validation->set_rules('IdSatelitEdit', 'Satelit', 'required');

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'data'          => array(
                    'IdObat'    => $this->input->post('IdObatEdit'),
                    'Jumlah'    => $this->input->post('JumlahEdit'),
                    'Tanggal'   => $this->input->post('TanggalEdit'),
                    'IdSatelit' => $this->input->post('IdSatelitEdit')
                ),
                'dataerror'     => array(form_error('IdObatEdit'), form_error('JumlahEdit'), form_error('TanggalEdit'), form_error('IdSatelitEdit')),
                'keterangan'    => 'required'

            );
            echo json_encode($datakembali);
        } else {
            $IdGudangSatelit = $this->input->post('IdGudangSatelitEdit');
            $data = array(
                'IdObat'        => $this->input->post('IdObatEdit'),
                'Jumlah'        => $this->input->post('JumlahEdit'),
                'Tanggal'       => $this->input->post('TanggalEdit'),
                'IdSatelit'     => $this->input->post('IdSatelitEdit')
            );

            $resulteditdatadistri = $this->m_satelit->editdatadistri($data, $IdGudangSatelit);

            $datakembali = array(
                'data'          => $data,
                'keterangan'    => $resulteditdatadistri
            );

            echo json_encode($datakembali);
        }
    }

    function hapusdatadistri($IdGudangSatelit)
    {
        $resulthapusdatadistri = $this->m_satelit->hapusdatadistri($IdGudangSatelit);
        echo json_encode($resulthapusdatadistri);
    }

    function distribusirekap()
    {
        $data = array(
            'title'     => 'Gudang Distribusi Satelit Rekap',
            'titledashboard' => 'Gudang Distribusi Satelit Rekap'
        );

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('gudang/satelit/distribusirekap', $data);
        $this->load->view('_layout/footer', $data);
    }

    function jsondistribusirekap()
    {
        $list = $this->m_satelit->_getdistrirekap();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $item->NamaObat;
            $row[] = $item->Januari;
            $row[] = $item->Februari;
            $row[] = $item->Maret;
            $row[] = $item->April;
            $row[] = $item->Mei;
            $row[] = $item->Juni;
            $row[] = $item->Juli;
            $row[] = $item->Agustus;
            $row[] = $item->September;
            $row[] = $item->Oktober;
            $row[] = $item->November;
            $row[] = $item->Desember;
            if ($item->TotalDistribusi === null) {
                $row[] = 0;
            } else {
                $row[] = $item->TotalDistribusi;
            }
            $data[] = $row;
        }

        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_satelit->countAllDistri(),
            'recordsFiltered'   => $this->m_satelit->countFilteredDistri(),
            'data'              => $data
        );

        echo json_encode($result);
    }

    function transaksi()
    {
        $data = array(
            'title'             => 'Data Transaksi Satelit',
            'titledashboard'    => 'Data Transaksi Satelit'
        );

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('gudang/satelit/transaksi', $data);
        $this->load->view('_layout/footer', $data);
    }

    function jsonsatelitmutasi()
    {
        $list = $this->m_satelit->_getsatelitmutasi();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $item->NamaObat;
            $row[] = $item->Tanggal;
            $row[] = $item->MutasiKeluar;
            $row[] = $item->MutasiRusak;
            $row[] = $item->NamaSatelit;
            $row[] = "<button class='btn btn-sm btn-primary m-1' onclick='edit(this)' IdTransaksiSatelit='$item->IdTransaksiSatelit'><i class='fas fa-edit'></i></button><button class='btn btn-sm btn-danger m-1' onclick='hapus(this)' IdTransaksiSatelit='$item->IdTransaksiSatelit'><i class='fas fa-trash-alt'></i></button>";
            $data[] = $row;
        }

        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_satelit->countAllSatelitMutasi(),
            'recordsFiltered'   => $this->m_satelit->countFilteredSatelitMutasi(),
            'data'              => $data
        );

        echo json_encode($result);
    }

    function getStok()
    {
        $IdObat = @$_POST['IdObat'];
        $IdSatelit = @$_POST['IdSatelit'];
        $Tanggal = @$_POST['Tanggal'];

        //form validation
        $this->form_validation->set_rules('IdObat', 'Obat', 'required');
        $this->form_validation->set_rules('IdSatelit', 'Satelit', 'required');
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
        $this->form_validation->set_message('required', 'Data %s harus diisi!');

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'keterangan' => 'requiredfalse', 
                'error' => array(
                    form_error('IdObat'), 
                    form_error('IdSatelit'), 
                    form_error('Tanggal'))
            );
        } else {
            $stokPenerimaan = $this->m_satelit->StokPenerimaan($IdObat, $IdSatelit, $Tanggal);
            $stokPemakaian = $this->m_satelit->StokPemakaian($IdObat, $IdSatelit, $Tanggal);
            // $StokAktif = $this->m_satelit->StokAktif($IdObat, $IdSatelit, $Tanggal);
            // $StokPenerimaan  = $this->m_satelit->StokPenerimaan($IdObat, $IdSatelit, $Tanggal);
            // $Pemakian = $this->m_satelit->Pemakian($IdObat, $IdSatelit, $Tanggal);
            // $PemakianSekarang = $this->m_satelit->PemakianSekarang($IdObat, $IdSatelit, $Tanggal);
            // $eTanggal = explode('-', $Tanggal);
            // if($eTanggal[0] === '01'){
            //     $datakembali = array(
            //         'keterangan'                    => 'sukses', 
            //         'StokAktif'                     => 0,
            //         'StokPenerimaan'                => $StokPenerimaan[0]->StokPenerimaan,
            //         'Pemakian'                      => $Pemakian[0]->TotalMutasi,
            //         'PemakianSekarang'              => $PemakianSekarang[0]->TotalMutasi,
            //         'SisaStok'                      => $StokAktif[0]->Jumlah - $Pemakian[0]->TotalMutasi
            //     );
            // }else{
            //     $datakembali = array(
            //         'keterangan'                    => 'sukses', 
            //         'StokAktif'                     => ($StokAktif[0]->Jumlah-$StokPenerimaan[0]->StokPenerimaan) - $Pemakian[0]->TotalMutasi,
            //         'StokPenerimaan'                => $StokPenerimaan[0]->StokPenerimaan,
            //         'Pemakian'                      => $Pemakian[0]->TotalMutasi,
            //         'PemakianSekarang'              => $PemakianSekarang[0]->TotalMutasi,
            //         'SisaStok'                      => ($StokAktif[0]->Jumlah - $Pemakian[0]->TotalMutasi)-$PemakianSekarang[0]->TotalMutasi
            //     );
            // }
            $datakembali = array(
                'stokPenerimaan'   => $stokPenerimaan[0]->Penerimaan,
                'stokPemakaian'     => $stokPemakaian[0]->MutasiKeluar + $stokPemakaian[0]->MutasiRusak,
                'sisaStok'          => $stokPenerimaan[0]->Penerimaan - ($stokPemakaian[0]->MutasiKeluar + $stokPemakaian[0]->MutasiRusak)
            );
        }
        echo json_encode($datakembali);
    }

    function tambahtransaksi(){
        $this->form_validation->set_rules('IdObat', 'obat', 'required');
        $this->form_validation->set_rules('IdSatelit', 'Satelit', 'required');
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('MutasiKeluar', 'Mutasi Keluar', 'required');
        $this->form_validation->set_rules('mutasiRusak', 'Mutasi Rusak', 'required');
        $this->form_validation->set_message('required', 'Data %s harus di isi!');
        if($this->form_validation->run() == false){
            $datakembali = array(
                'keterangan'    => 'requiredfalse',
                'data'          => array(
                    form_error('IdObat'), form_error('IdSatelit'), form_error('Tanggal'), form_error('MutasiKeluar'), form_error('MutasiRusak')
                )
            );
            echo json_encode($datakembali);
        }else{
            $sisaStok = $_POST['sisaStok'];
            $MutasiKeluar = $_POST['MutasiKeluar'];
            $MutasiRusak = $_POST['mutasiRusak'];
            $TanggalFilter = explode('-', $_POST['TanggalFilter']);

            // check tanggal jika bulan = januari
            $tanggalFilter = $_POST['TanggalFilter'];
            $startDate = ($tanggalFilter-1) .'/'. 12 .'/'. 26;
            $endDate = $tanggalFilter .'/'. 12 .'/'. 25;
            $tanggalPilih = $_POST['Tanggal'];
            $ValidationDate = $this->check_in_range($startDate, $endDate, $tanggalPilih);
            
            if(($sisaStok - ($MutasiKeluar + $MutasiRusak)) < 0){
                $datakembali = array(
                    'keterangan'    => 'dataterlalubanyak',
                );
                echo json_encode($datakembali);
            }else if($ValidationDate === true){
                $data = array(
                    'IdTransaksiSatelit'    => '',
                    'MutasiKeluar'          => $_POST['MutasiKeluar'],
                    'MutasiRusak'           => $_POST['mutasiRusak'],
                    'Tanggal'               => $_POST['Tanggal'],
                    'IdSatelit'             => $_POST['IdSatelit'],
                    'IdObat'                => $_POST['IdObat']
                );
                $datadb = $this->m_satelit->tambahtransaksi($data);
                $datakembali = array(
                    'keterangan'    => $datadb,
                    'data'          => $data,
                );
                echo json_encode($datakembali);
            }else{
                $datakembali = array(
                    'keterangan'    => false
                );
                echo json_encode($ValidationDate);
            }
        }
    }

    function check_in_range($start_date, $end_date, $date_from_user) {
        // Convert to timestamp
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        $check = strtotime($date_from_user);
        // Check that user date is between start & end
        return (($start <= $check ) && ($check <= $end));
    }

}
