<?php

namespace App\Models;

class RuanganTipeModel extends \App\Models\BaseModel
{
    protected $table = 'ruangan_tipe';
    protected $useTimestamps = true;
    protected $allowedFields = ['tipe'];
}
