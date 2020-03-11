<?php
class Excel_import_model extends CI_Model
{
	function select()
	{
		$this->db->order_by('recid', 'DESC');
		$query = $this->db->get('tblspecialtycodes');
		return $query;
	}

	
}
