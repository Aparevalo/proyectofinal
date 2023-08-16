    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5" style="min-width: 300px;">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Agregar nuevo usuario</h3></div>
                <?php echo display_msg($msg); ?>
                <div class="card-body">
                    <form method="post" action="add_user.php">
                
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputFirstName" name="full-name" type="text" placeholder="Nombre completo" required/>
                            <label for="inputFirstName">Nombres del Usuario</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                                <input class="form-control" id="inputUserName" type="text" name="username" placeholder="Nombre de usuario" />
                                <label for="inputUserName">Nombre de Usuario</label>
                        </div>

                        <div class="form-floating mb-3">
                                <input class="form-control" id="inputUserEmail" type="email" name="email" placeholder="Email del usuario" />
                                <label for="inputUserEmail">Email del Usuario</label>
                        </div>

                        <div class="form-floating mb-3">
                                <input class="form-control" id="inputPassword" type="password" name ="password"  placeholder="Contraseña" />
                                <label for="inputPassword">Contraseña del Usuario</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                        <label for="level">Rol de usuario</label>
                        <BR>
                        <select class="form-control" name="level">
                        <?php foreach ($groups as $group ):?>
                        <option value="<?php echo $group['group_level'];?>"><?php echo ucwords($group['group_name']);?></option>
                        <?php endforeach;?>
                        </select>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"> <button type="submit" name="add_user" class="btn btn-info">Guardar</button></div>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>