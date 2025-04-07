<?= $this->extend("layouts/default"); ?>
<?= $this->section("content"); ?>
    <?php
        $action_form = 'users/store';
        $oninput_form = ["oninput" => "confirm_password.setCustomValidity(confirm_password.value != password.value ? \"Passwords don't match.\" : \"\")"];
        if($is_edit): 
            $action_form = 'users/update/'.$id;
            $oninput_form = [];
        endif;
    ?>
    <?= form_open($action_form, $oninput_form) ?>
        <input type="hidden" name="is_edit" value="<?= $is_edit ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com" value="<?= $is_edit ? $email : set_value("email") ?>" required />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="name" class="form-control" name="name" placeholder="name" value="<?= $is_edit ? $name : set_value("name") ?>" required />
        </div>
        <?php if(!$is_edit): ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="" value="sadsasdss" required />
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="" value="sadsasdss" required />
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="<?= site_url("users") ?>" class="btn btn-secondary">Cancel</a>
        </div>
    <?= form_close() ?>
<?= $this->endSection(); ?>