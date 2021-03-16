<?= $this->extend("layouts/default"); ?>
<?= $this->section("content");?>
    <div class="container">
        <div class="row">
            <div class="col p-3">
                <h3>Usuários</h3>
            </div>
            <div class="col text-right p-3">
                <a href="<?= site_url("user/add") ?>" class="btn btn-primary">Add</a>
            </div>
        </div>
    
        <table class="<?= $table_class ?>">
            <thead class="<?= $thead_class ?>">
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if($users): ?>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user["user_id"]; ?></td>
                            <td><?php echo $user["user_name"]; ?></td>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?= $user["status"] ? getBadge("success", "Ativo") : getBadge("danger", "Inativo") ?></td>
                            <td>
                                <a href="<?= site_url("user/edit/".$user["user_id"]) ?>" class='btn btn-default actionButton' data-toggle='dropdown'>&#9998;</a>
                                <a href="<?= site_url("user/delete/".$user["user_id"]) ?>" class='btn btn-default actionButton' data-toggle='dropdown'>&#128465;</a>
                                <a href="<?= site_url("user/lock/".$user["user_id"]."/".$user["status"]) ?>" class='btn btn-default actionButton' data-toggle='dropdown'>&#128274;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if($pager) :?>
            <?= $pager->links("user", "default_pagination"); ?> 
        <?php endif ?>
        <!-- Pagination -->
    
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
    
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="<?= base_url("assets/css/datatables.min.css"); ?>">

    <!-- Datatable JS -->
    <script src="<?= base_url("assets/js/datatables.min.js"); ?>"></script>

    <script>
        $(document).ready(function()
        {
            $('#usersTable').DataTable(
            {
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                'url':"<?=site_url('user/getUsers')?>",
                'data': function(data)
                {
                    return {
                        data: data,
                    };
                },
                dataSrc: function(data)
                {
                    // Datatable data
                    return data.aaData;
                }
                },
                'columns': 
                [
                    { data: "user_id" },
                    { data: "user_name" },
                    { data: "email" },
                    { data: "status" },
                    { data: "actions" },
                ]
            });
        });
   </script>
<?= $this->endSection(); ?>