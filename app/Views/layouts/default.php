<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection("title"); ?></title>
 
    <!-- CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <!-- CDN JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- default CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/default.css') ?>">
    <link rel="icon" type="image/svg+xml" href="<?= base_url('assets/images/logo.svg') ?>">

    <!-- default JS -->
    <script src="<?= base_url('assets/js/default.js') ?>"></script>
    <script>
        const base_url = "<?= base_url() ?>";
        // const csrfName = "<?= csrf_token() ?>";
        // const csrfHash = "<?= csrf_hash() ?>";
    </script>
</head>
<body class="bg-body-tertiary">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-lg">
        <div class="container">
            <a class="navbar-brand h1" href="<?= base_url() ?>">
                <img src="<?= base_url('assets/images/logo.svg') ?>" width="60" alt="Logo">
            </a>

            <!-- mobile menu -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#toggle"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- menu -->
            <div class="collapse navbar-collapse" id="toggle">
                <ul class="navbar-nav me-auto pb-1">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('/')) ? 'active' : '' ?>" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos(current_url(), base_url('/users')) !== false) ? 'active' : '' ?>" href="<?= base_url('/users') ?>">Users</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            data-bs-toggle="dropdown"
                            href="#"
                        >
                            Skills
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">HTML5</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">CSS3</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">JavaScript</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Soft Skills</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Support</a>
                    </li>
                </ul>
                <br />

                <!-- only template -->
                <form class="d-flex" role="search">
                    <input
                        class="form-control me-2"
                        type="search"
                        placeholder="Search something..."
                    >
                    <button
                        class="btn btn-outline-light"
                        type="submit"
                    >
                        Search
                    </button>
                </form>
                <br />

                <!-- only template -->
                <div class="dropdown text-end ps-3">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url('/assets/images/user-default.png') ?>" alt="mdo" width="32" height="32" class="rounded-circle img-fluid bg-light">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-sm-start text-small mt-2" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
                <br />

            </div>

        </div>
    </nav>

    <!-- Page title -->
    <div class="position-sticky top-0 bg-body-tertiary pt-2 border-bottom pb-2">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h3 class="fw-bold"><?= esc($title ?? 'Set data title') ?></h3>
                </div>
                <?php if (isset($add_url)) : ?>
                    <div class="col text-end">
                        <a href="<?= base_url($add_url) ?>" class="btn btn-primary">+ Add</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container py-3 mb-5">
        <main>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box p-4 shadow-sm bg-white rounded-3">
                        <div>
                            <?php if (isset($validation) && $validation): ?>
                                <div class="alert alert-warning" role="alert">
                                    <?= "Errors:" ?>
                                    <?= $validation->listErrors() ?>
                                </div>
                            <?php endif ?>
                            <div id="alertPlaceholder"></div>
                            <?= $this->renderSection('content') ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="genericModal" tabindex="-1" aria-labelledby="genericModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" id="genericModalHeader">
                    <h5 class="modal-title">
                        <span id="genericModalIcon" class="me-2"></span>
                        <span id="genericModalLabel">title</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p id="genericModalMessage">message</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary d-none" id="genericCancelBtn" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="genericConfirmBtn">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-white p-3 fixed-bottom border-top mt-5">
        <div class="container d-flex justify-content-between align-items-center">
            <ul class="col-md-4 nav">
                <li class="nav-item"><a href="https://github.com/johnata" target="_blank" class="nav-link text-dark">Johnata Santos</a></li>
            </ul>
            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <img src="<?=base_url('assets/images/logo.svg')?>" width="40" alt="Logo" class="img-fluid">
            </a>

            <ul class="nav">
                <li class="nav-item"><a href="<?= base_url('/') ?>" class="nav-link text-dark">Home</a></li>
                <li class="nav-item"><a href="<?= base_url('/users') ?>" class="nav-link text-dark">Users</a></li>
            </ul>
        </div>
    </footer>
</body>
<?= $this->renderSection('custom_js') ?>
</html>
