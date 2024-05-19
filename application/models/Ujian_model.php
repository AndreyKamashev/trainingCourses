<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujian_model extends CI_Model {
    
    public function getDataUjian($id)
    {
        $this->datatables->select('a.id_ujian, a.token, a.name_ujian, b.name_courses, a.jumlah_soal, CONCAT(a.tgl_mulai, " <br/> (", a.waktu, " Minute)") as waktu, a.jenis');
        $this->datatables->from('m_ujian a');
        $this->datatables->join('courses b', 'a.courses_id = b.id_courses');
        if($id!==null){
            $this->datatables->where('lecturer_id', $id);
        }
        return $this->datatables->generate();
    }
    
    public function getListUjian($id, $classes)
    {
        $this->datatables->select("a.id_ujian, e.name_lecturer, d.name_classes, a.name_ujian, b.name_courses, a.jumlah_soal, CONCAT(a.tgl_mulai, ' <br/> (', a.waktu, ' Minute)') as waktu,  (SELECT COUNT(id) FROM h_ujian h WHERE h.students_id = {$id} AND h.ujian_id = a.id_ujian) AS ada");
        $this->datatables->from('m_ujian a');
        $this->datatables->join('courses b', 'a.courses_id = b.id_courses');
        $this->datatables->join('classes_lecturer c', "a.lecturer_id = c.lecturer_id");
        $this->datatables->join('classes d', 'c.classes_id = d.id_classes');
        $this->datatables->join('lecturer e', 'e.id_lecturer = c.lecturer_id');
        $this->datatables->where('d.id_classes', $classes);
        return $this->datatables->generate();
    }

    public function getUjianById($id)
    {
        $this->db->select('*');
        $this->db->from('m_ujian a');
        $this->db->join('lecturer b', 'a.lecturer_id=b.id_lecturer');
        $this->db->join('courses c', 'a.courses_id=c.id_courses');
        $this->db->where('id_ujian', $id);
        return $this->db->get()->row();
    }

    public function getIdlecturer($nip)
    {
        $this->db->select('id_lecturer, name_lecturer')->from('lecturer')->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function getJumlahSoal($lecturer)
    {
        $this->db->select('COUNT(id_soal) as jml_soal');
        $this->db->from('tb_soal');
        $this->db->where('lecturer_id', $lecturer);
        return $this->db->get()->row();
    }

    public function getIdstudents($nim)
    {
        $this->db->select('*');
        $this->db->from('students a');
        $this->db->join('classes b', 'a.classes_id=b.id_classes');
        $this->db->join('themes c', 'b.themes_id=c.id_themes');
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    public function HslUjian($id, $mhs)
    {
        $this->db->select('*, UNIX_TIMESTAMP(tgl_selesai) as waktu_habis');
        $this->db->from('h_ujian');
        $this->db->where('ujian_id', $id);
        $this->db->where('students_id', $mhs);
        return $this->db->get();
    }

    public function getSoal($id)
    {
        $ujian = $this->getUjianById($id);
        $order = $ujian->jenis==="Random" ? 'rand()' : 'id_soal';

        $this->db->select('id_soal, soal, file, tipe_file, opsi_a, opsi_b, opsi_c, opsi_d, opsi_e, jawaban');
        $this->db->from('tb_soal');
        $this->db->where('lecturer_id', $ujian->lecturer_id);
        $this->db->where('courses_id', $ujian->courses_id);
        $this->db->order_by($order);
        $this->db->limit($ujian->jumlah_soal);
        return $this->db->get()->result();
    }

    public function ambilSoal($pc_urut_soal1, $pc_urut_soal_arr)
    {
        $this->db->select("*, {$pc_urut_soal1} AS jawaban");
        $this->db->from('tb_soal');
        $this->db->where('id_soal', $pc_urut_soal_arr);
        return $this->db->get()->row();
    }

    public function getJawaban($id_tes)
    {
        $this->db->select('list_jawaban');
        $this->db->from('h_ujian');
        $this->db->where('id', $id_tes);
        return $this->db->get()->row()->list_jawaban;
    }

    public function getHasilUjian($nip = null)
    {
        $this->datatables->select('b.id_ujian, b.name_ujian, b.jumlah_soal, CONCAT(b.waktu, " Minute") as waktu, b.tgl_mulai');
        $this->datatables->select('c.name_courses, d.name_lecturer');
        $this->datatables->from('h_ujian a');
        $this->datatables->join('m_ujian b', 'a.ujian_id = b.id_ujian');
        $this->datatables->join('courses c', 'b.courses_id = c.id_courses');
        $this->datatables->join('lecturer d', 'b.lecturer_id = d.id_lecturer');
        $this->datatables->group_by('b.id_ujian');
        if($nip !== null){
            $this->datatables->where('d.nip', $nip);
        }
        return $this->datatables->generate();
    }

    public function HslUjianById($id, $dt=false)
    {
        if($dt===false){
            $db = "db";
            $get = "get";
        }else{
            $db = "datatables";
            $get = "generate";
        }
        
        $this->$db->select('d.id, a.name, b.name_classes, c.name_themes, d.jml_benar, d.nilai');
        $this->$db->from('students a');
        $this->$db->join('classes b', 'a.classes_id=b.id_classes');
        $this->$db->join('themes c', 'b.themes_id=c.id_themes');
        $this->$db->join('h_ujian d', 'a.id_students=d.students_id');
        $this->$db->where(['d.ujian_id' => $id]);
        return $this->$db->$get();
    }

    public function bandingNilai($id)
    {
		$this->db->select('list_soal');
		$this->db->select('list_jawaban');
        $this->db->select_min('nilai', 'min_nilai');
        $this->db->select_max('nilai', 'max_nilai');
        $this->db->select_avg('FORMAT(FLOOR(nilai),0)', 'avg_nilai');
        $this->db->where('ujian_id', $id);
        return $this->db->get('h_ujian')->row();
    }
	//---------------------------------------------------
	public function get_soap_nilai($array_)
    {
		$record = $this->db->query('SELECT * FROM `tb_soal` WHERE `id_soal` IN ('.$array_.');')->result();
        if ($record) {
            return $record;
        } 
        else {
            return FALSE;
        }
	}
	//---------------------------------------------------
}