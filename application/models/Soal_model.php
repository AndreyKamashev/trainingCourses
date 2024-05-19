<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model {
    
    public function getDataSoal($id, $lecturer)
    {
        $this->datatables->select('a.id_soal, a.soal, FROM_UNIXTIME(a.created_on) as created_on, FROM_UNIXTIME(a.updated_on) as updated_on, b.name_courses, c.name_lecturer');
        $this->datatables->from('tb_soal a');
        $this->datatables->join('courses b', 'b.id_courses=a.courses_id');
        $this->datatables->join('lecturer c', 'c.id_lecturer=a.lecturer_id');
        if ($id!==null && $lecturer===null) {
            $this->datatables->where('a.courses_id', $id);            
        }else if($id!==null && $lecturer!==null){
            $this->datatables->where('a.lecturer_id', $lecturer);
        }
        return $this->datatables->generate();
    }

    public function getSoalById($id)
    {
        return $this->db->get_where('tb_soal', ['id_soal' => $id])->row();
    }

    public function getcourseslecturer($nip)
    {
        $this->db->select('courses_id, name_courses, id_lecturer, name_lecturer');
        $this->db->join('courses', 'courses_id=id_courses');
        $this->db->from('lecturer')->where('nip', $nip);
        return $this->db->get()->row();
    }

    public function getAlllecturer()
    {
        $this->db->select('*');
        $this->db->from('lecturer a');
        $this->db->join('courses b', 'a.courses_id=b.id_courses');
        return $this->db->get()->result();
    }
}