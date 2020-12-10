<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.html"><img src="<?php echo base_url('assets/img/logo_branca.png') ?>" style="max-width: 100px;"></a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button><!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="#">Settings</a><a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="<?php echo base_url(); ?>login/Logount?>">Sair</a>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <!-- <div class="sb-sidenav-menu-heading">Fluxo</div> -->
                    <a class="nav-link" href="<?php echo site_url('/cliente') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Clientes
                    </a>

                    <a class="nav-link" href="<?php echo site_url('/produto') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                        Produtos
                    </a>

                    <a class="nav-link" href="<?php echo site_url('/historico_veiculo') ?>">
                        <div class="sb-nav-link-icon"><i class="fab fa-creative-commons-share"></i></div>
                        Histórico do Veiculo
                    </a>

                    <a class="nav-link" href="<?php echo site_url('/orcamento') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Orcamento
                    </a>

                    <a class="nav-link" href="<?php echo site_url('/financeiro') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                        Financeiro
                    </a>

                </div>
            </div>
    </div>
