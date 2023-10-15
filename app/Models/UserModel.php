<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            'first_name',
            'last_name',
            'avatar',
        ];
    }

    public function findAllButAdmins()
    {
        // return $this->where('auth_groups_users.group != admin')->findAll();
        return $this->db->table('users')
            ->join('auth_groups_users', "users.id=auth_groups_users.user_id")
            ->where('auth_groups_users.group !=', 'admin')->get()->getResultArray();
    }
}
