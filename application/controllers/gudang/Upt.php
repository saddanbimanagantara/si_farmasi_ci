<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upt extends CI_Controller
{
    function index()
    {
        $data = array(
            'title' => 'Gudang UPT',
            'titledashboard'    => 'Gudang UPT'
        );
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('gudang/upt/dashboard', $data);
        $this->load->view('_layout/footer', $data);
    }

    function jsongudangupt()
    {
        $list = $this->m_upt->_getdatatableupt();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->NamaObat;
            $row[] = $item->Dinkes;
            $row[] = $item->Blud;
            $row[] = $item->Tanggal;
            $row[] = "<button type='button' class='btn btn-sm btn-info m-1'  onClick='edit(this)' IdGudangUpt='" . $item->IdGudangUpt . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger m-1'  onClick='hapus(this)' IdGudangUpt='" . $item->IdGudangUpt . "'><i class='fas fa-trash'></i></button>";
            $data[] = $row;
        }

        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_upt->countAll(),
            'recordsFiltered'   => $this->m_upt->countFiltered(),
            'data'              => $data
        );

        echo json_encode($result);
    }

    function jsonGetGudangUpt($IdGudangUpt)
    {
        $data = $this->m_upt->getGudangUpt($IdGudangUpt);
        echo json_encode($data);
    }

    function jsondataobat()
    {
        $data = $this->m_upt->dataobat();
        echo json_encode($data);
    }

    function tambahgudangupt()
    {
        // validation
        $this->form_validation->set_rules('IdObat', 'Obat', 'required');
        $this->form_validation->set_rules('Dinkes', 'Dinkes', 'required');
        $this->form_validation->set_rules('Blud', 'Blud', 'required');
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
        $this->form_validation->set_message('required', 'Data %s Wajib');

        //data
        $data = array(
            'IdGudangUpt'   => '',
            'Dinkes'        => $_POST['Dinkes'],
            'Blud'          => $_POST['Blud'],
            'Tanggal'          => $_POST['Tanggal'],
            'IdObat'        => $_POST['IdObat']
        );

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'keterangan'    => 'kosong',
                'data'          => $data,
                'error'         => array(form_error('IdObat'), form_error('Dinkes'), form_error('Blud'), form_error('Tanggal'))
            );
            echo json_encode($datakembali);
        } else {
            $eksekusi = $this->m_upt->tambahgudangupt($data);
            $datakembali = array(
                'keterangan'    => $eksekusi,
                'data'          => $data
            );
            echo json_encode($datakembali);
        }
    }

    function editgudangupt()
    {
        // validation
        $this->form_validation->set_rules('IdGudangUpt', 'Obat', 'required');
        $this->form_validation->set_rules('IdObat', 'Obat', 'required');
        $this->form_validation->set_rules('Dinkes', 'Dinkes', 'required');
        $this->form_validation->set_rules('Blud', 'Blud', 'required');
        $this->form_validation->set_rules('Tanggal', 'Tanggal', 'required');
        $this->form_validation->set_message('required', 'Data %s Wajib');

        //data
        $data = array(
            'Dinkes'        => $_POST['Dinkes'],
            'Blud'          => $_POST['Blud'],
            'Tanggal'       => $_POST['Tanggal'],
            'IdObat'        => $_POST['IdObat']
        );

        $IdGudangUpt = $_POST['IdGudangUpt'];

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'keterangan'    => 'kosong',
                'data'          => $data,
                'error'         => array(form_error('IdObat'), form_error('Dinkes'), form_error('Blud'), form_error('Tanggal'))
            );
            echo json_encode($datakembali);
        } else {
            $eksekusi = $this->m_upt->editgudangupt($data, $IdGudangUpt);
            $datakembali = array(
                'keterangan'    => $eksekusi,
                'data'          => $data
            );
            echo json_encode($datakembali);
        }
    }

    function hapusgudangupt()
    {
        $IdGudangUpt = $_POST['IdGudangUpt'];
        $data = $this->m_upt->hapusgudangupt($IdGudangUpt);
        echo json_encode($data);
    }

    function laporan()
    {
        $data = array(
            'title' => 'Laporan Gudang UPT',
            'titledashboard'    => 'Laporan Gudang UPT'
        );
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('gudang/upt/laporan', $data);
        $this->load->view('_layout/footer', $data);
    }

    function getLaporan()
    {
        $Tahun = $_POST['Tahun'];
        $Jenis = $_POST['Jenis'];
        $list = $this->m_upt->_getLaporan($Tahun, $Jenis);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
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
            if($item->Total === null){
                $row[] = 0;
            }else{
                $row[] = $item->Total;
            }
            $data[] = $row;
        }

        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_upt->countAllLaporan(),
            'recordsFiltered'   => $this->m_upt->countFilteredLaporan($Tahun, $Jenis),
            'data'              => $data
        );

        echo json_encode($result);
    }
}
