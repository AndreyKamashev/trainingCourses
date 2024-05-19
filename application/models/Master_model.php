<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function __construct()
    {
        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
    }

    public function create($table, $data, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->insert($table, $data);
        } else {
            $insert = $this->db->insert_batch($table, $data);
        }
        return $insert;
    }

    public function update($table, $data, $pk, $id = null, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->update($table, $data, array($pk => $id));
        } else {
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }

    public function delete($table, $data, $pk)
    {
        $this->db->where_in($pk, $data);
        return $this->db->delete($table);
    }

    /**
     * Data classes
     */

    public function getDataclasses()
    {
        $this->datatables->select('id_classes, name_classes, id_themes, name_themes');
        $this->datatables->from('classes');
        $this->datatables->join('themes', 'themes_id=id_themes');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'id_classes, name_classes, id_themes, name_themes');
        return $this->datatables->generate();
    }

    public function getclassesById($id)
    {
        $this->db->where_in('id_classes', $id);
        $this->db->order_by('name_classes');
        $query = $this->db->get('classes')->result();
        return $query;
    }

    /**
     * Data themes
     */

    public function getDatathemes()
    {
        $this->datatables->select('id_themes, name_themes');
        $this->datatables->from('themes');
        $this->datatables->add_column('bulk_select', '<div class="text-center"><input type="checkbox" class="check" name="checked[]" value="$1"/></div>', 'id_themes, name_themes');
        return $this->datatables->generate();
    }

    public function getthemesById($id)
    {
        $this->db->where_in('id_themes', $id);
        $this->db->order_by('name_themes');
        $query = $this->db->get('themes')->result();
        return $query;
    }

    /**
     * Data students
     */

    public function getDatastudents()
    {
        $this->datatables->select('a.id_students, a.name, a.nim, a.email, b.name_classes, c.name_themes');
        $this->datatables->select('(SELECT COUNT(id) FROM users WHERE username = a.nim) AS ada');
        $this->datatables->from('students a');
        $this->datatables->join('classes b', 'a.classes_id=b.id_classes');
        $this->datatables->join('themes c', 'b.themes_id=c.id_themes');
        return $this->datatables->generate();
    }

    public function getstudentsById($id)
    {
        $this->db->select('*');
        $this->db->from('students');
        $this->db->join('classes', 'classes_id=id_classes');
        $this->db->join('themes', 'themes_id=id_themes');
        $this->db->where(['id_students' => $id]);
        return $this->db->get()->row();
    }

    public function getthemes()
    {
        $this->db->select('id_themes, name_themes');
        $this->db->from('classes');
        $this->db->join('themes', 'themes_id=id_themes');
        $this->db->order_by('name_themes', 'ASC');
        $this->db->group_by('id_themes');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllthemes($id = null)
    {
        if ($id === null) {
            $this->db->order_by('name_themes', 'ASC');
            return $this->db->get('themes')->result();
        } else {
            $this->db->select('themes_id');
            $this->db->from('themes_courses');
            $this->db->where('courses_id', $id);
            $themes = $this->db->get()->result();
            $id_themes = [];
            foreach ($themes as $j) {
                $id_themes[] = $j->themes_id;
            }
            if ($id_themes === []) {
                $id_themes = null;
            }
            
            $this->db->select('*');
            $this->db->from('themes');
            $this->db->where_not_in('id_themes', $id_themes);
            $courses = $this->db->get()->result();
            return $courses;
        }
    }

    public function getclassesBythemes($id)
    {
        $query = $this->db->get_where('classes', array('themes_id'=>$id));
        return $query->result();
    }
	
	 public function get_last_id_students()
    {
		$record = $this->db->query('SELECT MAX(id_students) AS studentsid FROM students;')->row();
        if ($record) {
            return $record->studentsid;
        } 
        else {
            return FALSE;
        }
    }
	
    /**
     * Data lecturer
     */

    public function getDatalecturer()
    {
        $this->datatables->select('a.id_lecturer,a.nip, a.name_lecturer, a.email, a.courses_id, b.name_courses, (SELECT COUNT(id) FROM users WHERE username = a.nip OR email = a.email) AS ada');
        $this->datatables->from('lecturer a');
        $this->datatables->join('courses b', 'a.courses_id=b.id_courses');
        return $this->datatables->generate();
    }

    public function getlecturerById($id)
    {
        $query = $this->db->get_where('lecturer', array('id_lecturer'=>$id));
        return $query->row();
    }
	
	 public function get_last_id_lecturer()
		{
			$record = $this->db->query('SELECT MAX(id_lecturer) AS lecturerid FROM lecturer;')->row();
			if ($record) {
				return $record->lecturerid;
			} 
			else {
				return FALSE;
			}
		}
    /**
     * Data courses
     */

    public function getDatacourses()
    {
        $this->datatables->select('id_courses, name_courses');
        $this->datatables->from('courses');
        return $this->datatables->generate();
    }

    public function getAllcourses()
    {
        return $this->db->get('courses')->result();
    }

    public function getcoursesById($id, $single = false)
    {
        if ($single === false) {
            $this->db->where_in('id_courses', $id);
            $this->db->order_by('name_courses');
            $query = $this->db->get('courses')->result();
        } else {
            $query = $this->db->get_where('courses', array('id_courses'=>$id))->row();
        }
        return $query;
    }

    /**
     * Data classes lecturer
     */

    public function getclasseslecturer()
    {
        $this->datatables->select('classes_lecturer.id, lecturer.id_lecturer, lecturer.nip, lecturer.name_lecturer, GROUP_CONCAT(classes.name_classes) as classes');
        $this->datatables->from('classes_lecturer');
        $this->datatables->join('classes', 'classes_id=id_classes');
        $this->datatables->join('lecturer', 'lecturer_id=id_lecturer');
        $this->datatables->group_by('lecturer.name_lecturer');
        return $this->datatables->generate();
    }

    public function getAlllecturer($id = null)
    {
        $this->db->select('lecturer_id');
        $this->db->from('classes_lecturer');
        if ($id !== null) {
            $this->db->where_not_in('lecturer_id', [$id]);
        }
        $lecturer = $this->db->get()->result();
        $id_lecturer = [];
        foreach ($lecturer as $d) {
            $id_lecturer[] = $d->lecturer_id;
        }
        if ($id_lecturer === []) {
            $id_lecturer = null;
        }

        $this->db->select('id_lecturer, nip, name_lecturer');
        $this->db->from('lecturer');
        $this->db->where_not_in('id_lecturer', $id_lecturer);
        return $this->db->get()->result();
    }

    
    public function getAllclasses()
    {
        $this->db->select('id_classes, name_classes, name_themes');
        $this->db->from('classes');
        $this->db->join('themes', 'themes_id=id_themes');
        $this->db->order_by('name_classes');
        return $this->db->get()->result();
    }
    
    public function getclassesBylecturer($id)
    {
        $this->db->select('classes.id_classes');
        $this->db->from('classes_lecturer');
        $this->db->join('classes', 'classes_lecturer.classes_id=classes.id_classes');
        $this->db->where('lecturer_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
    /**
     * Data themes courses
     */

    public function getthemescourses()
    {
        $this->datatables->select('themes_courses.id, courses.id_courses, courses.name_courses, themes.id_themes, GROUP_CONCAT(themes.name_themes) as name_themes');
        $this->datatables->from('themes_courses');
        $this->datatables->join('courses', 'courses_id=id_courses');
        $this->datatables->join('themes', 'themes_id=id_themes');
        $this->datatables->group_by('courses.name_courses');
        return $this->datatables->generate();
    }

    public function getcourses($id = null)
    {
        $this->db->select('courses_id');
        $this->db->from('themes_courses');
        if ($id !== null) {
            $this->db->where_not_in('courses_id', [$id]);
        }
        $courses = $this->db->get()->result();
        $id_courses = [];
        foreach ($courses as $d) {
            $id_courses[] = $d->courses_id;
        }
        if ($id_courses === []) {
            $id_courses = null;
        }

        $this->db->select('id_courses, name_courses');
        $this->db->from('courses');
        $this->db->where_not_in('id_courses', $id_courses);
        return $this->db->get()->result();
    }

    public function getthemesByIdcourses($id)
    {
        $this->db->select('themes.id_themes');
        $this->db->from('themes_courses');
        $this->db->join('themes', 'themes_courses.themes_id=themes.id_themes');
        $this->db->where('courses_id', $id);
        $query = $this->db->get()->result();
        return $query;
    }
}
