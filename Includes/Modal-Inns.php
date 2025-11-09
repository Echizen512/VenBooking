<!-- Modal -->
<div class="modal fade" id="posadaModal" tabindex="-1" role="dialog" aria-labelledby="posadaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="posadaModalLabel">Registro de una Posada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" name="action" value="create">
                    <div class="form-group">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_url" class="form-label">URL de Imagen</label>
                        <input type="text" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="rif" class="form-label">RIF</label>
                        <input type="text" class="form-control" id="rif" name="rif" required pattern="^[JGVEP]-\d{8}-\d$" title="Formato válido: J-12345678-9">
                    </div>
                    <div class="form-group">
                        <label for="state" class="form-label">Estado</label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="">Seleccione un estado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="municipality" class="form-label">Municipio</label>
                        <select class="form-control" id="municipality" name="municipality" required>
                            <option value="">Seleccione un municipio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="parish" class="form-label">Parroquia</label>
                        <select class="form-control" id="parish" name="parish" required>
                            <option value="">Seleccione una parroquia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category" class="form-label">Categoría</label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Seleccione una categoría</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quality" class="form-label">Calidad</label>
                        <select class="form-control" name="quality" id="quality" required>
                            <option value="">Seleccione una calidad</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


 <!-- Modal de Editar -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editModalLabel">Editar Posada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="">
                    <input type="hidden" id="edit-id" name="id">
                    <input type="hidden" name="action" value="edit">
                    <div class="form-group">
                        <label for="edit-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-image_url" class="form-label">URL de Imagen</label>
                        <input type="text" class="form-control" id="edit-image_url" name="image_url" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="edit-phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-rif" class="form-label">RIF</label>
                        <input type="text" class="form-control" id="edit-rif" name="rif" required pattern="^[JGVEP]-\d{8}-\d$" title="Formato válido: J-12345678-9">
                    </div>
                    <div class="form-group">
                        <label for="edit-state" class="form-label">Estado</label>
                        <select class="form-control" id="edit-state" name="state" required>
                            <option value="">Seleccione un estado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-municipality" class="form-label">Municipio</label>
                        <select class="form-control" id="edit-municipality" name="municipality" required>
                            <option value="">Seleccione un municipio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-parish" class="form-label">Parroquia</label>
                        <select class="form-control" id="edit-parish" name="parish" required>
                            <option value="">Seleccione una parroquia</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-category" class="form-label">Categoría</label>
                        <select class="form-control" id="edit-category" name="category" required>
                            <option value="">Seleccione una categoría</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quality" class="form-label">Calidad</label>
                        <select class="form-control" name="quality" id="edit-quality" required>
                            <option value="">Seleccione una calidad</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
