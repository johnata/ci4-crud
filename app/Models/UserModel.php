<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name','email', 'password', 'status_id', 'active', 'deleted_at'];
 
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
    
    public function login($user, $password)
    {
        $result = $this->db
            ->table($this->table)
            ->where(["status_id" => "1", "name" => $user, "password" => $password])
            ->get()
            ->getRow();
        
        if($result)
        {
            $data = [
                "id"            => $result->id,
                "name"          => $result->name,
                "user_email"    => $result->email,
                "logged_in"     => TRUE,
            ];
            return $data;
        } else {
            return 0;
        }        
    }

    public function getByID($id)
    {
        return $this->db
            ->table($this->table)
            ->select('id, name, email, status_id')
            ->where(["id" => $id])
            ->get()
            ->getRowObject();
    }
}