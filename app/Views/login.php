<?= $this->extend("layouts/default"); ?>

<?= $this->section("title"); ?>Login<?= $this->endSection(); ?>

<?= $this->section("content"); ?>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <h1>Bem Vindo</h1>
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>
                <?= form_open() ?>
                    <div class="mb-3">
                        <label for="InputForEmail" class="form-label">Usuário</label>
                        <input type="user" name="user" class="form-control" id="InputForEmail" value="<?= set_value('user') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="InputForPassword" class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" id="InputForPassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>