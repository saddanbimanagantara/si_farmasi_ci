<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_upt extends CI_Model
{
    var $table = 'gudangupt';
    var $column_order = array('gudangupt.IdGudangUpt', 'obat.NamaObat', 'gudangupt.Dinkes', 'gudangupt.Blud', 'gudangupt.Tanggal');
    var $column_search = array('gudangupt.IdGudangUpt', 'obat.NamaObat', 'gudangupt.Dinkes', 'gudangupt.Blud', 'gudangupt.Tanggal');
    var $order = array('IdGudangUpt', 'asc');

    function _getdatatable_query()
    {
        $this->db->select('obat.NamaObat,gudangupt.*');
        $this->db->from('gudangupt');
        $this->db->join('obat', 'obat.IdObat=gudangupt.IdObat');
        $i = 0;
        foreach ($this->column_search as $item) {
            if (@$_POST['search']['value']) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        if($_POST['filterDate'] != null){
            $tanggalMentah = $_POST['filterDate'];
            $dateFilter = explode(',', $tanggalMentah);
            $this->db->where('gudangupt.Tanggal BETWEEN "'.$dateFilter[0].'" AND "'.$dateFilter[1].'"');
        }
    }

    function _getdatatableupt()
    {
        $this->_getdatatable_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function countFiltered()
    {
        $this->_getdatatable_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function countAll()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function getGudangUpt($IdGudangUpt = ''){
        if($IdGudangUpt == ''){
            return $this->db->get('gudangupt')->result();
        }else{
            return $this->db->where('IdGudangUpt', $IdGudangUpt)->from('gudangupt')->join('obat', 'gudangupt.IdObat=obat.IdObat')->get()->result();
        }
    }

    function dataobat()
    {
        $searchTerm = $this->input->get('searchTerm');
        if ($searchTerm == '') {
            $data = $this->db->get('obat')->result();
            return $data;
        } else {
            $this->db->select('*');
            $this->db->from('obat');
            $this->db->like('NamaObat', $searchTerm);
            $data =  $this->db->get()->result();
            return $data;
        }
    }

    function validationTambahGudangUpt($data)
    {
        $this->db->where('IdObat', $data['IdObat']);
        $this->db->where('Tanggal', $data['Tanggal']);
        $query = $this->db->get('gudangupt');
        return $query->num_rows();
    }

    function tambahGudangUpt($data)
    {
        if ($this->validationTambahGudangUpt($data) == 0) {
            $this->db->insert('gudangupt', $data);
            return true;
        } else {
            return false;
        }
    }

    function editgudangupt($data, $IdGudangUpt)
    {
        $this->db->where('IdGudangUpt', $IdGudangUpt);
        $this->db->update('gudangupt', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    function hapusgudangupt($IdGudangUpt)
    {
        $this->db->where('IdGudangUpt', $IdGudangUpt);
        $this->db->delete('gudangupt');
        return $this->db->affected_rows() > 0 ? true : false;
    }

    var $tableobat = 'obat';
    var $column_orderLaporan = array('gudangupt.IdGudangUpt', 'obat.NamaObat', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'TotalMasuk');
    var $column_searchLaporan = array('gudangupt.IdGudangUpt', 'obat.NamaObat', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember', 'TotalMasuk');
    var $orderLaporan = array('IdGudangUpt', 'asc');

    function getLaporanQuery($Tahun, $Jenis){
        if($Tahun){
            $this->db->select('obat.NamaObat,
            SUM(IF(MONTH(gudangupt.Tanggal) = 1, gudangupt.'.$Jenis.', 0)) AS Januari,
            SUM(IF(MONTH(gudangupt.Tanggal) = 2, gudangupt.'.$Jenis.', 0)) AS Februari,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Maret,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS April,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Mei,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Juni,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Juli,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Agustus,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS September,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Oktober,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS November,
            SUM(IF(MONTH(gudangupt.Tanggal) = 12, gudangupt.'.$Jenis.', 0)) AS Desember,
            SUM(gudangupt.Dinkes) as Total');
            $this->db->from($this->table);
            $this->db->join($this->tableobat, 'gudangupt.IdObat=obat.IdObat and YEAR(gudangupt.Tanggal) = '.$Tahun.'', 'RIGHT');
            $this->db->group_by('obat.IdObat');
        }else{
            $Jenis = 'Dinkes';
            $this->db->select('obat.NamaObat,
            SUM(IF(MONTH(gudangupt.Tanggal) = 1, gudangupt.'.$Jenis.', 0)) AS Januari,
            SUM(IF(MONTH(gudangupt.Tanggal) = 2, gudangupt.'.$Jenis.', 0)) AS Februari,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Maret,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS April,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Mei,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Juni,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Juli,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Agustus,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS September,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS Oktober,
            SUM(IF(MONTH(gudangupt.Tanggal) = 3, gudangupt.'.$Jenis.', 0)) AS November,
            SUM(IF(MONTH(gudangupt.Tanggal) = 12, gudangupt.'.$Jenis.', 0)) AS Desember,
            SUM(gudangupt.Dinkes) as Total');
            $this->db->from($this->table);
            $this->db->join($this->tableobat, 'gudangupt.IdObat=obat.IdObat', 'RIGHT');
            $this->db->group_by('obat.IdObat');
        }
    }

    function _getLaporan($Tahun, $Jenis)
    {
        $this->getLaporanQuery($Tahun, $Jenis);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function countFilteredLaporan($Tahun, $Jenis)
    {
        $this->getLaporanQuery($Tahun, $Jenis);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function countAllLaporan()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

}
