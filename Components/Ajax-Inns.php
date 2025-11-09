<script>
          document.addEventListener("DOMContentLoaded", function () {
            <?php if ($message): ?>
                Swal.fire({
                    title: '<?php echo $messageType === "success" ? "Éxito" : "Error"; ?>',
                    text: '<?php echo $message; ?>',
                    icon: '<?php echo $messageType; ?>',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        <?php if ($messageType === "success"): ?>
                            window.location.href = 'get_inns.php';
                        <?php endif; ?>
                    }
                });
            <?php endif; ?>
        });

        $(document).ready(function () {
            $('#editModal').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget);
                const stateId = button.data('state_id');
                const municipalityId = button.data('municipality_id');
                const parishId = button.data('parish_id');

                loadStates(function () {
                    $('#edit-state').val(stateId);
                    loadMunicipalities(stateId, function () {
                        $('#edit-municipality').val(municipalityId);
                        loadParishes(municipalityId, function () {
                            $('#edit-parish').val(parishId);
                        });
                    });
                });
            });

            $('#edit-state').on('change', function () {
                const stateId = $(this).val();
                loadMunicipalities(stateId, function () {
                    $('#edit-municipality').val('');
                    $('#edit-parish').html('<option value="">Seleccione una parroquia</option>');
                });
            });

            $('#edit-municipality').on('change', function () {
                const municipalityId = $(this).val();
                loadParishes(municipalityId);
            });
        });


        $(document).ready(function () {
            $('#innsTable').on('click', '.btn-primary[data-target="#editModal"]', function () {
                const id = $(this).data('id');
                const name = $(this).data('name');
                const description = $(this).data('description');
                const email = $(this).data('email');
                const phone = $(this).data('phone');
                const rif = $(this).data('rif');
                const imageUrl = $(this).data('image_url');
                const stateId = $(this).data('state_id');
                const municipalityId = $(this).data('municipality_id');
                const parishId = $(this).data('parish_id');
                const categoryId = $(this).data('category_id');
                const quality = $(this).data('quality');
                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-description').val(description);
                $('#edit-email').val(email);
                $('#edit-phone').val(phone);
                $('#edit-rif').val(rif);
                $('#edit-image_url').val(imageUrl);
                $('#edit-state').val(stateId);
                $('#edit-municipality').val(municipalityId);
                $('#edit-parish').val(parishId);
                $('#edit-category').val(categoryId);
                $('#edit-quality').val(quality);
                $('#editModal').modal('show');
            });
        });

        $(document).ready(function () {
            $('#innsTable').DataTable();
            loadStates();
            loadCategories();
            $('.btn-edit').on('click', function () {
                populateEditModal($(this));
            });
            $('#state').on('change', function () {
                loadMunicipalities($(this).val());
                resetParishes();
            });
            $('#municipality').on('change', function () {
                loadParishes($(this).val());
            });
            $('.toggle-block').on('click', function () {
                toggleBlock($(this));
            });
        });

        function loadCategories() {
            $.ajax({
                url: '../PHP/get-categories.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#category', 'No se encontraron categorías');
                },
                error: function () {
                    showAlert('No se pudo cargar las categorías');
                }
            });
        }

        function loadMunicipalities(state_id) {
            $('#municipality').html('<option value="">Seleccione un municipio</option>');
            resetParishes();

            if (state_id) {
                $.ajax({
                    url: '../PHP/get-municipalities.php',
                    method: 'GET',
                    data: { state_id: state_id },
                    success: function (data) {
                        handleLoadResponse(data, '#municipality', 'No se encontraron municipios');
                    },
                    error: function () {
                        showAlert('No se pudo cargar los municipios');
                    }
                });
            }
        }

        function loadParishes(municipality_id) {
            $('#parish').html('<option value="">Seleccione una parroquia</option>');

            if (municipality_id) {
                $.ajax({
                    url: '../PHP/get-parishes.php',
                    method: 'GET',
                    data: { municipality_id: municipality_id },
                    success: function (data) {
                        handleLoadResponse(data, '#parish', 'No se encontraron parroquias');
                    },
                    error: function () {
                        showAlert('No se pudo cargar las parroquias');
                    }
                });
            }
        }

        function handleLoadResponse(data, selectId, errorMessage) {
            try {
                const items = JSON.parse(data);
                if (items.length > 0) {
                    $(selectId).append(items.map(item => `<option value="${item.id}">${item.name}</option>`));
                } else {
                    showAlert(errorMessage);
                }
            } catch (error) {
                showAlert('Error al procesar los datos');
            }
        }

        function showAlert(message) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: message,
            });
        }

        function resetParishes() {
            $('#parish').html('<option value="">Seleccione una parroquia</option>');
        }

        function populateEditModal(button) {
            $('#edit-id').val(button.data('id'));
            $('#edit-name').val(button.data('name'));
            $('#edit-description').val(button.data('description'));
            $('#edit-email').val(button.data('email'));
            $('#edit-phone').val(button.data('phone'));
            $('#edit-rif').val(button.data('rif'));
            $('#edit-image_url').val(button.data('image_url'));
            loadStates(function () {
                $('#edit-state').val(button.data('state_id'));
                loadMunicipalities(button.data('state_id'), function () {
                    $('#edit-municipality').val(button.data('municipality_id'));
                    loadParishes(button.data('municipality_id'), function () {
                        $('#edit-parish').val(button.data('parish_id'));
                    });
                });
            });
            loadCategories(function () {
                $('#edit-category').val(button.data('category_id'));
            });
        }
        function loadStates(callback) {
            $.ajax({
                url: '../PHP/get-states.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#state, #edit-state', 'No se encontraron estados');
                    if (callback) callback();
                },
                error: function () {
                    showAlert('No se pudo cargar los estados');
                }
            });
        }

        function loadMunicipalities(state_id, callback) {
            $('#municipality, #edit-municipality').html('<option value="">Seleccione un municipio</option>');
            resetParishes();

            if (state_id) {
                $.ajax({
                    url: '../PHP/get-municipalities.php',
                    method: 'GET',
                    data: { state_id: state_id },
                    success: function (data) {
                        handleLoadResponse(data, '#municipality, #edit-municipality', 'No se encontraron municipios');
                        if (callback) callback();
                    },
                    error: function () {
                        showAlert('No se pudo cargar los municipios');
                    }
                });
            }
        }

        function loadParishes(municipality_id, callback) {
            $('#parish, #edit-parish').html('<option value="">Seleccione una parroquia</option>');

            if (municipality_id) {
                $.ajax({
                    url: '../PHP/get-parishes.php',
                    method: 'GET',
                    data: { municipality_id: municipality_id },
                    success: function (data) {
                        handleLoadResponse(data, '#parish, #edit-parish', 'No se encontraron parroquias');
                        if (callback) callback();
                    },
                    error: function () {
                        showAlert('No se pudo cargar las parroquias');
                    }
                });
            }
        }

        function loadCategories(callback) {
            $.ajax({
                url: '../PHP/get-categories.php',
                method: 'GET',
                success: function (data) {
                    handleLoadResponse(data, '#category, #edit-category', 'No se encontraron categorías');
                    if (callback) callback();
                },
                error: function () {
                    showAlert('No se pudo cargar las categorías');
                }
            });
        }


        function toggleBlock(button) {
            const id = button.data('id');
            const block = button.data('block');
            $.ajax({
                url: '../PHP/toggle-block.php',
                method: 'POST',
                data: { id: id, block: block },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Posada actualizada',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    updateToggleButton(button, block);
                },
                error: function () {
                    showAlert('Hubo un problema al actualizar la posada');
                }
            });
        }

        function updateToggleButton(button, block) {
            if (block === 0) {
                button.removeClass('btn-danger').addClass('btn-success').html('<i class="fas fa-lock-open mr-2"></i> <span>Activo</span>');
                button.data('block', 1);
            } else {
                button.removeClass('btn-success').addClass('btn-danger').html('<i class="fas fa-lock mr-2"></i> <span>Bloqueado</span>');
                button.data('block', 0);
            }
        }
</script>