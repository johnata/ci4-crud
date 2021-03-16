<?php 
namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $allowedFields = ["user_name", "email", "status"];
    protected $useTimestamps = false; 
    protected $validationRules = []; 
    protected $validationMessages = []; 
    protected $skipValidation = false; 

    public function login($user, $password)
    {
        $result = $this->db
            ->table($this->table)
            ->where(["status" => "1", "user_name" => $user, "password" => $password])
            ->get()
            ->getRow();
        
        if($result)
        {
            $data = [
                "user_id"       => $result->user_id,
                "user_name"     => $result->user_name,
                "user_email"    => $result->email,
                "logged_in"     => TRUE,
            ];
            return $data;
        } else {
            return 0;
        }        
    }

    public function getByID($user_id)
    {
        return $this->db
            ->table($this->table)
            ->select("user_id, user_name, email, status")
            ->where(["user_id" => $user_id])
            ->get()
            ->getRowObject();
    }
}