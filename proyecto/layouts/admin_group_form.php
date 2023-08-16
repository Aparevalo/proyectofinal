<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Agregar nuevo grupo de usurios</h3></div>
                <?php echo display_msg($msg); ?>
                <div class="card-body">
                    <form method="post" action="add_group.php">
                
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputFirstName" name="group-name" type="text" placeholder="Nombre del grupo" required/>
                            <label for="inputFirstName">Nombre del grupo</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                                <input class="form-control" id="inputLastName" name="group-level" type="text" placeholder="Nivel del grupo" />
                                <label for="inputLastName">Nivel del grupo</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <select class="form-control" name="status">
                            <option selected>Estado</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="mt-4 mb-0">
                            <div class="d-grid"> <button type="submit" name="add" class="btn btn-info">Guardar</button></div>
                        </div>
                    </form>
                </div>
               
            </div>
        </div>
    </div>
</div>