
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">  
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Usuarios</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Usuarios
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="add_group.php">Agregar Grupo de Usuarios</a>
                    <a class="nav-link" href="add_user.php">Agregar Usuario</a>
                </nav>
            </div>
            <div class="sb-sidenav-menu-heading">Aulas</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                Usuarios
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="aulasAsignadas.php">Horario Actual</a>
                    <a class="nav-link" href="aulasReservadas.php">Aulas Reservadas</a>
                </nav>
            </div>
        </div>
    <div class="sb-sidenav-footer">
        
    <div class="small">Conectado como:</div>
    <?php if($user['user_level'] === '1'): ?>
        <?php echo "Administrador";?>
        <?php elseif($user['user_level'] === '2'): ?>
          <?php echo "Usuario Especial";?>
        <?php elseif($user['user_level'] === '3'): ?>
          <?php echo "Usuario";?>
        <?php endif;?>
    </div>
</nav>


