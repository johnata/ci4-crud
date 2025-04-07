<?= $this->extend("layouts/default"); ?>
<?= $this->section('title') ?>CodeIgniter 4 Crud<?= $this->endSection() ?>
<?= $this->section("content");?>
    <table class="table table-stripped table-bordered">
        <thead>
            <tr class="bg-gradient bg-success text-light">
                <th class="p-2 text-center">ID</th>
                <th class="p-2 text-center">Name</th>
                <th class="p-2 text-center">Email</th>
                <th class="p-2 text-center">Status</th>
                <th class="p-2 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $user): ?>
                <tr>
                    <td class="px-2 py-1 text-center align-middle"><?= $user['id'] ?></td>
                    <td class="px-2 py-1 align-middle"><?= $user['name'] ?></td>
                    <td class="px-2 py-1 align-middle"><?= $user['email'] ?></td>
                    <td class="px-2 py-1 text-center align-middle"><?= $user["status_id"] === 1 ? getBadge("success", "Ativo") : getBadge("danger", "Inativo") ?></td>
                    <td class="px-2 py-1 text-center align-middle">
                        <a href="<?= site_url("users/edit/".$user["id"]) ?>" class='btn btn-default actionButton' data-toggle='dropdown'>&#9998;</a>
                        <!-- <a href="<?= site_url("users/delete/".$user["id"]) ?>" class='btn btn-default actionButton' data-toggle='dropdown'>&#128465;</a> -->
                        <button 
                            class="btn btn-default actionButton btn-delete" 
                            data-id="<?= $user["id"] ?>" 
                            title="Delete User">
                            &#128465;
                        </button>
                        <button 
                            class="btn btn-default actionButton btn-lock" 
                            data-id="<?= $user["id"] ?>" 
                            data-status="<?= $user["status_id"] ?>" 
                            title="<?= $user['active'] ? 'Lock User' : 'Unlock User' ?>"
                        >
                            <?= $user['active'] ? '&#128274;' : '&#128275;' ?>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $pager->makeLinks($page, $perPage, $total, 'default_pagination', 3, 'page'); ?>         



    <div class="container" style="display: none;">
        <div class="row">
            <div class="col p-3">
                <h3>Usuários</h3>
            </div>
            <div class="col text-right p-3">
                <a href="<?= site_url("user/add") ?>" class="btn btn-primary">Add</a>
            </div>
        </div>
        
        <div class="row">
            <div class="col p-3">
                <h3>Tabela com datatables</h3>
            </div>
        </div>
        <table class="<?= $table_class ?>" id="usersTable">
            <thead class="<?= $thead_class ?>">
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
        </table>
    </div>
    
    <!-- CSS do DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>

    <!-- JS do DataTables -->
    <script type="text/javascript" charset="utf-8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>


    <script>
        // $(document).ready(function()
        // {
        //     $('#usersTable').DataTable(
        //     {
        //         'processing': true,
        //         'serverSide': true,
        //         'serverMethod': 'post',
        //         'ajax': {
        //         'url':"<?=site_url('user/getUsers')?>",
        //         'data': function(data)
        //         {
        //             return {
        //                 data: data,
        //             };
        //         },
        //         dataSrc: function(data)
        //         {
        //             // Datatable data
        //             return data.aaData;
        //         }
        //         },
        //         'columns': 
        //         [
        //             { data: "id" },
        //             { data: "name" },
        //             { data: "email" },
        //             { data: "status_id" },
        //             { data: "actions" },
        //         ]
        //     });
        // });
   </script>
<?= $this->endSection(); ?>
<?= $this->section('custom_js') ?>
    <script src="<?= base_url('assets/js/users.js') ?>"></script>
<?= $this->endSection() ?>