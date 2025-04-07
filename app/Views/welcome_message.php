<?= $this->extend("layouts/default") ?>

<?= $this->section('title') ?>
    <?= esc($title ?? 'Dashboard') ?>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
    <p>Welcome to the CodeIgniter 4 CRUD application.</p>
<?= $this->endSection() ?>
