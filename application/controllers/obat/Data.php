<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function index()
    {
        $data = array(
            'title'             => 'Data Obat',
            'titledashboard'    => 'Data Obat'
        );
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('obat/dashboard', $data);
        $this->load->view('_layout/footer', $data);
    }
    function jsonobat()
    {
        $list = $this->m_obat->_getdatatableobat();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->NamaObat;
            $row[] = $item->SatuanObat;
            $row[] = $item->HargaObat;
            $row[] = "<button type='button' class='btn btn-sm btn-info m-1'  onClick='edit(this)' IdObat='" . $item->IdObat . "'><i class='fas fa-edit'></i></button><button type='button' class='btn btn-sm btn-danger m-1'  onClick='hapus(this)' IdObat='" . $item->IdObat . "'><i class='fas fa-trash'></i></button>";
            $data[] = $row;
        }
        $result = array(
            'draw'              => @$_POST['draw'],
            'recordsTotal'      => $this->m_obat->count_all(),
            'recordsFiltered'   => $this->m_obat->count_filtered(),
            'data'              => $data
        );
        echo json_encode($result);
    }

    function jsonobatbyid($IdObat)
    {
        $data = $this->m_obat->dataobat($IdObat);
        echo json_encode($data);
    }

    function tambahobat()
    {
        $this->form_validation->set_rules('NamaObat', 'Nama', 'required');
        $this->form_validation->set_rules('SatuanObat', 'Satuan', 'required');
        $this->form_validation->set_rules('HargaObat', 'Harga', 'required');
        $this->form_validation->set_message('required', 'Data %s wajib di isi!');
        $data = array(
            'IdObat'            => '',
            'NamaObat'          => $_POST['NamaObat'],
            'SatuanObat'        => $_POST['SatuanObat'],
            'HargaObat'         => $_POST['HargaObat']
        );

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'keterangan'    => 'Gagal',
                'data'          => $data,
                'error'         => array(
                    form_error('NamaObat'), form_error('SatuanObat'), form_error('HargaObat')
                ),
            );
            echo json_encode($datakembali);
        } else {
            $eksekusi = $this->m_obat->tambahobat($data);
            $datakembali = array(
                'keterangan'    => $eksekusi,
                'data'          => $data
            );
            echo json_encode($datakembali);
        }
    }

    function editobat()
    {
        $this->form_validation->set_rules('NamaObat', 'Nama', 'required');
        $this->form_validation->set_rules('SatuanObat', 'Satuan', 'required');
        $this->form_validation->set_rules('HargaObat', 'Harga', 'required');
        $this->form_validation->set_message('required', 'Data %s wajib di isi!');

        $IdObat = $_POST['IdObat'];
        $data = array(
            'NamaObat'          => $_POST['NamaObat'],
            'SatuanObat'        => $_POST['SatuanObat'],
            'HargaObat'         => $_POST['HargaObat']
        );

        if ($this->form_validation->run() == false) {
            $datakembali = array(
                'keterangan'    => 'gagal',
                'IdObat'        => $IdObat,
                'data'          => $data,
                'error'         => array(
                    form_error('NamaObat'), form_error('SatuanObat'), form_error('HargaObat')
                )
            );
            echo json_encode($datakembali);
        }else{
            $eksekusi = $this->m_obat->editobat($IdObat, $data);
            $datakembali = array(
                'keterangan'    => $eksekusi,
                'data'          => $data,
            );
            echo json_encode($datakembali);
        }
    }

    function hapusobat(){
        $eksekusi = $this->m_obat->hapusobat($_POST['IdObat']);
        echo json_encode($eksekusi);
    }
}
