                    <!-- Modal para editar vehículo -->
                    <div class="modal fade" id="editVehicleModal<?= $vehicle['id']; ?>" tabindex="-1"
                        aria-labelledby="editVehicleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editVehicleModalLabel">Editar Vehículo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="vehicle_id" value="<?= $vehicle['id']; ?>">

                                        <div class="form-group mb-3">
                                            <label for="brand">Marca</label>
                                            <input type="text" class="form-control" name="brand"
                                                value="<?= $vehicle['brand']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="model">Modelo</label>
                                            <input type="text" class="form-control" name="model"
                                                value="<?= $vehicle['model']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="year">Año</label>
                                            <input type="number" class="form-control" name="year" id="year"
                                                value="<?= $vehicle['year']; ?>" min="2000" max="<?= date('Y'); ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description" pattern="^[a-zA-ZáéíóúÁÉÍÓÚ\s]+$"
                                                title="Solo letras y espacios" required><?= $vehicle['description']; ?></textarea>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price" value="<?= $vehicle['price']; ?>"
                                                max="1000.00" step="1" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity" value="<?= $vehicle['capacity']; ?>"
                                                max="6" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="registration_plate">Matrícula</label>
                                            <input type="text" class="form-control" name="registration_plate"
                                                value="<?= $vehicle['registration_plate']; ?>" required>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="status">Estado</label>
                                            <input type="text" class="form-control" name="status"
                                                value="<?= $vehicle['status']; ?>" required>
                                        </div>

                                        <!-- Campos para las imágenes -->
                                        <?php
                                        $images = ['image_url', 'image_url2', 'image_url3', 'image_url4', 'image_url5']; // Define tus campos de imagen
                                        foreach ($images as $img_field): ?>
                                            <div class="form-group mb-3">
                                                <label for="<?= $img_field; ?>">URL de Imagen <?= substr($img_field, -1); ?></label>
                                                <input type="text" class="form-control" name="<?= $img_field; ?>"
                                                    value="<?= $vehicle[$img_field]; ?>" <?= $img_field === 'image_url' ? 'required' : ''; ?>>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="update_vehicle"
                                                class="btn btn-primary me-2">Actualizar</button>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>