
<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">  
    <div class="sb-sidenav-menu">
       
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


