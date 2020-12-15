<?php

class CatatanHarian_model extends CI_Model
{
    public function getCatatanHarian($id = null)
    {
        if ($id === null){
            return $this->db->get('catatan_harian')->result_array();
        } else {
            return $this->db->get_where('catatan_harian', ['id' => $id])->result_array();
        }
       
    }


    public function deleteCatatanHarian($id)
    {
        $this->db->delete('catatan_harian', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function createCatatanHarian($data)
    {
        $this->db->insert('catatan_harian', $data);
        return $this->db->affected_rows();
    }

    public function UpdateCatatanHarian($data, $id)
    {
        $this->db->update('catatan_harian', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}


