<?php
namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct() {
        $this->userModel = new UserModel();
        // $this->session = session();
    }

    public function index(int $page = 1)
    {
        // to debug
        $this->per_page = 3;
        
        $data = $this->userModel->paginate($this->per_page, 'users', $page);
        $pager = $this->userModel->pager;
        
        $data = [
            'title' => 'Users',
            'add_url' => 'users/create',
            'table_class' => $this->table_class,
            'thead_class' => $this->thead_class,
            'page' => $page,
            'perPage' => $this->per_page,
            'total' => $this->userModel->countAll(),
            'data' => $data,
            'pager' => $pager,
            'currentPage' => $page,
        ];
        
        return view("user/list", $data);
    }

    public function getUsers()
    {
        $request = service("request");
        $postData = $request->getPost();

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
        $totalRecords = $this->userModel->select($this->userModel->primaryKey)->countAllResults();

        // Total number of records with filtering
        $totalRecordwithFilter = $this->userModel->select($this->userModel->primaryKey)
            ->orLike("name", $searchValue)
            ->orLike("email", $searchValue)
            ->countAllResults();

        // Fetch records
        $records = $this->userModel->select("*")
            ->orLike("name", $searchValue)
            ->orLike("email", $searchValue)
            ->orderBy($columnName, $columnSortOrder)
            ->findAll($rowperpage, $start);

        $data = array();

        foreach($records as $record )
        {
            $a_edit = "<a href='".site_url("user/edit/".$record["id"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#9998;</a>";
            $a_delete = "<a href='".site_url("user/delete/".$record["id"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#128465;</a>";
            $a_lock = "<a href='".site_url("user/lock/".$record["id"]."/".$record["status_id"])."' class='btn btn-default actionButton' data-toggle='dropdown'>&#128274;</a>";

            $data[] = array( 
                "id"        => $record["id"],
                "name"      => $record["name"],
                "email"     => $record["email"],
                "status_id"    => $record["status_id"] ? getBadge("success", "Ativo") : getBadge("danger", "Inativo"),
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

    public function create()
    {
        $data["is_edit"] = 0;
        $data['title'] = 'Create User';
        $data["validation"] = session()->get('validation');
        return view("user/create_edit", $data);
    }

    public function store()
    {
        $rules = [
            'name'              => 'required|min_length[3]|max_length[255]',
            'email'             => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password'          => 'required|min_length[6]|max_length[10]',
            'confirm_password'  => 'matches[password]'
        ];
        if($this->validate($rules)) {
            $user_data = [
                'email'     => $this->request->getVar('email'),
                'name'      => $this->request->getVar('name'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            if ($this->userModel->insert($user_data)) {
                return redirect()->to(site_url('users'));
            } else {
                $errors = $this->userModel->errors();
                redirect()->to(site_url('users/create'))
                    ->withInput()
                    ->with('validation', $errors);
            }
        } else {
            $data['is_edit'] = 0;
            $data['title'] = 'Create User';
            $data['validation'] = $this->validator;
            return redirect()->to(site_url('users/create'))
                ->withInput()
                ->with('validation', $this->validator);
        }
    }

    public function edit(int $id)
    {
        $data["is_edit"] = 1;
        $user_data = $this->userModel->getByID($id);
        $data = array_merge($data, (array)$user_data);

        return view("user/create_edit", $data);
    }

    public function update(int $id)
    {
        $rules = [
            'name'  => 'required|min_length[3]|max_length[255]',
            'email' => "required|min_length[6]|max_length[50]|valid_email|is_unique[users.email,id,{$id}]",
        ];
        if($this->validate($rules)) {
            $user_data = [
                "email" => $this->request->getVar("email"),
                "name" => $this->request->getVar("name"),
            ];
            if($this->userModel->update($id, $user_data)) {
                return redirect()->to(site_url("users"));
            } else {
                $data["is_edit"] = 1;
                $user_data = $this->userModel->getByID($id);
                $data = array_merge($data, (array)$user_data);
                return view("user/create_edit", $data); 
            }
        }
    }

    public function delete(int $id)
    {
        if(!$this->userModel->delete($id)) {
            $errors = $this->userModel->errors();
            return redirect()->to(site_url('users'))
                ->withInput()
                ->with('validation', $errors);
        }
        return redirect()->to(site_url("users"));
    }

    public function toggleActive(int $id)
    {
        $user = $this->userModel->find($id);
        if($user) {
            $user_data["active"] = (int) $user["active"] === 1 ? 0 : 1;
            if($this->userModel->update($id, $user_data)) {
                return $this->response->setJSON([
                    'status' => 'success', 'message' => 'User status updated successfully.'
                ])->setStatusCode(200, 'User status updated successfully.');
            } else {
                return $this->response->setJSON([
                    'status' => 'error', 'message' => 'Failed to update user status.'
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error', 'message' => 'User not found.'
            ]);
        }
    }
}
