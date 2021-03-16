<?php
namespace App\Controllers;
use App\Models\UsersModel;

class User extends BaseController
{
    public function __construct() {
        $this->usersModel = new UsersModel();
        $this->session = session();
    }

    public function index($page = 1)
    {
        $data = [
            "table_class" => $this->table_class,
            "thead_class" => $this->thead_class,
            "users" => $this->usersModel->paginate($this->thead_pagination, "user"),
            "pager" => $this->usersModel->pager,
        ];

        return view("user/list", $data);
    }

    public function getUsers()
    {
        $request = service("request");
        $postData = $request->getPost();

        // var_dump($postData);die;
        $dtpostData = $postData["data"];
        $response = array();

        // Read value
        $draw               = $dtpostData["draw"];
        $start              = $dtpostData["start"];
        $rowperpage         = $dtpostData["length"]; // Rows display per page
        $columnIndex        = $dtpostData["order"][0]["column"]; // Column index
        $columnName         = $dtpostData["columns"][$columnIndex]["data"]; // Column name
        $columnSortOrder    = $dtpostData["order"][0]["dir"]; // asc or desc
        $searchValue        = $dtpostData["search"]["value"]; // Search value

        // Total number of records without filtering
        $totalRecords = $this->usersModel->select($this->usersModel->primaryKey)->countAllResults();

        // Total number of records with filtering
        $totalRecordwithFilter = $this->usersModel->select($this->usersModel->primaryKey)
            ->orLike("user_name", $searchValue)
            ->orLike("email", $searchValue)
            ->countAllResults();

        // Fetch records
        $records = $this->usersModel->select("*")
            ->orLike("user_name", $searchValue)
            ->orLike("email", $searchValue)
            ->orderBy($columnName, $columnSortOrder)
            ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record )
        {
            $a_edit = "<a href='".site_url("user/edit/".$record["user_id"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#9998;</a>";
            $a_delete = "<a href='".site_url("user/delete/".$record["user_id"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#128465;</a>";
            $a_lock = "<a href='".site_url("user/lock/".$record["user_id"]."/".$record["status"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#128274;</a>";

            $data[] = array( 
                "user_id"        => $record["user_id"],
                "user_name"      => $record["user_name"],
                "email"     => $record["email"],
                "status"    => $record["status"] ? getBadge("success", "Ativo") : getBadge("danger", "Inativo"),
                "actions"   => "
                    $a_edit
                    $a_delete
                    $a_lock
                ",
            ); 
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data,
            // "token" => csrf_hash() // New token hash
        );

        return $this->response->setJSON($response);
    }

    public function add()
    {
        $data["is_edit"] = 0;
        if ($this->request->getMethod() == "post")
        {
            $rules = [
                "user"   => "required|min_length[3]|max_length[20]",
                "email"  => "required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]",
                "senha"  => "required|min_length[6]|max_length[10]",
                "senha2" => "matches[senha]"
            ];
            if($this->validate($rules))
            {
                $user_data = [
                    "email" => $this->request->getVar("email"),
                    "user_name" => $this->request->getVar("user"),
                    "password" => md5(md5($this->request->getVar("senha"))),
                ];
                if($this->usersModel->insert($user_data))
                {
                    return redirect()->to(site_url("user"));
                }
                else
                {
                    return view("user/add_edit", $data); 
                }
            }
            else
            {
                $data["validation"] = $this->validator;

                echo view("user/add_edit", $data);
            }
        }
        else
        {
            return view("user/add_edit", $data);
        }
    }

    public function edit($user_id)
    {
        $data["is_edit"] = 1;
        if ($this->request->getMethod() == "post")
        {
            $user_data = [
                "email" => $this->request->getVar("email"),
                "user_name" => $this->request->getVar("user"),
                "password" => md5(md5($this->request->getVar("senha"))),
            ];
            d($user_id);
            d($user_data);
            if($this->usersModel->update($user_id, $user_data))
            {
                return redirect()->to(site_url("user"));
            }
            else
            {
                return view("user/add_edit", $data); 
            }
        }
        else
        {
            $user_data = $this->usersModel->getByID($user_id);
            $data = array_merge($data, (array)$user_data);

            return view("user/add_edit", $data);
        }
    }

    public function delete($user_id)
    {
        if($this->usersModel->delete($user_id))
        {
            // return redirect()->to(site_url("user/list"));
        }
        else
        {
            // return view("user/add_edit", $data); 
        }
        return redirect()->to(site_url("user"));
    }

    public function lock($user_id, $status)
    {
        $data["status"] = $status ? 0 : 1;
        if($this->usersModel->update($user_id, $data))
        {
            // return redirect()->to(site_url("user/list"));
        }
        else
        {
            // return view("user/add_edit", $data); 
        }
        return redirect()->to(site_url("user"));
    }
}
