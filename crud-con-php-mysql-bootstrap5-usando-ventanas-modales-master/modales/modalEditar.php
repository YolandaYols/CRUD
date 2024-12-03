    <div class="modal fade" id="editarEmpleadoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 titulo_modal">Actualizar Información Empleado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formularioEmpleadoEdit" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="hidden" name="id" id="idempleado" />
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cédula (NIT)</label>
                            <input type="text" name="cedula" id="cedula" class="form-control" />
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Seleccione la edad</label>
                                <select class="form-select" name="edad" id="edad" required>
                                    <option value="">Edad</option>
                                    <?php
                                    for ($i = 18; $i <= 50; $i++) {
                                        echo "<option value='$i'>$i</option>";
                                    } ?>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Sexo</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_m" value="Masculino" checked>
                                    <label class="form-check-label" for="sexo_m">
                                        M
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sexo" id="sexo_f" value="Femenino">
                                    <label class="form-check-label" for="sexo_f">
                                        F
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Salario</label>
                            <input type="text" name="salario" id="salario" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Seleccione el Cargo</label>
                            <select name="cargo" id="cargo" class="form-select" required>
                                <option selected value="">Cargo</option>
                                <?php
                                $cargos = array(
                                    "Gerente",
                                    "Asistente",
                                    "Analista",
                                    "Frontend",
                                    "Backend",
                                    "Desarrollador Web",
                                    "Tester",
                                    "FullStack"
                                );
                                foreach ($cargos as $cargo) {
                                    echo "<option value='$cargo'>$cargo</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn_add" onclick="actualizarEmpleado(event)">
                                Actualizar datos del empleado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
