<?php

namespace App\Models;

use CodeIgniter\Model;

class Team extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'teams';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'leader'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getTeam()
    {
        $builder = $this->db->table('teams AS t')
                ->select('t.*, user.name AS user_name')
                ->join('users AS user', 't.leader = user.id', 'left')
                ->get();
        return $builder;
    }

    public function getTeamByID($id = null)
    {
        $builder = $this->db->table('teams AS t')
                ->select('t.*, user.name AS user_name')
                ->join('users AS user', 't.leader = user.id', 'left')
                ->where('t.id', $id)
                ->get();
        return $builder;
    }
}
