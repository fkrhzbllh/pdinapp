<?php

namespace App\Models;

class BaseModel extends \CodeIgniter\Model
{
    protected $admin;

    public function __construct()
    {
        parent::__construct();

        //cek sesi admin
        $admin = $this->session->get('admin');

		if ($admin) 
        {
            $this->admin = $this->getAdminById($admin['id_admin']);
        }

    }

    protected function getAdminById($id = null)
    {
        if (!$id) {
			if (!$this->admin) {
				return false;
			}
			$id= $this->admin['id_admin'];
		}
		
		$query = $this->db->query('SELECT * FROM admin WHERE id_admin = ?', [$id]);
		$admin = $query->getRowArray();

        if (!$admin) return;
        
        return $admin;
    }
}