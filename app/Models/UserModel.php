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
            'uuid'
        ];
    }

    public function findAllButAdmins()
    {
        // return $this->where('auth_groups_users.group != admin')->findAll();
        // return $this->db->table('users')
        //     ->join('auth_groups_users', "users.id=auth_groups_users.user_id")
        //     ->where('auth_groups_users.group !=', 'admin')->get()->getResultArray();
        return $this->db->query('SELECT u.username, u.first_name, u.last_name, u.uuid, agu.group, ai.secret FROM users u JOIN auth_groups_users agu ON u.id = agu.user_id JOIN auth_identities ai ON u.id = ai.user_id WHERE agu.group != "admin"')->getResultArray();
    }

    public function findByIdForEdit($uuid)
    {
        // return $this->where('auth_groups_users.group != admin')->findAll();
        return $this->db->query('SELECT u.id, u.username, u.first_name, u.last_name, u.uuid, agu.group, ai.secret FROM users u JOIN auth_groups_users agu ON u.id = agu.user_id JOIN auth_identities ai ON u.id = ai.user_id WHERE u.uuid = "' . $uuid . '"')->getRowArray();
    }

    public function getUserByEmail($email)
    {
        return $this->db->query('SELECT guests.nama, guests.kontak FROM guests WHERE email = "' . $email);
    }
}
