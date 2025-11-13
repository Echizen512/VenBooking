
                    <!-- Modal para editar habitación -->
                    <div class="modal fade" id="editRoomModal<?= $room['id']; ?>" tabindex="-1"
                        aria-labelledby="editRoomModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRoomModalLabel">Editar Habitación</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST">
                                        <input type="hidden" name="room_id" value="<?= $room['id']; ?>">
                                        <div class="form-group mb-3">
                                            <label for="room_number">Número de Habitación</label>
                                            <input type="number" class="form-control" name="room_number"
                                                value="<?= $room['room_number']; ?>" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="type">Tipo</label>
                                            <select class="form-control" name="type" id="type" required>
                                                <option value="Solo" <?= $room['type'] === 'Solo' ? 'selected' : ''; ?>>Solo</option>
                                                <option value="Pareja" <?= $room['type'] === 'Pareja' ? 'selected' : ''; ?>>Pareja</option>
                                                <option value="Familia" <?= $room['type'] === 'Familia' ? 'selected' : ''; ?>>Familia</option>
                                                <option value="Grupal" <?= $room['type'] === 'Grupal' ? 'selected' : ''; ?>>Grupal</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="quality">Calidad</label>
                                            <select class="form-control" name="quality" id="quality" required>
                                                <option value="Alta" <?= $room['quality'] === 'Alta' ? 'selected' : ''; ?>>Alta</option>
                                                <option value="Media" <?= $room['quality'] === 'Media' ? 'selected' : ''; ?>>Media</option>
                                                <option value="Baja" <?= $room['quality'] === 'Baja' ? 'selected' : ''; ?>>Baja</option>
                                            </select>
                                        </div>
                                        <?php foreach ($images as $img_field): ?>
                                            <div class="form-group mb-3">
                                                <label for="<?= $img_field; ?>">URL de
                                                    <?= ucfirst(str_replace('_', ' ', $img_field)); ?></label>
                                                <input type="url" class="form-control" name="<?= $img_field; ?>"
                                                    value="<?= $room[$img_field]; ?>">
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="form-group mb-3">
                                            <label for="description">Descripción</label>
                                            <textarea class="form-control" name="description" id="description" required
                                                pattern="[A-Za-zÀ-ÿ\s]+" title="Solo se permiten letras, acentos y espacios.">
                                                <?= htmlspecialchars($room['description']); ?>
                                            </textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="price">Precio</label>
                                            <input type="number" class="form-control" name="price" id="price" value="<?= $room['price']; ?>"
                                                required step="1" max="1000.00" title="El precio no puede superar los 1000.00">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="capacity">Capacidad</label>
                                            <input type="number" class="form-control" name="capacity" id="capacity" value="<?= $room['capacity']; ?>"
                                                required max="10" title="La capacidad máxima es de 10">
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" name="update_room" class="btn btn-primary me-2">Actualizar</button>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>