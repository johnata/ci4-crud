<?= $this->extend("layouts/default"); ?>
<?= $this->section("content"); ?>
    <div class="container">
        <div class="row">
            <div class="col p-3">
                <h3><?= $is_edit ? "Editar" : "Cadastrar" ?></h3>
            </div>
        </div>
        <div class="alert alert-warning" role="alert">
            <?php if(isset($validation) && $validation): ?>
                <?= "Verifique erros no formulário:" ?>
                <?= $validation->listErrors() ?>
            <?php endif ?>
        </div>
        <?= form_open("", ["oninput" => "senha2.setCustomValidity(senha2.value != senha.value ? \"Senhas não conferem.\" : \"\")"]) ?>
            <input type="hidden" name="is_edit" value="<?= $is_edit ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?= $is_edit ? $email : set_value("email") ?>" required />
            </div>
            <div class="mb-3">
                <label for="user" class="form-label">Usuáio</label>
                <input type="user" class="form-control" name="user" placeholder="user" value="<?= $is_edit ? $user_name : "" ?>" required />
            </div>
            <?php if(!$is_edit): ?>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="" value="" required />
                </div>
                <div class="mb-3">
                    <label for="senha2" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" name="senha2" placeholder="" value="" required />
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="<?= site_url("user") ?>" class="btn btn-secondary">Cancelar</a>
            </div>
        <?= form_close() ?>
    </div>
<?= $this->endSection(); ?>