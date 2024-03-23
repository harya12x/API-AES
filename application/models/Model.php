<?php 
class Model extends CI_Model {


	public function getDataModel($table, $data, $param = null, $limit = null, $start = null, $keyword = null, $array = true, $groupBy = null) {
		$this->db->select(implode(",", $data));
	
		if ($param !== null) {
			$this->db->where($param);
		}
	
		if ($keyword) {
			$this->db->like($keyword);
		}
	
		if (!is_null($groupBy)) {
			$this->db->order_by($groupBy, 'ASC');
		}
	
		if (!is_null($limit) && !is_null($start)) {
			$this->db->limit($limit, $start);
		}
	
		$query = $this->db->get($table);
	
		if ($array) {
			return $query->result_array();
		} else {
			return $query->row_array();
		}
	}
	

    public function getDataJoinModel($table, $data, $column, $params = null, $keyword = null, $array = 0, $groupBy = null){
        
        $this->db->select($data)->from($table[0]);
        for ($i = 1; $i < count($table); $i++) {
            $this->db->join($table[$i], "$table[$i].{$column[$i-1]} = $table[0].{$column[$i-1]}");
        }
        if(!is_null($params)){
            $this->db->where($params);
        }
        if(!is_null($keyword)){
            $this->db->group_start();
            $this->db->like($keyword);
            $this->db->or_like($keyword);
            $this->db->group_end();
        }
        if(!is_null($groupBy)){
            $process = $this->db->order_by($groupBy, 'ASC');
         }
        if($array == 1) {
           
            $process = $this->db->get()->result_array();
        } else {
            $process = $this->db->get()->row_array();
        }
        return $process;

    }
    public function getSearchDataJoinModel($table, $data, $column, $keyword = null, $array = 0, $groupBy = null){
        
        $this->db->select($data)->from($table[0]);
          // Loop through the remaining tables for JOIN
        for ($i = 1; $i < count($table); $i++) {
            $this->db->join($table[$i], "$table[$i].{$column[$i-1]} = $table[0].{$column[$i-1]}");
        }
        if(!is_null($keyword)){
            $this->db->group_start();
            $this->db->like($keyword);
            $this->db->or_like($keyword);
            $this->db->group_end();
        }
        if($array == 1) {
            $this->db->group_by("$groupBy");
            $process = $this->db->get()->result_array();
        } else {
            $process = $this->db->get()->row_array();
        }
        return $process;
    }
	

	public function createDosen($data) {
        $this->db->insert('jawaban_dosen', $data);
    }

	public function createMahasiswa($data) {
        $this->db->insert('jawaban_mahasiswa', $data);
    }

}
