<?php

class M_satelit extends CI_Model
{
    var $tabelGudangsatelit = 'gudangsatelit';
    var $tabelObat = 'obat';
    var $tabelSatelit = 'satelit';
    var $column_order = array('gudangsatelit.IdGudangSatelit', 'obat.NamaObat', 'gudangsatelit.Jumlah', 'gudangsatelit.Tanggal', 'satelit.NamaSatelit');
    var $column_search = array('gudangsatelit.IdGudangSatelit', 'obat.NamaObat', 'gudangsatelit.Jumlah', 'gudangsatelit.Tanggal', 'satelit.NamaSatelit');
    var $order = array('gudangsatelit.IdGudangSatelit' => 'asc');

    function _getquerygudangsatelit()
    {
        $this->db->select('obat.NamaObat, gudangsatelit.*, satelit.NamaSatelit');
        $this->db->from($this->tabelGudangsatelit);
        $this->db->join($this->tabelSatelit, $this->tabelGudangsatelit . '.IdSatelit=' . $this->tabelSatelit . '.IdSatelit');
        $this->db->join($this->tabelObat, $this->tabelGudangsatelit . '.IdObat=' . $this->tabelObat . '.IdObat');
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

        //filter range date 
        if ($_POST['filterDate'] != null) {
            $tanggalMentah = $_POST['filterDate'];
            $dateFilter = explode(',', $tanggalMentah);
            $this->db->where('gudangsatelit.Tanggal BETWEEN "' . $dateFilter[0] . '" AND "' . $dateFilter[1] . '"');
        }
    }

    function _getgudangsatelit()
    {
        $this->_getquerygudangsatelit();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function countFiltered()
    {
        $this->_getquerygudangsatelit();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAll()
    {
        $this->db->from($this->tabelGudangsatelit);
        return $this->db->count_all_results();
    }

    function getData($IdGudangSatelit = '')
    {
        if ($IdGudangSatelit == '') {
            $data = $this->db->get('gudangsatelit')->result();
            return $data;
        } else {
            $this->db->select('*');
            $this->db->where('IdGudangSatelit', $IdGudangSatelit);
            $this->db->from('gudangsatelit');
            $this->db->join('satelit', 'satelit.IdSatelit=gudangsatelit.IdSatelit');
            $this->db->join('obat', 'obat.IdObat=gudangsatelit.IdObat');
            $data =  $this->db->get()->result();
            return $data;
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

    function datasatelit()
    {
        $searchTermSatelit = $this->input->get('searchTermSatelit');
        if ($searchTermSatelit == '') {
            $data = $this->db->get('satelit')->result();
            return $data;
        } else {
            $this->db->select('*');
            $this->db->from('satelit');
            $this->db->like('NamaSatelit', $searchTermSatelit);
            $data =  $this->db->get()->result();
            return $data;
        }
    }

    function checkingtambahdatadistri($data)
    {
        $this->db->where('IdObat', $data['IdObat']);
        $this->db->where('Tanggal', $data['Tanggal']);
        $this->db->where('IdSatelit', $data['IdSatelit']);
        $query = $this->db->get('gudangsatelit');
        return $query->num_rows();
    }

    function tambahdatadistri($data)
    {
        if ($this->checkingtambahdatadistri($data) == 0) {
            $this->db->insert('gudangsatelit', $data);
            return $this->db->affected_rows() > 0 ? true : false;
        } else {
            return 'duplikasi';
        }
    }

    function editdatadistri($data, $IdGudangSatelit)
    {
        $this->db->where('IdGudangSatelit', $IdGudangSatelit);
        $this->db->update('gudangsatelit', $data);
        return $this->db->affected_rows() > 0 ? true : false;
    }

    function hapusdatadistri($IdGudangSatelit)
    {
        $this->db->where('IdGudangSatelit', $IdGudangSatelit);
        $this->db->delete('gudangsatelit');
        return $this->db->affected_rows() > 0 ? true : false;
    }

    var $column_orderdistrirekap = array('gudangsatelit.IdGudangSatelit', 'obat.NamaObat', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'oktober',  'November', 'Desember', 'TotalDistribusi');
    var $column_searchdistrirekap = array('gudangsatelit.IdGudangSatelit', 'obat.NamaObat', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'oktober', 'November', 'Desember', 'TotalDistribusi');
    var $orderdistrirekap = array('obat.IdObat' => 'ASC');

    function _querydistrirekap()
    {
        if (@$_POST['Tahun'] && @$_POST['IdSatelit']) {
            $this->db->select('obat.NamaObat, obat.IdObat,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . (($_POST['Tahun']) - 1) . '-12-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-1-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Januari,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-1-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-2-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Februari,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-2-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-3-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Maret,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-3-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-4-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS April,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-4-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-5-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Mei,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-5-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-6-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Juni,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-6-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-7-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Juli,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-7-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-8-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Agustus,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-8-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-9-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS September,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-9-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-10-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Oktober,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-10-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-11-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS November,
            SUM(CASE WHEN gudangsatelit.Tanggal >= "' . $_POST['Tahun'] . '-11-26" AND gudangsatelit.Tanggal <= "' . ($_POST['Tahun']) . '-12-25" THEN gudangsatelit.Jumlah ELSE 0 END) AS Desember,
            SUM(gudangsatelit.Jumlah) AS "TotalDistribusi"
            ');
            $this->db->from('gudangsatelit');
            $this->db->join('satelit', 'gudangsatelit.IdSatelit=satelit.IdSatelit AND satelit.IdSatelit=' . $_POST['IdSatelit']);
            $this->db->join('obat', 'gudangsatelit.IdObat=obat.IdObat', 'right');
            $this->db->group_by('obat.IdObat');
            $i = 0;
            foreach ($this->column_searchdistrirekap as $item) {
                if (@$_POST['search']['value']) {
                    if ($i == 0) {
                        $this->db->group_start();
                        $this->db->like($item, $_POST['search']['value']);
                    } else {
                        $this->db->or_like($item, $_POST['search']['value']);
                    }
                    if (count($this->column_searchdistrirekap) - 1 == $i) {
                        $this->db->group_end();
                    }
                }
                $i++;
            }
            if (isset($_POST['order'])) {
                $this->db->order_by($this->column_orderdistrirekap[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
            } else if (isset($this->orderdistrirekap)) {
                $order = $this->orderdistrirekap;
                $this->db->order_by(key($order), $order[key($order)]);
            }
        } else {
            $MinMaxYear = $this->getMinMaxYear();
            $StrMinYear = $MinMaxYear[0]['YearMin'];
            $StrMaxYear = $MinMaxYear[0]['YearMax'];
            $MinYear = explode('-', $StrMinYear);
            $MaxYear = explode('-', $StrMaxYear);
            $maxTahun = $MaxYear[0];
            $minTahun = $MinYear[0];
            $jarakTahun = $maxTahun - $minTahun;
            $i = 0;
            $strJanuari = "";
            $strSumJanuari = "";

            $strFebruari = "";
            $strSumFebruari = "";

            $strMaret = "";
            $strSumMaret = "";

            $strApril = "";
            $strSumApril = "";

            $strMei = "";
            $strSumMei = "";

            $strJuni = "";
            $strSumJuni = "";

            $strJuli = "";
            $strSumJuli = "";

            $strAgustus = "";
            $strSumAgustus = "";

            $strSeptember = "";
            $strSumSeptember = "";

            $strOktober = "";
            $strSumOktober = "";

            $strNovember = "";
            $strSumNovember = "";

            $strDesember = "";
            $strSumDesember = "";
            while ($i <= $jarakTahun) {
                //case januari
                $sumJanuari = 'i.Januari';
                if ($i == 0) {
                    $caseJanuari = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun - 1) . '-12-26" AND Tanggal <= "' . ($minTahun + $i) . '-1-25" THEN Jumlah ELSE 0 END) AS Januari' . ($minTahun + $i);
                } else {
                    $caseJanuari = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun - 1) + $i . '-12-26" AND Tanggal <= "' . ($minTahun + $i) . '-1-25" THEN Jumlah ELSE 0 END) AS Januari' . ($minTahun + $i);
                }
                $strSumJanuari .= $sumJanuari . ($minTahun + $i) . '+';
                $strJanuari .= $caseJanuari . ',';

                //case februari
                $sumFebruari = 'i.Februari';
                $caseFebruari = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-1-26" AND Tanggal <= "' . ($minTahun + $i) . '-2-25" THEN Jumlah ELSE 0 END) AS Februari' . ($minTahun + $i);
                $strSumFebruari .= $sumFebruari . ($minTahun + $i) . '+';
                $strFebruari .= $caseFebruari . ',';

                //case maret
                $sumMaret = 'i.Maret';
                $caseMaret = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-2-26" AND Tanggal <= "' . ($minTahun + $i) . '-3-25" THEN Jumlah ELSE 0 END) AS Maret' . ($minTahun + $i);
                $strSumMaret .= $sumMaret . ($minTahun + $i) . '+';
                $strMaret .= $caseMaret . ',';

                //case April
                $sumApril = 'i.April';
                $caseApril = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-3-26" AND Tanggal <= "' . ($minTahun + $i) . '-4-25" THEN Jumlah ELSE 0 END) AS April' . ($minTahun + $i);
                $strSumApril .= $sumApril . ($minTahun + $i) . '+';
                $strApril .= $caseApril . ',';

                //case Mei
                $sumMei = 'i.Mei';
                $caseMei = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-4-26" AND Tanggal <= "' . ($minTahun + $i) . '-5-25" THEN Jumlah ELSE 0 END) AS Mei' . ($minTahun + $i);
                $strSumMei .= $sumMei . ($minTahun + $i) . '+';
                $strMei .= $caseMei . ',';

                //case Juni
                $sumJuni = 'i.Juni';
                $caseJuni = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-5-26" AND Tanggal <= "' . ($minTahun + $i) . '-6-25" THEN Jumlah ELSE 0 END) AS Juni' . ($minTahun + $i);
                $strSumJuni .= $sumJuni . ($minTahun + $i) . '+';
                $strJuni .= $caseJuni . ',';

                //case Juli
                $sumJuli = 'i.Juli';
                $caseJuli = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-6-26" AND Tanggal <= "' . ($minTahun + $i) . '-7-25" THEN Jumlah ELSE 0 END) AS Juli' . ($minTahun + $i);
                $strSumJuli .= $sumJuli . ($minTahun + $i) . '+';
                $strJuli .= $caseJuli . ',';

                //case Agustus
                $sumAgustus = 'i.Agustus';
                $caseAgustus = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-7-26" AND Tanggal <= "' . ($minTahun + $i) . '-8-25" THEN Jumlah ELSE 0 END) AS Agustus' . ($minTahun + $i);
                $strSumAgustus .= $sumAgustus . ($minTahun + $i) . '+';
                $strAgustus .= $caseAgustus . ',';

                //case September
                $sumSeptember = 'i.September';
                $caseSeptember = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-8-26" AND Tanggal <= "' . ($minTahun + $i) . '-9-25" THEN Jumlah ELSE 0 END) AS September' . ($minTahun + $i);
                $strSumSeptember .= $sumSeptember . ($minTahun + $i) . '+';
                $strSeptember .= $caseSeptember . ',';

                //case Oktober
                $sumOktober = 'i.Oktober';
                $caseOktober = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-9-26" AND Tanggal <= "' . ($minTahun + $i) . '-10-25" THEN Jumlah ELSE 0 END) AS Oktober' . ($minTahun + $i);
                $strSumOktober .= $sumOktober . ($minTahun + $i) . '+';
                $strOktober .= $caseOktober . ',';

                //case November
                $sumNovember = 'i.November';
                $caseNovember = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-10-26" AND Tanggal <= "' . ($minTahun + $i) . '-11-25" THEN Jumlah ELSE 0 END) AS November' . ($minTahun + $i);
                $strSumNovember .= $sumNovember . ($minTahun + $i) . '+';
                $strNovember .= $caseNovember . ',';

                //case Desember
                $sumDesember = 'i.Desember';
                $caseDesember = 'SUM(CASE WHEN Tanggal >= "' . ($minTahun + $i) . '-11-26" AND Tanggal <= "' . ($minTahun + $i) . '-12-25" THEN Jumlah ELSE 0 END) AS Desember' . ($minTahun + $i);
                $strSumDesember .= $sumDesember . ($minTahun + $i) . '+';
                $strDesember .= $caseDesember . ',';
                $i++;
            }
            //data januari
            $strSumJanuari =  rtrim($strSumJanuari, "+");
            $strJanuari =  rtrim($strJanuari, ",");
            //data februari
            $strSumFebruari =  rtrim($strSumFebruari, "+");
            $strFebruari =  rtrim($strFebruari, ",");
            //data maret
            $strSumMaret =  rtrim($strSumMaret, "+");
            $strMaret =  rtrim($strMaret, ",");
            //data April
            $strSumApril =  rtrim($strSumApril, "+");
            $strApril =  rtrim($strApril, ",");
            //data Mei
            $strSumMei =  rtrim($strSumMei, "+");
            $strMei =  rtrim($strMei, ",");
            //data Juni
            $strSumJuni =  rtrim($strSumJuni, "+");
            $strJuni =  rtrim($strJuni, ",");
            //data Juli
            $strSumJuli =  rtrim($strSumJuli, "+");
            $strJuli =  rtrim($strJuli, ",");
            //data Agustus
            $strSumAgustus =  rtrim($strSumAgustus, "+");
            $strAgustus =  rtrim($strAgustus, ",");
            //data September
            $strSumSeptember =  rtrim($strSumSeptember, "+");
            $strSeptember =  rtrim($strSeptember, ",");
            //data Oktober
            $strSumOktober =  rtrim($strSumOktober, "+");
            $strOktober =  rtrim($strOktober, ",");
            //data November
            $strSumNovember =  rtrim($strSumNovember, "+");
            $strNovember =  rtrim($strNovember, ",");
            //data Desember
            $strSumDesember =  rtrim($strSumDesember, "+");
            $strDesember =  rtrim($strDesember, ",");
            $strSumAll = $strSumJanuari . '+' . $strSumFebruari . '+' . $strSumMaret . '+' . $strSumApril . '+' . $strSumMei . '+' . $strSumJuni . '+' . $strSumJuli . '+' . $strSumAgustus . '+' . $strSumSeptember . '+' . $strSumOktober . '+' . $strSumNovember . '+' . $strSumDesember;
            $this->db->select(', i.NamaObat, 
            (' . $strSumJanuari . ') AS Januari,
            (' . $strSumFebruari . ') AS Februari,
            (' . $strSumMaret . ') AS Maret,
            (' . $strSumApril . ') AS April,
            (' . $strSumMei . ') AS Mei,
            (' . $strSumJuni . ') AS Juni,
            (' . $strSumJuli . ') AS Juli,
            (' . $strSumAgustus . ') AS Agustus,
            (' . $strSumSeptember . ') AS September,
            (' . $strSumOktober . ') AS Oktober,
            (' . $strSumNovember . ') AS November,
            (' . $strSumDesember . ') AS Desember,
            (' . $strSumAll . ') AS TotalDistribusi
            FROM(SELECT obat.NamaObat,
                ' . $strJanuari . ',
                ' . $strFebruari . ',
                ' . $strMaret . ',
                ' . $strApril . ',
                ' . $strMei . ',
                ' . $strJuni . ',
                ' . $strJuli . ',
                ' . $strAgustus . ',
                ' . $strSeptember . ',
                ' . $strOktober . ',
                ' . $strNovember . ',
                ' . $strDesember . '
            FROM gudangsatelit right join obat on obat.IdObat=gudangsatelit.IdObat
            group by obat.IdObat
            ) i');
        }
    }

    function _getdistrirekap()
    {
        $this->_querydistrirekap();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function countFilteredDistri()
    {
        $this->_querydistrirekap();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function countAllDistri()
    {
        $this->db->from($this->tabelGudangsatelit);
        return $this->db->count_all_results();
    }

    function getMinMaxYear()
    {
        $this->db->select('MIN(CAST(Tanggal AS CHAR)) AS YearMin, MAX(CAST(Tanggal AS CHAR)) AS YearMax');
        $this->db->from('gudangsatelit');
        return $this->db->get()->result_array();
    }

    var $column_orderMutasi = array();
    var $column_searchMutasi = array();
    var $orderMutasi = array('obat.IdObat' => 'asc');

    function _querysatelitmutasi()
    {
        $this->db->select('obat.IdObat, obat.NamaObat, satelitmutasi.*, satelit.NamaSatelit');
        $this->db->from('satelitmutasi');
        $this->db->join('obat', 'satelitmutasi.IdObat=obat.IdObat', 'right');
        $this->db->join('satelit', 'satelitmutasi.IdSatelit=satelit.IdSatelit');
        $i = 0;
        foreach ($this->column_searchMutasi as $item) {
            if (@$_POST['search']['value']) {
                if ($i == 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_searchMutasi) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->orderMutasi[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->orderMutasi)) {
            $order = $this->orderMutasi;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function _getsatelitmutasi()
    {
        $this->_querysatelitmutasi();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function countFilteredSatelitMutasi()
    {
        $this->_querysatelitmutasi();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function countAllSatelitMutasi()
    {
        $this->db->from('satelitmutasi');
        return $this->db->count_all_results();
    }

    function StokGudangSatelitAktif($IdObat, $IdSatelit, $Tanggal)
    {
        $Tanggal = explode('-', $Tanggal);
        if ($Tanggal[0] == 1) {
            $this->db->select('IdObat,
            SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' . ($Tanggal[1]) . '-1-25" THEN Jumlah ELSE 0 END) AS Jumlah');
        } else {
            $this->db->select('IdObat,
            SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' . ($Tanggal[1]) . '-' . $Tanggal[0] . '-25" THEN Jumlah ELSE 0 END) AS Jumlah');
        }
        $this->db->from('gudangsatelit');
        $this->db->where('IdObat', $IdObat);
        $this->db->where('IdSatelit', $IdSatelit);
        $this->db->group_by('IdObat');
        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            return array(array('IdObat' => $IdObat, 'Jumlah' => 0));
        } else {
            return $query->result();
        }
    }

    function StokPenerimaanSatelit($IdObat, $IdSatelit, $Tanggal)
    {
        $Tanggal = explode('-', $Tanggal);
        if ($Tanggal[0] == 1) {
            $this->db->select('SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' . $Tanggal[1] . '-1-25" THEN Jumlah ELSE 0 END) AS StokPenerimaan');
        } else {
            $this->db->select('SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1]) . '-' . ($Tanggal[0] - 1) . '-26" AND Tanggal <= "' . $Tanggal[1] . '-' . $Tanggal[0] . '-25" THEN Jumlah ELSE 0 END) AS StokPenerimaan');
        }
        $this->db->from('gudangsatelit');
        $this->db->where('IdObat', $IdObat);
        $this->db->where('IdSatelit', $IdSatelit);
        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            return array('StokPenerimaan' => 0);
        } else {
            return $query->result();
        }
    }

    function SatelitPemakaian($IdObat, $IdSatelit, $Tanggal)
    {
        $Tanggal = explode('-', $Tanggal);
        if($Tanggal[0] == 1){
            $start_date = ($Tanggal[1]-1).'-12-26';
            $end_date = $Tanggal[1].'-'.$Tanggal[0].'-25';
        }else{
            $start_date = $Tanggal[1].'-'.($Tanggal[0]-1).'-26';
            $end_date = $Tanggal[1].'-'.$Tanggal[0].'-25';
        }
        $this->db->select('SUM(MutasiKeluar) AS MutasiKeluar, SUM(MutasiRusak) AS MutasiRusak,SUM(MutasiKeluar+MutasiRusak) as TotalMutasi');
        $this->db->from('satelitmutasi');
        $this->db->where('Tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->where('IdObat', $IdObat);
        $this->db->where('IdSatelit', $IdSatelit);

        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            return array('TotalMutasi' => 0);
        } else {
            return $query->result();
        }
    }

    function SatelitPemakaianRangeBulan($IdObat, $IdSatelit, $Tanggal){
        $Tanggal = explode('-', $Tanggal);
        if($Tanggal[0] == 1){
            $start_date = ($Tanggal[1]-1).'-12-26';
            $end_date = $Tanggal[1].'-'.$Tanggal[0].'-25';
        }else{
            $start_date = ($Tanggal[1]-1).'-12-26';
            $end_date = $Tanggal[1].'-'.($Tanggal[0]-1).'-25';
        }
        $this->db->select('SUM(MutasiKeluar+MutasiRusak) as TotalMutasi');
        $this->db->from('satelitmutasi');
        $this->db->where('Tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"');
        $this->db->where('IdObat', $IdObat);
        $this->db->where('IdSatelit', $IdSatelit);

        $query = $this->db->get();
        if ($query->num_rows() <= 0) {
            return array('TotalMutasi' => 0);
        } else {
            return $query->result();
        }
    }


    // function StokPenerimaan($IdObat, $IdSatelit, $Tanggal){
    //     $Tanggal = explode('-', $Tanggal);
    //     if ($Tanggal[0] == 1) {
    //         $this->db->select('IdObat,
    //         SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' . ($Tanggal[1]) . '-1-25" THEN Jumlah ELSE 0 END) AS Jumlah');
    //     } else {
    //         $this->db->select('IdObat,
    //         SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-'.$Tanggal[0].'-26" AND Tanggal <= "' . ($Tanggal[1]) . '-' . $Tanggal[0] . '-25" THEN Jumlah ELSE 0 END) AS Jumlah');
    //     }
    //     $this->db->from('gudangsatelit');
    //     $this->db->where('IdObat', $IdObat);
    //     $this->db->where('IdSatelit', $IdSatelit);
    //     $this->db->group_by('IdObat');
    //     $query = $this->db->get();
    //     if ($query->num_rows() <= 0) {
    //         return array(array('IdObat' => $IdObat, 'Jumlah' => 0));
    //     } else {
    //         return $query->result();
    //     }
    // }

    // function SemuaMutasiSatelit($IdObat, $IdSatelit, $Tanggal)
    // {
    //     $Tanggal = explode('-', $Tanggal);
    //     $this->db->select('IdObat,
    //         SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' .  $Tanggal[1] . '-' . ($Tanggal[0]) . '-25" THEN (MutasiKeluar+MutasiRusak) ELSE 0 END) AS SemuaMutasi
    //         ');
    //     $this->db->from('satelitmutasi');
    //     $this->db->where('IdObat', $IdObat);
    //     $this->db->where('IdSatelit', $IdSatelit);
    //     $this->db->group_by('IdObat');
    //     $query = $this->db->get();
    //     if ($query->num_rows() <= 0) {
    //         return array(array('IdObat' => $IdObat, 'SemuaMutasi' => 0));
    //     } else {
    //         return $query->result();
    //     }
    // }

    // function JumlahMutasiSatelit($IdObat, $IdSatelit, $Tanggal)
    // {
    //     $Tanggal = explode('-', $Tanggal);
    //     if ($Tanggal[0] == 1) {
    //         $this->db->select('IdObat,
    //         SUM(CASE WHEN Tanggal >= "' . ($Tanggal[1] - 1) . '-12-26" AND Tanggal <= "' . ($Tanggal[1]) . '-1-25" THEN MutasiKeluar+MutasiRusak ELSE 0 END) AS Mutasi');
    //     } else {
    //         $this->db->select('IdObat,
    //         SUM(CASE WHEN Tanggal >= "' . $Tanggal[1] . '-' . ($Tanggal[0] - 1) . '-26" AND Tanggal <= "' .  $Tanggal[1] . '-' . ($Tanggal[0]) . '-25" THEN MutasiKeluar+MutasiRusak ELSE 0 END) AS Mutasi
    //         ');
    //     }
    //     $this->db->from('satelitmutasi');
    //     $this->db->where('IdObat', $IdObat);
    //     $this->db->where('IdSatelit', $IdSatelit);
    //     $this->db->group_by('IdObat');
    //     $query = $this->db->get();
    //     if ($query->num_rows() <= 0) {
    //         return array(array('IdObat' => $IdObat, 'Mutasi' => 0));
    //     } else {
    //         return $query->result();
    //     }
    // }

    function convertIntToMonth($Tanggal)
    {
        switch ($Tanggal) {
            case 1:
                return 'Januari';
                break;
            case 2:
                return 'Februari';
                break;
            case 3:
                return 'Maret';
                break;
            case 4:
                return 'April';
                break;
            case 5:
                return 'Mei';
                break;
            case 6:
                return 'Juni';
                break;
            case 7:
                return 'Juli';
                break;
            case 8:
                return 'Agustus';
                break;
            case 9:
                return 'September';
                break;
            case 10:
                return 'Oktober';
                break;
            case 11:
                return 'November';
                break;
            case 12:
                return 'Desember';
                break;
        }
    }
}
