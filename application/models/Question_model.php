<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
       
    public function getDataQuestion($nip)
    {
       $sql = "SELECT st.name, lc.name_lecturer, qs.* FROM questions AS qs LEFT JOIN students AS st ON qs.students_id = st.id_students LEFT JOIN classes_lecturer AS cl ON st.classes_id = cl.classes_id LEFT JOIN lecturer AS lc ON cl.lecturer_id = lc.id_lecturer WHERE lc.nip =".$nip;
		$query = $this->db->query($sql);
        return $query->result();
    }
	
	 public function getDataStudents($nip)
    {
       $sql = "SELECT st.name, st.id_students FROM students AS st LEFT JOIN classes_lecturer AS cl ON st.classes_id = cl.classes_id LEFT JOIN lecturer AS lc ON cl.lecturer_id = lc.id_lecturer WHERE lc.nip =".$nip;
	   $query = $this->db->query($sql);
       return $query->result();
    }
	
	public function getlecturerId($nip)
    {
        $sql="SELECT id_lecturer FROM lecturer WHERE nip=".$nip;
		$query = $this->db->query($sql);
        return $query->row();
    }
	
	public function getDataQuestionSt($nim)
    {
       $sql = "SELECT st.name, lc.name_lecturer, qs.* FROM questions AS qs LEFT JOIN students AS st ON qs.students_id = st.id_students LEFT JOIN classes_lecturer AS cl ON st.classes_id = cl.classes_id LEFT JOIN lecturer AS lc ON cl.lecturer_id = lc.id_lecturer WHERE st.nim =".$nim." AND lc.id_lecturer = qs.lecturer_id";
		$query = $this->db->query($sql);
        return $query->result();
    }
	
	public function getquestionById($id)
    {
        $query = $this->db->get_where('questions', array('id_questions'=>$id));
        return $query->row();
    }
	
	//---------------add-----------------------
	public function createquest($name_questions,$id_students,$user_id,$date_create) {
		$data = array(
               'name_questions' => $name_questions,
			   'date_questions' => $date_create,
			   'lecturer_id' => $user_id,
			   'students_id' => $id_students
            );
		$sql_query=$this->db->insert('questions', $data); 
		if($sql_query){
			$this->session->set_flashdata('success', 'Вопрос успешно добавлен.');
			redirect('question');
		} else {
			$this->session->set_flashdata('error', 'Не удалось добавить вопрос. Ошибка!');
			redirect('question');
		}
	}
	//------------edit lecturer------------------------
	public function editquest($id,$name_questions,$id_students,$score) {
		$data = array(
               'name_questions' => $name_questions,
			   'students_id' => $id_students,
			   'score' => $score
            );
		$sql_query=$this->db->where('id_questions',$id)
							->update('questions',$data); 
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Вопрос успешно обновлен.');
			redirect('question');
		} else {
			$this->session->set_flashdata('error', 'Не удалось обновить вопрос. Ошибка!');
			redirect('question');
		}
	}
	//------------edit student------------------------
	public function editquestSt($id,$name_answers,$date_create) {
		$data = array(
               'name_answers' => $name_answers,
			   'date_answers' => $date_create
            );
		$sql_query=$this->db->where('id_questions',$id)
							->update('questions',$data); 
		if ($this->db->affected_rows() > 0){
			$this->session->set_flashdata('success', 'Ответ успешно обновлен.');
			redirect('ujian/list_question');
		} else {
			$this->session->set_flashdata('error', 'Не удалось обновить ответ. Ошибка!');
			redirect('ujian/list_question');
		}
	}
	//---------------delete---------------------------
	public function deletequest($uid){	
		$sql_query=$this->db->where('id_questions', $uid)
                ->delete('questions');
    }
}