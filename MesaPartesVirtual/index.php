
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        Mesa de Partes Virtual - HACDP
    </title>
    <link rel="stylesheet" href="../public/assets/css/mspartes.css">
    <link rel="stylesheet" href="../public/assets/dist/css/adminlte.min1.css">
    <link rel="shorcut icon" href="../public/assets/img/logo.png">
    <link rel="stylesheet" href="../public/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../public/assets/plugins/fontawesome-free/css/all.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="../public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="../public/assets/plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2()
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
    <script>
        function validaNumericos(event) {
            if (event.charCode >= 48 && event.charCode <= 57) {
                return true;
            }
            return false;
        }

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#mostrar').hide();
            $("input[name='customRadio']").change(function () {
                if ($(this).val() == 'juridica') {
                    $('#mostrar').show();
                }
                else {
                    $('#mostrar').hide();
                }
            });
        });

    </script>

</head>

<body>

    <header id="expediente">
        <div data-v-269f0572="">
            <nav data-v-269f0572="" role="navigation" class="navbar navbar-gorehco navbar-static-top">
                <div data-v-269f0572="" class="container1">
                    <div data-v-269f0572="" class="Navbar-wrapper">
                        <a data-v-269f0572="" href="#" class="img">
                            <a></a>
                            <img data-v-269f0572="" src="../public/assets/img/logo.png" alt="" style="width: 50px;height: 50px;"></a>
                        <a data-v-269f0572="" href="" class="navbar-brand">HOSPITAL ANTONIO CALDAS DOMíNGUEZ -
                            POMABAMBA</a>
                        <a data-v-269f0572="" href="../index.html" class="btn btn-sm btn-success">Ir a Página Principal</a>
                        <a></a>
                        <a></a>
                    </div>
                </div>
            </nav>
            <div data-v-269f0572="" class="container">
                <div data-v-269f0572="" class="card card-principal mb-3">
                    <div data-v-269f0572="" class="card-header font-weight-bold">MESA DE PARTES VIRTUAL</div>
                        <div style="margin-top:10px;">                    
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-dark btn-block"><i class="fa fa-plus"></i>&nbsp;Nuevo Trámite</button>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-outline-success btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Seguimiento</button>
                            </div>
                        </div>
                    <div data-v-269f0572="" class="card-body">
                        <!--CONTENIDO DE LA TARJETA-->
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">DATOS DEL REMITENTE</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <label>Tipo de Persona: </label><span style="color: red;font-weight: 600;">
                                            (*)</span>
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio1"
                                                        name="customRadio" checked value="natural">
                                                    <label for="customRadio1"
                                                        class="custom-control-label">Natural</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" id="customRadio2"
                                                        name="customRadio" value="juridica">
                                                    <label for="customRadio2"
                                                        class="custom-control-label">Jurídica</label>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div id="mostrar">
                                            <div class="form-group">
                                                <label>RUC </label><span style="color: red;font-weight: 600;">
                                                    (*)</span>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    onkeypress="return validaNumericos(event)" maxlength="11"
                                                    minlength="11">
                                            </div>

                                            <div class="form-group">
                                                <label>Entidad </label><span style="color: red;font-weight: 600;">
                                                    (*)</span>
                                                <input type="text" class="form-control" id="exampleInputEmail1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>DNI</label><span style="color: red;font-weight: 600;">
                                                        (*)</span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        onkeypress='return validaNumericos(event)' maxlength="8"
                                                        minlength="8">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Nombres </label><span style="color: red;font-weight: 600;">
                                                        (*)</span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Apellido Paterno </label><span
                                                        style="color: red;font-weight: 600;">
                                                        (*)</span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Apellido Materno </label><span
                                                        style="color: red;font-weight: 600;">
                                                        (*)</span>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>N° Celular </label><span style="color: red;font-weight: 600;">
                                                (*)</span>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                onkeypress='return validaNumericos(event)' minlength="9" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Dirección </label><span style="color: red;font-weight: 600;">
                                                (*)</span>
                                            <input type="text" class="form-control" id="exampleInputEmail1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Correo </label><span style="color: red;font-weight: 600;"> (*)</span>
                                            <input type="text" class="form-control" id="exampleInputEmail1" required>
                                        </div>
                                        <span style="color: #ff0000;font-weight: 600;">Campos Obligatorios (*)</span>
                                    </div>
                                    <!-- /.card-body -->

                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="col-md-6">
                            <!-- general form elements -->
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">DATOS DEL DOCUMENTO</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Tipo</label><span style="color: red;font-weight: 600;"> (*)</span>
                                            <select class="form-control select2 select2-danger select2-hidden-accessible" 
                                            data-dropdown-css-class="select2-danger" style="width: 100%;height: 100%;"
                                                data-select2-id="12"  aria-hidden="true">
                                                <option>CARTA</option>
                                                <option>OFICIO</option>
                                                <option>OFICIO MULTIPLE</option>
                                                <option>SOLICITUD</option>
                                                <option>MEMORANDUM</option>
                                                <option>OTROS</option>
                                                </select><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                        </div>
                                        <div class="form-group">
                                            <label>N° Folios </label><span style="color: red;font-weight: 600;">
                                                (*)</span>
                                            <input type="number" class="form-control" id="exampleInputEmail1" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Asunto </label><span style="color: red;font-weight: 600;">
                                                (*)</span>
                                            <textarea class="form-control" rows="3"
                                                placeholder="Ingrese el asunto del documento" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Adjuntar archivo (pdf.)</label><span style="color: red;font-weight: 600;">
                                                (*)</span>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Elegir el Archivo</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Subir</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input custom-control-input-danger"
                                                type="checkbox" id="customCheckbox4" value="option1" required>

                                            <label for="customCheckbox4" class="custom-control-label">Declaro que la
                                                información proporcionada es válida y verídica.
                                                Y Acepto que las comunicaciones sean enviadas a la dirección de corre y
                                                celular que proporcione.<span
                                                    style="color: red;font-weight: 600;">(*)</span></label>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary"></input>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->

                            <!-- general form elements -->


                        </div>
                        <!--FIN CONTENIDO DE LA TARJETA-->
                    </div>

                </div>
            </div>
        </div>

    </header>

    </body>

</html>