<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Reservar Aula</h3></div>
                <?php echo display_msg($msg); ?>
                <div class="card-body">
                    <form method="post" action="reservar.php">
                
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputRoomNumber" name="room-number" type="text" placeholder="Número de Aula" required/>
                            <label for="inputRoomNumber">Número de Aula</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputReservationDate" name="reservation-date" type="date" placeholder="Fecha de Reserva" required/>
                            <label for="inputReservationDate">Fecha de Reserva</label>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input class="form-control" id="inputStartTime" name="start-time" type="time" placeholder="Hora de Inicio" required/>
                            <label for="inputStartTime">Hora de Inicio</label>
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <div class="d-grid"> 
                                <button type="submit" name="reserve" class="btn btn-info">Reservar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
