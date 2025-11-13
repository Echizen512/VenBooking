       <!-- Modal para agregar nuevo vehículo -->
        <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVehicleModalLabel">Agregar Nuevo Vehículo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <input type="hidden" name="inn_id" value="<?= $inn_id; ?>">

                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="" disabled selected>Seleccione el tipo</option>
                                    <option value="Auto">Auto</option>
                                    <option value="Lancha">Lancha</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="brand">Marca</label>
                                <input type="text" class="form-control" name="brand" required>
                            </div>

                            <div class="form-group">
                                <label for="model">Modelo</label>
                                <input type="text" class="form-control" name="model" required>
                            </div>

                            <div class="form-group">
                                <label for="year">Año</label>
                                <input type="number" class="form-control" name="year" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>

                            <div class="form-group">
                                <label for="capacity">Capacidad</label>
                                <input type="number" class="form-control" name="capacity" required>
                            </div>

                            <div class="form-group">
                                <label for="registration_plate">Placa de Registro</label>
                                <input type="text" class="form-control" name="registration_plate" required>
                            </div>

                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select class="form-control" name="status" required>
                                    <option value="1">Activo</option>
                                    <option value="0">Bloqueado</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image_url">URL de Imagen (Obligatoria)</label>
                                <input type="text" class="form-control" name="image_url" required>
                            </div>

                            <div class="form-group">
                                <label for="image_url2">URL de Imagen 2</label>
                                <input type="text" class="form-control" name="image_url2">
                            </div>

                            <div class="form-group">
                                <label for="image_url3">URL de Imagen 3</label>
                                <input type="text" class="form-control" name="image_url3">
                            </div>

                            <div class="form-group">
                                <label for="image_url4">URL de Imagen 4</label>
                                <input type="text" class="form-control" name="image_url4">
                            </div>

                            <div class="form-group">
                                <label for="image_url5">URL de Imagen 5</label>
                                <input type="text" class="form-control" name="image_url5">
                            </div>

                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="add_vehicle" class="btn btn-primary me-2">Agregar</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para agregar nueva habitación -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Agregar Nueva Habitación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="room_number">Número de Habitación</label>
                                <input type="number" class="form-control" name="room_number" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="type">Tipo</label>
                                <select class="form-control" name="type" id="type" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="Solo">Solo</option>
                                    <option value="Pareja">Pareja</option>
                                    <option value="Familia">Familia</option>
                                    <option value="Grupal">Grupal</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="quality">Calidad</label>
                                <select class="form-control" name="quality" id="quality" required>
                                    <option value="" disabled selected>Seleccione una calidad</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image_url">URL de Imagen (Obligatoria)</label>
                                <input type="text" class="form-control" name="image_url" required>
                            </div>
                            <div class="form-group">
                                <label for="image_url2">URL de Imagen 2</label>
                                <input type="text" class="form-control" name="image_url2">
                            </div>
                            <div class="form-group">
                                <label for="image_url3">URL de Imagen 3</label>
                                <input type="text" class="form-control" name="image_url3">
                            </div>
                            <div class="form-group">
                                <label for="image_url4">URL de Imagen 4</label>
                                <input type="text" class="form-control" name="image_url4">
                            </div>
                            <div class="form-group">
                                <label for="image_url5">URL de Imagen 5</label>
                                <input type="text" class="form-control" name="image_url5">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea class="form-control" name="description" id="description" required pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras, acentos y espacios."></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Precio</label>
                                <input type="number" class="form-control" name="price" required step="1" max="1000.00" title="El precio no puede superar los 1000.00">
                            </div>
                            <div class="form-group">
                                <label for="capacity">Capacidad</label>
                                <input type="number" class="form-control" name="capacity" required max="10" title="La capacidad máxima es de 10">
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" name="add_room" class="btn btn-primary me-2">Agregar</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
