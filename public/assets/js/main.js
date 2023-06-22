$(document).ready(function() {
  $("#guardar").prop('disabled', true);
    var user_id,area_id, opcion,dniuser;
    opcion = 4;

  $('.rec').val(-1); 
  $("#HC").hide();
  $("#tablacitass").show(); 
  $("#cardate").hide(); 
  $("#arec").hide(); 
  $("#EditRES").prop('disabled', true);
  $("#SaveDES").prop('disabled', false);
  $("#ida").hide(); 
    dniuser = $('#dniuser').val();
/*=============================   MOSTRAR TABLA DE USUARIOS  ================================= */ 
    tablaUsuarios = $('#tablaUsuarios').DataTable({  
        "destroy":true,
          "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
          },
        "ajax":{            
            "url": "../../controller/crudusu.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion :opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "idusuarios"},
            {"data": "nombre"},
            {"data": "dni"},
            {"data": "rol"},
            {"data": "email"},
            {"data": 'estado',"render": function (data, type) {
              let country = '';
              switch (data) {
                  case 'ACTIVO':
                      country = 'bg-success';
                      break;
                  case 'DESACTIVADO':
                      country = 'bg-gray';
                      break;
              }
              return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
      }
    },
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-warning btn-sm btnEditfoto'><i class='material-icons'>account_circle</i></button></div></div>"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-secondary btn-sm btnpsw'><i class='material-icons'>lock</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     
  /*=============================   MOSTRAR TABLA CITAS  ================================= */
  tablaCitas = $('#tablaCitas').DataTable({  
    "destroy":true,
    "order": [[ 1, "desc" ]],
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudcita.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "Fecha"},
        {"data": "Hora"},
        {"data": "Paciente"},
        {"data": "Médico"},
        {"data": "especialidad"},
        {"data": "Consultorio"},
        {"data": 'estado',"render": function (data, type) {
          let country = '';
          switch (data) {
              case 'Registrado':
                  country = 'bg-dark';
                  break;
              case 'Atendido':
                  country = 'bg-success';
                  break;
              case 'No Asistió':
                  country = 'bg-danger';
                  break;
              case 'Triaje':
                country = 'bg-warning';
                break;
          }
          return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
  }
},  
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarCi'><i class='material-icons'>visibility</i></button><button class='btn btn-danger btn-sm btnBorrarCi'><i class='material-icons'>delete</i></button><button class='btn btn-dark btn-sm reportci'><i class='material-icons'>print</i></button></div></div>"}
    ]

});
  /*=============================   MOSTRAR TABLA DE AREAS  ================================= */
  tablaEspecialidad = $('#tablaEspecialidad').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudespecialidad.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "idespecialidad"},
        {"data": "especialidad"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarEs'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarEs'><i class='material-icons'>delete</i></button></div></div>"}
    ]
}); 

  /*=============================   MOSTRAR TABLA DE CONSULTORIOS  ================================= */
  tablaConsultorio = $('#tablaConsultorio').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudconsultorio.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "idconsultorio"},
        {"data": "numcons"},
        {"data": "nomcons"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarCons'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarCons'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});
  /*=============================   MOSTRAR TABLA DE PACIENTES  ================================= */
  tablaPacientes = $('#tablaPacientes').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudpaciente.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "DNI"},
        {"data": "Paciente"},
        {"data": "ALERGIA"},
        {"data": "NROHC"},
        {"data": "establec"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarPa'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorraPa'><i class='material-icons'>delete</i></button></div></div>"}
    ]
}); 
  /*=============================   MOSTRAR TABLA DE HORARIOS  ================================= */
  tablaHorarios = $('#tablaHorarios').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudhorarios.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "cupos"},
        {"data": "fecha"},
        {"data": "turno"},
        {"data": "nomcons"},
        {"data": "especialidad"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarHo'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarHo'><i class='material-icons'>delete</i></button></div></div>"}
    ]
}); 
  /*=============================   MOSTRAR TABLA DE ADMINISTRATIVOS  ================================= */
  tablaAdmin = $('#tablaAdmin').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudadministrativo.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "DNI"},
        {"data": "Personal"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarAd'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarAd'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});
  /*=============================   MOSTRAR TABLA DE MEDICOS  ================================= */
  tablaMedicos = $('#tablaMedicos').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudmedico.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "DNI"},
        {"data": "codigo"},
        {"data": "Personal"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarMe'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarMe'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});

  /*=============================   MOSTRAR TABLA DE ASIGNACIÓN  ================================= */
  tablaAsignacion = $('#tablaAsignacion').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudasignacion.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "codigo"},
        {"data": "Medico"},
        {"data": "especialidad"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarAs'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarAs'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});

  /*=============================   MOSTRAR TABLA DE MEDICAMENTOS  ================================= */
  tablaMedicina = $('#tablaMedicina').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudmedicina.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "denom"},
        {"data": "stock"},
        {"data": "fecha"},
        {"data": "tipo"},
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditarA'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrarA'><i class='material-icons'>delete</i></button></div></div>"}
    ]
});

  /*=============================   MOSTRAR TABLA CITAS  ================================= */
  tablaCitasProgramadas = $('#tablaCitasProgramadas').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudatencion.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion, dniuser}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
      {"data": "ID"},
      {"data": "registrado"},
      {"data": "Fecha"},
      {"data": "Hora"},
      {"data": "dni"},
      {"data": "Paciente"},
      {"data": "especialidad"},
      {"data": 'estado',"render": function (data, type) {
            let country = '';
            switch (data) {
                case 'Registrado':
                    country = 'bg-dark';
                    break;
                case 'Atendido':
                    country = 'bg-success';
                    break;
                case 'No Asistió':
                    country = 'bg-danger';
                    break;
                case 'Triaje':
                  country = 'bg-warning';
                  break;
            }
            return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
    }
  },
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn bg-danger btn-sm btnAtencion' title='Realizar Atención'><span class='material-icons'>edit_note</span></button><button class='btn bg-cyan btn-sm btnHistCl' title='Mostrar Historia Clínica'><span class='material-icons'>assignment</span></button></div></div>"}
    ]

});

TablaTriaje = $('#TablaTriaje').DataTable({  
  "destroy":true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
  "ajax":{            
      "url": "../../controller/crudtriaje.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
  },
  "columns":[
      {"data": "ID"},
      {"data": "registrado"},
      {"data": "Fecha"},
      {"data": "Hora"},
      {"data": "Paciente"},
      {"data": "Médico"},
      {"data": "especialidad"},
      {"data": 'estado',"render": function (data, type) {
            let country = '';
            switch (data) {
                case 'Registrado':
                    country = 'bg-dark';
                    break;
                case 'Atendido':
                    country = 'bg-success';
                    break;
                case 'No Asistió':
                    country = 'bg-danger';
                    break;
                case 'Triaje':
                  country = 'bg-warning';
                  break;
            }
            return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
    }
  },
      {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn bg-danger btn-sm btnTri' title='Ver e insertar datos clínicos'><span class='material-icons'>visibility</span></button></div></div>"}
  ]

});

tablaRecetas = $('#tablaRecetas').DataTable({  
  "destroy":true,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
  "ajax":{            
      "url": "../../controller/crudrecetas.php", 
      "method": 'POST', //usamos el metodo POST
      "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
      "dataSrc":""
  },
  "columns":[
      {"data": "idreceta"},
      {"data": "paciente"},
      {"data": "fech"},
      {"data": "hor"},
      {"data": 'estado',"render": function (data, type) {
            let country = '';
            switch (data) {
                case 'Por Recoger':
                    country = 'bg-warning';
                    break;
                case 'Recogido':
                    country = 'bg-success';
                    break;
                case 'No Recogido':
                    country = 'bg-danger';
                    break;
            }
            return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
    }
  },
      {"data": 'estado',"render": function (data, type) {
        let country = '';
        switch (data) {
            case 'Por Recoger':
                country = "<div class='text-center'><div class='btn-group'><button class='btn bg-danger btn-sm btnDescr' title='Ver detalles'><span class='material-icons'>visibility</span></button><button class='btn bg-success btn-sm btnentre' title='Cambiar a Recogido'><span class='material-icons'>done</span></button></div></div>";
                break;
            case 'Recogido':
                country = "<div class='text-center'><div class='btn-group'><button class='btn bg-danger btn-sm btnDescr' title='Ver detalles'><span class='material-icons'>visibility</span></button><button disabled class='btn bg-success btn-sm btnentre' title='Cambiar a Recogido'><span class='material-icons'>done</span></button></div></div>";
                break;
            case 'No Recogido':
                country = 'bg-danger';
                break;
        }
        return  country;  
        }
      }
  ]

});
    var fila; //captura la fila, para editar o eliminar

  /*=============================   INICIO DE CRUD DE LAS TABLAS  ================================= */


  /*=============================   CRUD DE TABLA USUARIOS  ================================= */
  $("#idni").blur(function () { //Validar Existencia de DNI
    //Consulta de disponibilidad de DNI al cambiar el click
    idni = $("#idni").val();
    if (idni.length == 0) {
      $("#Aviso").text("Ingrese el Número de DNI").css("color", "red");
    } else {
      if (idni.length == 8) {
        opcion = 5;
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, idni: idni },
          success: function (response) {
            switch (response) {
              case "1":
                $("#Aviso").text("DNI ya está registrado").css("color", "red");
                break;
              case "2":
                $("#Aviso").text("DNI no registrado").css("color", "green");
                break;
              default:
                $("#Aviso").text("Error").css("color", "red");
                break;
            }
          },
        });
      } else {
        $("#Aviso").text("El DNI debe tener 8 dígitos.").css("color", "red");
      }
    }
  });

  // $("#idni").keypress(function(e) { //Consulta de disponibilidad de DNI al dar enter
  //   if(e.which == 13) {
  //     e.preventDefault();
  //     idni = $('#idni').val();
  //     if(idni.length == 0){
  //       $('#Aviso').text("Ingrese el Número de DNI").css("color","red");
  //     }else{
  //       if(idni.length == 8){
  //         opcion = 5;
  //         $.ajax({
  //           url: "../../controller/crudusu.php",
  //           type: "POST",
  //           datatype:"json",
  //           data:  {opcion:opcion, idni:idni},
  //           success: function(response) {
  //             switch(response){
  //               case '1':
  //                 $('#Aviso').text("DNI ya está registrado").css("color","red");
  //                 break;
  //               case '2':
  //                 $('#Aviso').text("DNI no registrado").css("color","green");
  //                 break;
  //               default:
  //                 $('#Aviso').text("Error").css("color","red");
  //                 break;
  //             }
  //           }
  //         });
  //       }else{
  //         $('#Aviso').text("El DNI debe tener 8 dígitos.").css("color","red");
  //       }
  //     }
  //   }
  // });
  //submit para el Alta y Actualización

  $("#iemail").blur(function () {
    //Consulta de disponibilidad de EMAIL al cambiar el click
    iemail = $.trim($("#iemail").val());
    if (iemail.length == 0) {
      $("#AvisoE").text("Ingrese el Email").css("color", "red");
    } else {
      if(ValidarCorreo(correo) == false){
        $("#AvisoE").text("Formato no válido").css("color", "red");
      }else{
        opcion = 7;
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, iemail: iemail },
          success: function (response) {
            switch (response) {
              case "1":
                $("#AvisoE").text("Email ya registrado").css("color", "red");
                break;
              case "2":
                $("#AvisoE").text("Email no registrado").css("color", "green");
                break;
              default:
                $("#AvisoE").text("Error").css("color", "red");
                break;
            }
          },
        });
      }
    }
  });

  $('#iemail').keyup(function(){
    correo=$('#iemail').val();
    if(ValidarCorreo(correo) == false){
      $("#AvisoE").text("Formato no válido").css("color", "red");
    }else{
      $("#AvisoE").text("Formato válido").css("color", "green");
    }
  });

  $("#inomusu").blur(function () {
    //Consulta de disponibilidad de EMAIL al cambiar el click
    inomusu = $.trim($("#inomusu").val());
    if (inomusu.length == 0) {
      $("#error1").text("Ingrese el Nombre de Usuario").css("color", "red");
    } else {
      opcion = 8;
      $.ajax({
        url: "../../controller/crudusu.php",
        type: "POST",
        datatype: "json",
        data: { opcion: opcion, inomusu: inomusu },
        success: function (response) {
          switch (response) {
            case "1":
              $("#error1")
                .text("Nombre de Usuario no Disponible")
                .css("color", "red");
              break;
            case "2":
              $("#error1")
                .text("Nombre de Usuario Disponible")
                .css("color", "green");
              break;
            default:
              $("#error1").text("Error").css("color", "red");
              break;
          }
        },
      });
    }
  });

  //para limpiar los campos antes de dar de Alta una Persona
  $("#Nuevo").click(function () {
    opcion = 1; //alta
    user_id = null;
    limpiarcampos();
    $("#guardar").prop('disabled', true);
    $("#modalusuario").modal({ backdrop: "static", keyboard: false });
  });

  
  $("#guardar").click(function () { // Guardar Datos del Usuario
    opcion = 1;
    idni = $.trim($("#idni").val());
    inombre = $.trim($("#inombre").val());
    iappat = $.trim($("#iappat").val());
    iapmat = $.trim($("#iapmat").val());
    icel = $.trim($("#icel").val());
    idir = $.trim($("#idir").val());
    iemail = $.trim($("#iemail").val());
    inomusu = $.trim($("#inomusu").val());
    tipo = $("#tipo").val();
    ipassco = $("#ipassco").val();
    if(idni.length < 8 || inombre.length == 0 || iappat.length == 0 || iapmat.length == 0 || icel.length < 9  || idir.length == 0
      || iemail.length == 0  || inomusu.length == 0 || ipassco.length == 0){
      alert('Porfavor Complete todos los campos');
    }else{
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Guardar los datos ingresados",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, guardar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {
              idni: idni,
              inombre: inombre,
              iappat: iappat,
              iapmat: iapmat,
              icel: icel,
              idir: idir,
              iemail: iemail,
              inomusu: inomusu,
              tipo: tipo,
              ipassco: ipassco,
              opcion: opcion,
            },
            success: function (data) {
              limpiarcampos();
              MostrarAlerta("Hecho", "Se agregó el registro", "success");
              tablaUsuarios.ajax.reload(null, false);
              $("#modalusuario").modal("hide");
            },
          });
        }
      });
    }
    
  });

  //Mostrar datos a Editar
  $(document).on("click", ".btnEditar", function () {//Mostrar datos de usuario para edicion
    opcion = 6;
    fila = $(this).closest("tr");
    user_id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    idni = fila.find("td:eq(2)").text();
    $.ajax({
      url: "../../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, user_id: user_id, idni: idni },
      success: function (response) {
        data = $.parseJSON(response);
        $("#idusuario").val(data[0]["ID1"]);
        $("#idpersona").val(data[0]["ID2"]);
        $("#idni1").val(data[0]["dni"]);
        $("#inombre1").val(data[0]["nombres"]);
        $("#iappat1").val(data[0]["ap"]);
        $("#iapmat1").val(data[0]["am"]);
        $("#icel1").val(data[0]["telefono"]);
        $("#idir1").val(data[0]["direccion"]);
        $("#iemail1").val(data[0]["email"]);
        $("#inomusu1").val(data[0]["nombre"]);
        $("#tipo1").val(data[0]["IDR"]);
        $("#estado1").val(data[0]["estado"]);

        $("#modalEdusuario").modal({ backdrop: "static", keyboard: false });
      },
    });
  });

  $("#CancelEdU").click(function () {
    ResetForm('formEdit');
  });

 //EDITAR DATOS DE USUARIO
 $("#Editar").click(function () {
  opcion = 2;
  idper = $("#idpersona").val();
  user_id = $("#idusuario").val();
  idni = $.trim($("#idni1").val());
  inombre = $.trim($("#inombre1").val());
  iappat = $.trim($("#iappat1").val());
  iapmat = $.trim($("#iapmat1").val());
  icel = $.trim($("#icel1").val());
  idir = $.trim($("#idir1").val());
  iemail = $.trim($("#iemail1").val());
  inomusu = $.trim($("#inomusu1").val());
  tipo = $("#tipo1").val();
  estado = $("#estado1").val();
  if (idni.length <= 7 || inombre.length <= 0 || iappat.length <= 0 || iapmat.length <= 0 || icel.length < 9 || idir.length <= 0 || iemail.length <= 0
    || inomusu.length <= 0) {
    alert("Debe Completar correctamente todos los campos");
  } else {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Editar los datos del usuario",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: {opcion: opcion,idper:idper,user_id:user_id,idni:idni,inombre:inombre,iappat:iappat,iapmat:iapmat,icel:icel,idir:idir,iemail:iemail,inomusu:inomusu,tipo:tipo,estado:estado},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              alert(
                "Hay registros que se repiten, asegurese de ingresar valores únicos"
              );
            } else {
              if (data == 2) {

                limpiarcampos();
                MostrarAlerta("Hecho", "Usted realizo el cambio", "success");
                tablaUsuarios.ajax.reload(null, false);
                $("#modalEdusuario").modal("hide");
              } else {
                limpiarcampos();
                MostrarAlerta("Hecho","Los datos fueron actualizados","success");
                tablaUsuarios.ajax.reload(null, false);
                $("#modalEdusuario").modal("hide");
              }
            }
          },
        });
      }
    });
  }
});


  $(document).on("click", ".btnEditfoto", function () {
    $("#FotoP").attr("src",""); 
    opcion = 6;
    fila = $(this).closest("tr");
    user_id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    idni = fila.find("td:eq(2)").text();
    $.ajax({
      url: "../../controller/crudusu.php",
      type: "POST",
      datatype: "json",
      data: { opcion: opcion, user_id: user_id, idni: idni },
      success: function (response) {
        data = $.parseJSON(response);
        $('#iddni1').val(idni);
        $('#idusua').val(user_id);
        $("#FotoP").attr("src","/SistemaAtencion/" + data[0]["foto"]);
        $("#modalfoto").modal("show");
        
      },
    });
  });


  $(document).on("click", ".btnpsw", function () {
    fila = $(this);
    user_id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    usu = $(this).closest("tr").find("td:eq(1)").text();
    $("#modaleditpsw").modal({ backdrop: "static", keyboard: false });
    $('#idc').text(usu);
  });

 
  //Borrar usuario
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    idni = parseInt($(this).closest("tr").find("td:eq(2)").text());
    opcion = 3;
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se eliminará al usuario seleccionado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: { opcion: opcion, idni:idni},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta("No se puede eliminar","Elimine los datos asociados al documento","error");    
            }else{
              MostrarAlerta("Hecho", "Se eiiminó al usuario", "success");
              tablaUsuarios.row(fila.parents("tr")).remove().draw();
            }
          },
        });
      }
    });
  });

    //EDITAR CONTRASEÑA
    $("#BtnContra").click(function () {
      opcion = 9;
      ipswa = $("#ipsw").val();
      ipsw = $("#ipasss1").val();
      ipswn = $("#ipassco1").val();
      if (ipswa.length <= 0 || ipsw.length <= 0 || ipswn.length <= 0) {
        alert("Los campos no deben estar vacios");
      } else {
        Swal.fire({
          title: "¿Estás seguro?",
          text: "Se hará el cambio de contraseña",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          cancelButtonText: "Cancelar",
          confirmButtonText: "Si, Actualizar",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "../../controller/crudusu.php",
              type: "POST",
              datatype: "json",
              data: {opcion:opcion,user_id:user_id,ipswa:ipswa,ipswn:ipswn},
              success: function (response) {
                data = $.parseJSON(response);
                if (data == 1) {
                   MostrarAlerta("Incorrecto", "La contraseña actual ingresada es incorrecta", "error");
                } else {
                  $("#modaleditpsw").modal("hide");
                  ResetForm("formC");
                  $("#error3").text("");
                  MostrarAlerta("Éxito", "Se hizo el cambio de contraseña", "success");
                }
              },
            });
          }
        });
      }
    });

    $("#SalirC").click(function () {
      ResetForm("formC");
      $("#error3").text("");
    });

    //CAMBIO DE FOTO
    $("#FormFoto").on('submit', function(e){
      e.preventDefault();
      opcion = 10;
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Cambiar la foto de perfil",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Actualizar",
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: '../../controller/crudusu.php',
                data: new FormData(this),
                contentType: false,
                processData:false,
                beforeSend: function(){},
                success: function(msg){
                  MostrarAlerta("Hecho", "Se hizo el cambio de la foto de perfil", "success");
                  ResetForm('FormFoto');  
                  $("#modalfoto").modal("hide");
                  $("#FotoP").attr("src","");
                }
            });
      }
    });
  });

    $("#idfile1").change(function() {// Validar solo elegir jpg
      var file = this.files[0];
      var imagefile = file.type;
      var match= "image/jpeg";
      if(imagefile != match){
          alert('Porfavor selecciona un imagen de tipo: JPG.');
          $("#idfile1").val('');
          return false;
      }
  });
  
  $("#idfilep").change(function() {// Validar solo elegir jpg GENERAL
    var file = this.files[0];
    var imagefile = file.type;
    var match= "image/jpeg";
    if(imagefile != match){
        alert('Porfavor selecciona un imagen de tipo: JPG.');
        $("#idfilep").val('');
        return false;
    }else{
        
    }
});

$('#contra').click(function(){
  $("#modaleditpswG").modal({ backdrop: "static", keyboard: false });
});

$("#BtnContraG").click(function () {
    opcion = 9;
    user_id = $("#iduser").val();
    ipswa = $("#ipsw").val();
    ipsw = $("#ipasss1").val();
    ipswn = $("#ipassco1").val();
    if (ipswa.length <= 0 || ipsw.length <= 0 || ipswn.length <= 0) {
      alert("Los campos no deben estar vacios");
    } else {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "Se hará el cambio de contraseña",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, Actualizar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/crudusu.php",
            type: "POST",
            datatype: "json",
            data: {opcion:opcion,user_id:user_id,ipswa:ipswa,ipswn:ipswn},
            success: function (response) {
              data = $.parseJSON(response);
              // alert(data);
              if (data == 1) {

                  MostrarAlerta("Incorrecto", "La contraseña actual ingresada es incorrecta", "error");
              } else {
                $("#modaleditpswG").modal("hide");
                ResetForm("formC");
                $("#error3").text("");
                MostrarAlerta("Éxito", "Se hizo el cambio de contraseña", "success");
              }
            },
          });
        }
      });
    }
  });

$("#Conf").click(function () {//Mostrar modal de datos del perfil
  opcion = 6;
  user_id = $("#iduser").val();
  idni = $("#dniuser").val();
  // alert(user_id+' '+idni);
  $.ajax({
    url: "../../controller/crudusu.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, user_id: user_id, idni: idni },
    success: function (response) {
      data = $.parseJSON(response);
      $("#idusup").val(data[0]["ID1"]);
      $("#idperp").val(data[0]["ID2"]);
      $("#idnip").val(data[0]["dni"]);
      $("#idnip").prop('readonly', true);
      $("#inombrep").val(data[0]["nombres"]);
      $("#iappatp").val(data[0]["ap"]);
      $("#iapmatp").val(data[0]["am"]);
      $("#icelp").val(data[0]["telefono"]);
      $("#idirp").val(data[0]["direccion"]);
      $("#iemailp").val(data[0]["email"]);
      $("#inomusup").val(data[0]["nombre"]);

      $("#modalUsu").modal({ backdrop: "static", keyboard: false });
    },
  });
});

$("#Actualizar").click(function () {
  opcion = 12;
  idper = $("#idperp").val();
  user_id = $("#idusup").val();
  inombre = $.trim($("#inombrep").val());
  iappat = $.trim($("#iappatp").val());
  iapmat = $.trim($("#iapmatp").val());
  icel = $.trim($("#icelp").val());
  idir = $.trim($("#idirp").val());
  iemail = $.trim($("#iemailp").val());
  inomusu = $.trim($("#inomusup").val());
  if (idni.length <= 7 || inombre.length <= 0 || iappat.length <= 0 || iapmat.length <= 0 || icel.length <= 0 || idir.length <= 0 || iemail.length <= 0
    || inomusu.length <= 0) {
    alert("Debe Completar correctamente todos los campos");
  } else {
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Editar los datos del usuario",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudusu.php",
          type: "POST",
          datatype: "json",
          data: {opcion: opcion,idper:idper,user_id:user_id,inombre:inombre,iappat:iappat,iapmat:iapmat,icel:icel,idir:idir,iemail:iemail,inomusu:inomusu},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              alert("El Email o nombre de usuario genera duplicidad");
            } else {
              if (data == 2) {

                limpiarcampos();
                MostrarAlerta("Hecho", "Usted realizo el cambio", "success");
                tablaUsuarios.ajax.reload(null, false);
                $("#modalEdusuario").modal("hide");
              } else {
                ResetForm('formperfil');
                MostrarAlerta("Hecho","Se actualizaron sus datos.","success");
                $("#modalUsu").modal("hide");
              }
            }
          },
        });
      }
    });
  }
});

$("#Fot").click(function () {//Mostrar modal de foto de perfil
      $("#modalfotop").modal({ backdrop: "static", keyboard: false });
});

$("#FormFotop").on('submit', function(e){
  e.preventDefault();
  opcion = 13;
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Cambiar la foto de su perfil",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, Actualizar",
  }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
            type: 'POST',
            url: '../../controller/crudusu.php',
            data: new FormData(this),
            contentType: false,
            processData:false,
            beforeSend: function(){},
            success: function(msg){
              alert(msg);
              MostrarAlerta("Hecho", "Se hizo el cambio de la foto de perfil", "success");
              $("#idfilep").val('');
              $("#modalfotop").modal("hide");
              
            }
        });
  }
});
});       
/*=============================   CRUD DE TABLA ESPECIALIDADES  ================================= */

$("#NuevoEs").click(function(){
  $('#editarE').hide(); 
  $("#modalespecialidad").modal({ backdrop: "static", keyboard: false });
});

$("#CerrarE").click(function(){
  // $("#espec").val('');
  LimpiarForm('formespec');
  $("#modalespecialidad").modal('hide');
});

$("#guardarE").click(function(){
  opcion = 1;
  espec = $("#espec").val();
  if(espec.length == 0){
    alert('Completa');
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Guardar la especialidad",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudespecialidad.php",
          type: "POST",
          datatype: "json",
          data: { espec: espec, opcion: opcion},
          success: function (respuesta) {
            data = $.parseJSON(respuesta);
            if (data == 1) {
              alert("Ya hay una especialidad con ese nombre");
            } else {
              LimpiarForm('formespec');
              MostrarAlerta("Hecho", "Se agregó la especialidad", "success");
              tablaEspecialidad.ajax.reload(null, false);
              $("#modalespecialidad").modal("hide");
            }
          },
        });

      }
    });
  }
});


$(document).on("click", ".btnEditarEs", function(){
  opcion = 5;
  fila = $(this);           
  idespec= parseInt($(this).closest('tr').find('td:eq(0)').text());
  $.ajax({
    url: "../../controller/crudespecialidad.php",
    type: "POST",
    datatype: "json",
    data: { idespec: idespec, opcion: opcion},
    success: function (respuesta) {
      data = $.parseJSON(respuesta);
      if (data.length > 0) {
        $('#editarE').show(); 
        $('#guardarE').hide();
        $("#idespecialidad").val(data[0]['idespecialidad']);
        $("#espec").val(data[0]['especialidad']);
        $("#modalespecialidad").modal('show');
      }
    },
  });	       
});

$("#editarE").click(function(){
  opcion = 2;
  idespec = $("#idespecialidad").val();
  espec = $("#espec").val();
  if(espec.length == 0){
    alert('Completa');
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Editar la especialidad",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, Editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudespecialidad.php",
          type: "POST",
          datatype: "json",
          data: {idespec:idespec, espec: espec, opcion: opcion},
          success: function (respuesta) {
            data = $.parseJSON(respuesta);
            if (data == 1) {
              MostrarAlerta("Error", "hay duplicidad", "error");
            } else {
              if(data == 2){
                MostrarAlerta("Hecho", "Usted no hizo ningun cambio", "success");
                LimpiarForm('formespec');
                tablaEspecialidad.ajax.reload(null, false);
                $("#modalespecialidad").modal("hide");
              }else{
                LimpiarForm('formespec');
                MostrarAlerta("Hecho", "Se editó la especialidad", "success");
                tablaEspecialidad.ajax.reload(null, false);
                $("#modalespecialidad").modal("hide");
              }

            }
          },
        });

      }
    });
  }
});


$(document).on("click", ".btnBorrarEs", function(){
  opcion = 3;
  fila = $(this);           
  idespec= parseInt($(this).closest('tr').find('td:eq(0)').text());
  Swal.fire({
      title: '¿Estás seguro?',
      text: "Se eliminará el registro seleccionado",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonText: 'Cancelar',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudespecialidad.php",
          type: "POST",
          datatype: "json",
          data: { idespec: idespec, opcion: opcion},
          success: function (respuesta) {
            MostrarAlerta('Hecho','Se eiiminó el registro','success')
            tablaEspecialidad.row(fila.parents('tr')).remove().draw();        
          },
        });	 
      }
    })                
});

/*=============================   CRUD DE TABLA MÉDICOS  ================================= */
$("#NuevoMedico").click(function(){
  idper = "";
  $('#EditMedico').hide(); 
  $("#modalMedicos").modal({ backdrop: "static", keyboard: false });
  ResetForm('FormMedico');
  $('#UsuM').val(-1); 
});

$("#UsuM").change(function () { // Mostrar datos del usuario a guardar
  opcion = 5;
  var idper = $(this).val();
  $.ajax({
    url: "../../controller/crudmedico.php",
    type: "POST",
    datatype: "json",
    data: {idper,idper,opcion: opcion},
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {
        $("#idper").val(data[0]["ID2"]);
        $("#dniU").val(data[0]["dni"]);
        $("#nomU").val(data[0]["nombres"]);
        $("#apU").val(data[0]["ap"]);
        $("#amU").val(data[0]["am"]);
        $("#celU").val(data[0]["telefono"]);
        $("#dirU").val(data[0]["direccion"]);
      }
    },
  });
});

$('#SaveMedico').click(function(){
  opcion = 1;
  cbo = $("#UsuM").val();
  idper = $("#idper").val();
  codigo = $("#codU").val();
  dni = $("#dniU").val();
  if(idper.length == 0 || dni.length == 0 || codigo.length == 0 || $("#UsuM").val() == -1){
    alert('Porfavor Complete todos los campos Necesarios');
    $("#codU").focus();
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se registrará un nuevo empleado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudmedico.php",
          type: "POST",
          datatype: "json",
          data: {idper,idper,codigo:codigo,opcion: opcion,dni:dni},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta('Error','Ya existe el código ingresado','error');
            }else{
              tablaMedicos.ajax.reload(null, false);
              MostrarAlerta('Éxito','El Médico fue registrado','success');
              ResetForm('FormMedico');
              $('#modalMedicos').modal('hide');
              $("#UsuM option[value='"+cbo+"']").remove();
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarMe", function () {
  opcion = 6;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudmedico.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, id: id },
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {
        $("#EditMedico").show();
        $("#SaveMedico").hide();
        $("#usuar").hide();
        
        $("#idper").val(data[0]["ID"]);
        $("#dniU").val(data[0]["dni"]);
        $("#nomU").val(data[0]["nombres"]);
        $("#apU").val(data[0]["ap"]);
        $("#amU").val(data[0]["am"]);
        $("#celU").val(data[0]["telefono"]);
        $("#dirU").val(data[0]["direccion"]);
        $("#codU").val(data[0]["cod"]);
        $("#areaE").val(data[0]["ID2"]);

        $("#modalMedicos").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});

$('#EditMedico').click(function(){
  opcion = 2;
  codigo = $("#codU").val();
  if(codigo.length == 0){
    alert('Porfavor Complete todos los campos necesarios');
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se editarán los datos del empleado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudmedico.php",
          type: "POST",
          datatype: "json",
          data: {id:id,codigo:codigo,opcion: opcion},
          success: function (data) {
            if (data == 1) {
              MostrarAlerta('Error','Repeticion de datos, ingrese otros valores','error');
            }else{
              if(data == 2){
                tablaMedicos.ajax.reload(null, false);
                MostrarAlerta('Éxito','No se realizaron cambios','success');
                ResetForm('FormMedico');
                $('#modalMedicos').modal('hide');id="";
              }else{
                tablaMedicos.ajax.reload(null, false);
                MostrarAlerta('Éxito','Los datos fueron editados','success');
                ResetForm('FormMedico');
                $('#modalMedicos').modal('hide');id="";                
              }

            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnBorrarMe", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  dni = parseInt(fila.find("td:eq(1)").text()); //capturo el dni
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminarán los datos del Médico",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudmedico.php",
        type: "POST",
        datatype: "json",
        data: {id:id,opcion: opcion,dni:dni},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('Error','No se puede borrar, tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminó el registro", "success");
            tablaMedicos.ajax.reload(null, false);
          }
        },
      });
    }
  });
});
/*=============================   CRUD DE TABLA ADMINISTRATIVOS  ================================= */
$("#NuevoAd").click(function(){
  $("#SaveAd").show();
  $("#usuar").show();
  $("#modalAdmin").modal({ backdrop: "static", keyboard: false });
  ResetForm('FormAd');
  $('#UsuAd').val(-1); 
  idper = "";
});

$("#UsuAd").change(function () { // Mostrar datos del usuario a guardar
  opcion = 5;
  var idper = $(this).val();
  $.ajax({
    url: "../../controller/crudadministrativo.php",
    type: "POST",
    datatype: "json",
    data: {idper,idper,opcion: opcion},
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {
        $("#idper").val(data[0]["ID2"]);
        $("#dniAd").val(data[0]["dni"]);
        $("#nomAd").val(data[0]["nombres"]);
        $("#apAd").val(data[0]["ap"]);
        $("#amAd").val(data[0]["am"]);
        $("#celAd").val(data[0]["telefono"]);
        $("#dirAd").val(data[0]["direccion"]);
      }
    },
  });
});

$('#SaveAd').click(function(){
  opcion = 1;
  cbo = $("#UsuAd").val();
  idper = $("#idper").val();
  dni = $("#dniAd").val();

  if(idper.length == 0  || $("#UsuAd").val() == -1 || dni.length == 0){
    alert('Porfavor Complete todos los campos Necesarios');
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se registrará al personal",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudadministrativo.php",
          type: "POST",
          datatype: "json",
          data: {idper,idper,opcion: opcion,dni:dni},
          success: function (response) {
            data = $.parseJSON(response);

              tablaAdmin.ajax.reload(null, false);
              MostrarAlerta('Éxito','El personal fue registrado','success');
              ResetForm('FormAd');
              $('#modalAdmin').modal('hide');
              $("#UsuAd option[value='"+cbo+"']").remove();
            
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarAd", function () {
  opcion = 6;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudadministrativo.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, id: id },
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {

        $("#usuar").hide();
        
        $("#idper").val(data[0]["ID"]);
        $("#dniAd").val(data[0]["dni"]);
        $("#nomAd").val(data[0]["nombres"]);
        $("#apAd").val(data[0]["ap"]);
        $("#amAd").val(data[0]["am"]);
        $("#celAd").val(data[0]["telefono"]);
        $("#dirAd").val(data[0]["direccion"]);
        $("#SaveAd").hide();
        $("#modalAdmin").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});


$(document).on("click", ".btnBorrarAd", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  dni = parseInt(fila.find("td:eq(1)").text()); //capturo el dni
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminarán los datos del Médico",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudadministrativo.php",
        type: "POST",
        datatype: "json",
        data: {id:id,opcion: opcion,dni:dni},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('Error','No se puede borrar, tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminó el registro", "success");
            tablaAdmin.ajax.reload(null, false);
          }
        },
      });
    }
  });
});

/*=============================   CRUD DE TABLA ASIGNACIÓN  ================================= */
$("#NuevoAs").click(function(){
  $("#SaveAs").show();
  $("#EditAs").hide();
  $("#usuar").show();
  $("#modalAsignación").modal({ backdrop: "static", keyboard: false });
  ResetForm('FormAsignar');
  $('#UsuAs').val(-1); 
  $('#EspAs').val(-1); 
  idper = "";
});

$("#UsuAs").change(function () { // Mostrar datos del usuario a guardar
  opcion = 5;
  var idper = $(this).val();
  $.ajax({
    url: "../../controller/crudasignacion.php",
    type: "POST",
    datatype: "json",
    data: {idper,idper,opcion: opcion},
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {
        $("#idmedico").val(data[0]["ID3"]);
        $("#idper").val(data[0]["ID2"]);
        $("#dniAs").val(data[0]["dni"]);
        $("#nomAs").val(data[0]["nombres"]);
        $("#apAs").val(data[0]["ap"]);
        $("#amAs").val(data[0]["am"]);
        $("#celAs").val(data[0]["telefono"]);
        $("#dirAs").val(data[0]["direccion"]);
      }
    },
  });
});

$('#SaveAs').click(function(){
  opcion = 1;

  cbo = $("#idmedico").val();
  cboE = $("#EspAs").val();
  idper = $("#idper").val();
  dni = $("#dniAs").val();
  datos = ($("#nomAs").val()+' '+$("#apAs").val()+' '+$("#amAs").val());
  acdes = $("#EspAs option:selected").text();
  alert(cbo+' '+cboE)
  if(idper.length == 0  || $("#UsuAs").val() == -1 || $("#EspAs").val() == -1 || dni.length == 0){
    alert('Porfavor seleccione los datos requeridos para la Asignación');
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "<b>" + datos + "</b> será <b> Asignado(a) </b> a <b>" + acdes + "</b>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Asignar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudasignacion.php",
          type: "POST",
          datatype: "json",
          data: {idper,idper,opcion: opcion,dni:dni,cbo:cbo,cboE:cboE},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta('Error','Ya se le asigno a los datos ingresados','error');
            }else{
              tablaAsignacion.ajax.reload(null, false);
              MostrarAlerta('Éxito','La asignación se realizó con exito','success');
              ResetForm('FormAsignar');
              $('#modalAsignación').modal('hide');
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarAs", function () {
  opcion = 6;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudasignacion.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, id: id },
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {

        $("#usuar").hide();
        $("#SaveAs").hide();
        $("#EditAs").show();

        $("#idespecmedic").val(data[0]["IDEM"]);
        $("#idmedico").val(data[0]["IDM"]);
        $("#dniAs").val(data[0]["dni"]);
        $("#nomAs").val(data[0]["nombres"]);
        $("#apAs").val(data[0]["ap"]);
        $("#amAs").val(data[0]["am"]);
        $("#celAs").val(data[0]["telefono"]);
        $("#dirAs").val(data[0]["direccion"]);

        $("#EspAs").val(data[0]["idespecialidad"]);

        $("#modalAsignación").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});

$('#EditAs').click(function(){
  opcion = 2;
  cboE = $("#EspAs").val();
  cbo = $("#idmedico").val();
  id = $("#idespecmedic").val();
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Se editará la asignación",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudasignacion.php",
          type: "POST",
          datatype: "json",
          data: {id:id,cbo:cbo,cboE:cboE,opcion: opcion},
          success: function (response) {
            data = $.parseJSON(response);

              if(data == 1){
                tablaAsignacion.ajax.reload(null, false);
                MostrarAlerta('Éxito','No se realizaron cambios','success');
                ResetForm('FormAsignar');
                $('#modalAsignación').modal('hide');id="";
              }else{
                tablaAsignacion.ajax.reload(null, false);
                MostrarAlerta('Éxito','Los datos fueron editados','success');
                ResetForm('FormAsignar');
                $('#modalAsignación').modal('hide');id="";               
              }

            
          },
        });
      }
    });
  
});

$(document).on("click", ".btnBorrarAs", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminarán los datos",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudasignacion.php",
        type: "POST",
        datatype: "json",
        data: {id:id,opcion: opcion},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('Error','No se puede borrar, se tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminó el registro", "success");
            tablaAsignacion.ajax.reload(null, false);
          }
        },
      });
    }
  });
});

/*=============================   CRUD DE TABLA HORARIOS  ================================= */

$("#NuevoHo").click(function(){
  $("#SaveHo").show();
  $("#EditHo").hide();
  $("#modalhorario").modal({ backdrop: "static", keyboard: false });
  ResetForm('formhorario');
});


$("#SaveHo").click(function(){
  opcion = 1;
  fecha = $("#datepicker").val();
  fechaH = convertirfecha(fecha);
  cupoH =parseInt($("#icupo").val());
  horarioH =$("#ihorar").val();
  consul =$("#icons").val();
  espc =$("#idespc").val();
  // alert(convertirfecha(fechaH) +' cupo'+cupoH.toString()+' hora'+horarioH+' cons'+consul+' esp'+espc)
  if(fecha.length == 0 || cupoH == 0 || horarioH.length == 0 || consul.length == 0 || espc.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Guardar los datos del nuevo horario",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudhorarios.php",
          type: "POST",
          datatype: "json",
          data: {opcion,fechaH,cupoH,horarioH,consul,espc},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta('Error','El horario ya existe','error');
            }else{
              if(data == 2){
                MostrarAlerta('Error','El consultorio ya fue asignado en el horario ingresado','error');
              }else{
                tablaHorarios.ajax.reload(null, false);
                MostrarAlerta('Éxito','El Horario se registró con exito','success');
                $('#modalhorario').modal('hide');
              }
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarHo", function () {
  opcion = 5;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudhorarios.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, id: id },
    success: function (response) {
      data = $.parseJSON(response);
      if (data.length > 0) {

        $("#idhorario").val(data[0]["ID"]);
        $("#icupo").val(data[0]["cupos"]);
        $("#datepicker").val(data[0]["fecha"]);
        $("#ihorar").val(data[0]["IDHO"]);
        $("#icons").val(data[0]["IDCON"]);
        $("#idespc").val(data[0]["IDES"]);
        $("#SaveHo").hide();
        $("#EditHo").show();
        $("#modalhorario").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});

$('#EditHo').click(function(){
  opcion = 2;
  id = $("#idhorario").val();
  fecha = $("#datepicker").val();
  fechaH = convertirfecha(fecha);
  cupoH =parseInt($("#icupo").val());
  horarioH =$("#ihorar").val();
  consul =$("#icons").val();
  espc =$("#idespc").val();
  // alert(fechaH +' cupo'+cupoH.toString()+' hora'+horarioH+' cons'+consul+' esp'+espc)
  if(fecha.length == 0 || cupoH == 0 || horarioH.length == 0 || consul.length == 0 | espc.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Editar los datos del horario seleccionado",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Editar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudhorarios.php",
          type: "POST",
          datatype: "json",
          data: {opcion,fechaH,cupoH,horarioH,consul,espc,id},
          success: function (response) {
            data = $.parseJSON(response);
            // alert(data);
            switch(data){
              case 1:
                MostrarAlerta('Error','El horario ya fue registrado','error');
                break;
              case 2:
                MostrarAlerta('Error','El consultorio ya fue asignado en el horario ingresado','error');
                break;
              case 3:
                tablaHorarios.ajax.reload(null, false);
                MostrarAlerta('Éxito','No se realizaron cambios','success');
                $('#modalhorario').modal('hide');id="";
                break;
              default:
                tablaHorarios.ajax.reload(null, false);
                MostrarAlerta('Éxito','Los datos fueron editados','success');
                $('#modalhorario').modal('hide');id="";
                break;
            }           
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnBorrarHo", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminará el dato seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudhorarios.php",
        type: "POST",
        datatype: "json",
        data: {id:id,opcion: opcion},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('Error','No se puede borrar, se tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminó el registro", "success");
            tablaHorarios.ajax.reload(null, false);
          }
        },
      });
    }
  });
});
/*=============================   CRUD DE TABLA PACIENTES  ================================= */

$("#NuevoPa").click(function(){
  $("#SavePa").show();
  $("#EditPa").hide();
  $("#hcpa").hide();
  $("#modalpaciente").modal({ backdrop: "static", keyboard: false });
  ResetForm('formpaciente');
  $("#dnip").prop('readonly', false);
});

$("#dnip").blur(function(){
  opcion = 5;
  dni = $("#dnip").val();
  idpe = $("#idpersonaP").val();
  if(dni.length < 8){
    alert('INGRESE EL DNI');
  }else{
    if(idpe != 0){

    }else{
      $.ajax({
        url: "../../controller/crudpaciente.php",
        type: "POST",
        datatype: "json",
        data: {opcion,dni},
        success: function (response) {
          data = $.parseJSON(response);
          if (data == 1) {
            
          }else{
            var datos = data[0]['nombres']+' '+ data[0]['ap'] +' '+ data[0]['am'];
            var mensaje = confirm("El DNI pertenece al Usuario "+datos+"\n ¿Desea agregar sus datos?");
            if(mensaje){
              $("#dnip").prop('readonly', true);
              $("#idpersonaP").val(data[0]['ID2']);
              $("#nomp").val(data[0]['nombres']);
              $("#app").val(data[0]['ap']);
              $("#amp").val(data[0]['am']);
              $("#celp").val(data[0]['telefono']);
              $("#dirp").val(data[0]['direccion']);
              $("#isp").val(data[0]['sexo']);
  
              $("#datepicker1").val(data[0]['fech_nac']);
              $("#lnacp").val(data[0]['lugar_nac']);
              $("#gsanp").val(data[0]['g_sangui']);
              $("#rhp").val(data[0]['factor_rh']);   
            }else{
              $("#dnip").val('');
            }
        
          }
        },
      });
    }
  }
});

  // $('#datepicker1').blur(function(){
  //   fecha = $("#datepicker1").val();
  //   fechaH = convertirfecha(fecha);
  //   // alert(fechaH);
  //   calcularedad(fechaH);
  //   if(fechaH) {
  //     $('#edadp').val(`${fechaH[0]} año(s), ${fechaH[1]} mes(es) y ${fechaH[2]} día(s).`);
  //   } else {
  //     $('#edadp').val('');
  //   }
  // });

  $('#datepicker1').change(function() {
    // alert( $('#datepicker1').val());
    opcion = 8;
    suEdad = $('#datepicker1').val();
    edada = convertirfecha(suEdad);
    $.ajax({
      url: "../../controller/crudpaciente.php",
      type: "POST",
      datatype: "json",
      data: {opcion,edada},
      success: function (response) {
        data = $.parseJSON(response);
        if (data.length > 0) {
        $("#edadp").val(data[0]['h']);
        }
      },
    });
  });

$("#SavePa").click(function(){
  opcion = 1;
  idper = $("#idpersonaP").val();
  dni = $("#dnip").val();
  nombres = $("#nomp").val();
  appat = $("#app").val();
  apmat = $("#amp").val();
  cel = $("#celp").val();
  dir = $("#dirp").val();
  sexo = $("#isp").val();
  fecha = $('#datepicker1').val();
  fechN = convertirfecha(fecha);
  lugarN = $("#lnacp").val();
  edadP = $("#edadp").val();
  gsang = $("#gsanp").val();
  Rh = $("#rhp").val();
  alergia = $("#ialergia").val();
  // alert(fecha+' '+typeof(fecha)+' '+fechN);
  // alert(convertirfecha(fechaH) +' cupo'+cupoH.toString()+' hora'+horarioH+' cons'+consul+' esp'+espc)
  if(dni.length == 0 || nombres == 0 || appat.length == 0 || apmat.length == 0 || cel.length < 9 || dir.length == 0 || fecha == '' || lugarN.length == 0
    ){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Guardar los datos del nuevo paciente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudpaciente.php",
          type: "POST",
          datatype: "json",
          data: {opcion,idper,dni,nombres,appat,apmat,cel,dir,sexo,fechN,lugarN,edadP,gsang,Rh,alergia},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta('Error','No se pudo registrar los datos del paciente','error');
            }else{
                tablaPacientes.ajax.reload(null, false);
                MostrarAlerta('Éxito','Los datos del paciente se registraron con exito','success');
                $('#modalpaciente').modal('hide');
              
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarPa", function () {
  // alert('HOLA');
  opcion = 6;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudpaciente.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, id: id },
    success: function (response) {
      data = $.parseJSON(response);
      
      if (data.length > 0) {
        // alert(data);
        $("#idpersonaP").val(data[0]["IDP"]);
        $("#idpaciente").val(data[0]["ID"]);
        $("#nhc").val(data[0]['num_hc']);
        $("#autog").val(data[0]['establec']);

        $("#dnip").val(data[0]['DNI']);
        $("#nomp").val(data[0]['nombres']);
        $("#app").val(data[0]['ap']);
        $("#amp").val(data[0]['am']);
        $("#celp").val(data[0]['telefono']);
        $("#dirp").val(data[0]['direccion']);
        $("#isp").val(data[0]['sexo']);

        $("#datepicker1").val(data[0]['fech_nac']);
        $("#lnacp").val(data[0]['lugar_nac']);
        $("#gsanp").val(data[0]['g_sangui']);
        $("#rhp").val(data[0]['factor_rh']);

        $("#ialergia").val(data[0]['alergia_medi']);
        $("#SavePa").hide();
        $("#EditPa").show();
        $("#hcpa").show();

          $('#edadp').val(data[0]['edad']);


        $("#modalpaciente").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});

$('#EditPa').click(function(){
  opcion = 2;
  idper = $("#idpersonaP").val();
  id = $("#idpaciente").val();
  dni = $("#dnip").val();
  nombres = $("#nomp").val();
  appat = $("#app").val();
  apmat = $("#amp").val();
  cel = $("#celp").val();
  dir = $("#dirp").val();
  sexo = $("#isp").val();
  fecha = $('#datepicker1').val();
  fechN = convertirfecha(fecha);
  lugarN = $("#lnacp").val();
  edadP = $("#edadp").val();
  gsang = $("#gsanp").val();
  Rh = $("#rhp").val();
  alergia = $("#ialergia").val();
  if(dni.length == 0 || nombres == 0 || appat.length == 0 || apmat.length == 0 || cel.length < 9 || dir.length == 0 || fecha == '' || lugarN.length == 0
    ){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Se editará los datos paciente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudpaciente.php",
          type: "POST",
          datatype: "json",
          data: {opcion,idper,id,dni,nombres,appat,apmat,cel,dir,sexo,fechN,lugarN,edadP,gsang,Rh,alergia},
          success: function (response) {
            data = $.parseJSON(response);
            if (data == 1) {
              MostrarAlerta('Error','El DNI debe ser único, ya existe el DNI','error');
            }else{
                tablaPacientes.ajax.reload(null, false);
                MostrarAlerta('Edicción completa','Se editaron los datos del paciente','success');
                $('#modalpaciente').modal('hide');
              
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnBorraPa", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminará al paciente seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudpaciente.php",
        type: "POST",
        datatype: "json",
        data: {id:id,opcion: opcion},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('Error','No se puede borrar, se tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminaron los datos del paciente", "success");
            tablaPacientes.ajax.reload(null, false);
          }
        },
      });
    }
  });
});

/*=============================   CRUD DE TABLA CITAS   ================================= */

$("#NuevoCita").click(function(){
  $("#SaveCita").show();
  
  $("#horC").prop('readonly', true);
  $('#AvisoP').text("");
  ResetForm('formcita');
  // $("#hcpa").hide();
  $("#modalcita").modal({ backdrop: "static", keyboard: false });
  

  // $("#dnip").prop('readonly', false);
});

$("#datepickerCita").change(function(){

  id = $("#EspC").val(0);

});


$("#EspC").change(function(){
  id = $("#EspC").val();
  fech = $("#datepickerCita").val();
  fecha = convertirfecha(fech);
  // alert(fecha);
  $.ajax({
    url: "../../controller/programaciones.php",
    type: "POST",
    datatype: "json",
    data: {id,fecha},
    success: function (data) {
      $('#progCi option').remove();
      $('#progCi').append(data);
    },
  });
});


$("#progCi").change(function(){
  var sel = $(this).val();
  opcion = 5;
  $.ajax({
    url: "../../controller/crudcita.php",
    type: "POST",
    datatype: "json",
    data: {sel,opcion},
    success: function (response) {

      data = $.parseJSON(response);

      if (data.length > 0) {
      $("#idhorario").val(data[0]['ID']);
      $("#fechaCi ").val(data[0]['fecha']);
      $("#cupoCi").val(data[0]['cupos']);
      $("#EsCita").val(data[0]['especialidad']);
      $("#MedCita").val(data[0]['Datos']);
      $("#consCita").val(data[0]['nomcons']);
      $("#turCita").val(data[0]['turno']);
      // alert('HOLS');
      $("#horC").prop('readonly', false);
      }
      // $("#modalpaciente").modal({ backdrop: "static", keyboard: false });
    },
  });
});

$("#dniCi").blur(function(){
  opcion = 7;
  dni = $("#dniCi").val();
  if(dni.length < 8){
    alert('Ingrese correctamente el DNI');
  }else{
      $.ajax({
        url: "../../controller/crudpaciente.php",
        type: "POST",
        datatype: "json",
        data: {opcion,dni},
        success: function (response) {
          data = $.parseJSON(response);
          if (data == 1) {
            MostrarAlerta('No encontrado','El DNI no se encuentra registrado','error')
          }else{
              $("#app").val(data[0]['Paciente']);
              $("#idpac").val(data[0]['ID']);
          }
        },
      });
  }
});

$("#horC").blur(function(){
  opcion = 6;
  sel = $("#idhorario").val();
  fecha = $('#fechaCi').val();
  fechN = convertirfecha(fecha);
  if(sel == '0'){}else{
    $.ajax({
    url: "../../controller/crudcita.php",
    type: "POST",
    datatype: "json",
    data: {opcion,sel,fechN},
      success: function (response) {
        data = $.parseJSON(response);
        // alert(response);
        if (data.length > 0) {
          $("#horC").val(data[0]['inicio']);
          $("#horCF").val(data[0]['ini']);
        }          
      },
    });
  }
});

$('#mailPa').keyup(function(){
  correo=$('#mailPa').val();
  if(ValidarCorreo(correo) == false){
    $("#AvisoP").text("Formato no válido").css("color", "red");
  }else{
    $("#AvisoP").text("Formato válido").css("color", "green");
  }
});

$("#SaveCita").click(function(){
  opcion = 1;
  fecha = $('#fechaCi').val();
  fechN = convertirfecha(fecha);
  hora = $("#horCF").val();
  idpac =$("#idpac").val();
  sel =$("#idhorario").val();
  dnipersonal =$("#dniuser").val();
  email =$("#mailPa").val();
  // alert(convertirfecha(fechaH) +' cupo'+cupoH.toString()+' hora'+horarioH+' cons'+consul+' esp'+espc)
  if(fecha.length == 0 || hora == 0 || idpac.length == '0' || sel.length == '0' || dnipersonal.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Guardar los datos de la cita",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudcita.php",
          type: "POST",
          datatype: "json",
          data: {opcion,fechN,hora,idpac,sel,dnipersonal,email},
          success: function (response) {
            data = $.parseJSON(response);
            switch(data){
              case 1:
                MostrarAlerta('Error','Ya no hay Cupos Disponibles','error');
                break;
              case 2: 
                MostrarAlerta('Error','Ya Existe una cita registrada con estos datos','error');
                break;
              case 3:
                MostrarAlerta('Error','Usted No esta autorizado para guardar la Cita','error');
                break;
              default:
                tablaCitas.ajax.reload(null, false);
                MostrarAlerta('¡HECHO!','Los datos de la cita se registraron con exito','success');
                $('#modalcita').modal('hide');
                break;
            }
          },
        });
      }
    });
  }
});

$(document).on("click", ".btnEditarCi", function () {
  // alert('HOLA');
  opcion = 7;
  fila = $(this).closest("tr");
  idcita = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  // $("#modalcitaed").modal({ backdrop: "static", keyboard: false });
  $.ajax({
    url: "../../controller/crudcita.php",
    type: "POST",
    datatype: "json",
    data: { opcion, idcita},
    success: function (response) {
      data = $.parseJSON(response);
      // alert(data);
      if (data.length > 0) {
        // alert(data);
        $("#idcitaed").val(data[0]["ID"]);
        $("#fechaCi1").val(data[0]["Fecha"]);
        $("#MedCita1").val(data[0]['Medico']);
        $("#consCita1").val(data[0]['nomcons']);
        $("#turCita1").val(data[0]['turno']);
        $("#dniCi1").val(data[0]['dni1']);
        $("#horC1").val(data[0]['Hora']);
        $("#app1").val(data[0]['Paciente']);
        $("#EsCita1").val(data[0]['especialidad']);
        $("#SaveCita").hide();
        $("#modalcitaed").modal({ backdrop: "static", keyboard: false });
      }
    },
  });
});

$(document).on("click", ".reportci", function () {
  fila = $(this).closest("tr");
  idcita = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  window.open('/SistemaAtencion/reporte/reporte-citas.php?e='+idcita, '_blank');
});

$(document).on("click", ".btnBorrarCi", function () {
  opcion = 3;
  fila = $(this).closest("tr");
  idcita = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  Swal.fire({
    title: "¿Estás seguro?",
    text: "Se eliminará la cita seleccionado",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../../controller/crudcita.php",
        type: "POST",
        datatype: "json",
        data: {idcita, opcion},
        success: function (data) {
          if (data == 1) {
            MostrarAlerta('¡ERROR!','No se puede borrar, se tiene datos asociados','error');
          }else{
            MostrarAlerta("Hecho", "Se eliminaron los datos del paciente", "success");
            tablaCitas.ajax.reload(null, false);
          }
        },
      });
    }
  });
});

/*=============================   CRUD TABLA TRIAJE ================================= */
$('#filtrar').click(function(){

  turno = $("#cbotur option:selected").text();
  especialidad = $("#cboes").val();
  opcion = 4;

  TablaTriaje = $('#TablaTriaje').DataTable({  
    "destroy":true,
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
      },
    "ajax":{            
        "url": "../../controller/crudtriaje.php", 
        "method": 'POST', //usamos el metodo POST
        "data":{opcion, turno, especialidad}, //enviamos opcion 4 para que haga un SELECT
        "dataSrc":""
    },
    "columns":[
        {"data": "ID"},
        {"data": "registrado"},
        {"data": "Fecha"},
        {"data": "Hora"},
        {"data": "Paciente"},
        {"data": "Médico"},
        {"data": "especialidad"},
        {"data": 'estado',"render": function (data, type) {
              let country = '';
              switch (data) {
                  case 'Registrado':
                      country = 'bg-dark';
                      break;
                  case 'Atendido':
                      country = 'bg-success';
                      break;
                  case 'No Asistió':
                      country = 'bg-danger';
                      break;
                  case 'Triaje':
                    country = 'bg-warning';
                    break;
              }
              return  '<span style="font-size:14px" class="badge ' + country + '">'+ data +'</span> ' ;  
      }
    },
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn bg-danger btn-sm btnTri' title='Ver e insertar datos clínicos'><span class='material-icons'>visibility</span></button></div></div>"}
    ]
  
  });
});

$(document).on("click", ".btnTri", function () {
  $  // alert('HOLA');
  opcion = 5;
  fila = $(this).closest("tr");
  idcita = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
  $.ajax({
    url: "../../controller/crudtriaje.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, idcita: idcita },
    success: function (response) {
      data = $.parseJSON(response);
      
      if (data.length > 0) {
        // alert(data);
        $("#idcita1").val(data[0]["ID"]);
        $("#paT").val(data[0]["Paciente"]);
        $("#dniT").val(data[0]['dni']);
        $("#EdadT").val(data[0]['edad']);

        $("#gT").val(data[0]['grupo']);
        $("#esT").val(data[0]['especialidad']);
        $("#MedT").val(data[0]['Médico']);

        $("#modaltriaje").modal({ backdrop: "static", keyboard: false });
      }
    },
  });

});

$("#tallaT").blur(function(){
  var imc;
  peso = $("#pesoT").val();
  talla = $("#tallaT").val();
  // alert(peso+' '+talla)
  if(peso == "" || talla == ""){

  }else{
        //aplicamos la fórmula
        peso = parseFloat(peso);
        talla = parseFloat(talla);
        imc=peso/(talla*talla);
        document.getElementById("imcT").value=imc.toFixed(2);
  }

});


$("#SaveTriaje").click(function(){
  opcion = 1;
  idcita = $("#idcita1").val();
  peso = $("#pesoT").val();
  talla = $("#tallaT").val();
  imc = $("#imcT").val();
  tempe = $("#tempT").val();
  presion = $("#presionT").val();
  frecu = $("#frecT").val();
  satu = $("#o2T").val();

  if(peso.length == 0 || talla == 0 || imc.length == 0 || tempe.length == 0 || presion.length == 0 || frecu.length == 0 || satu.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Registrar los datos del paciente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudtriaje.php",
          type: "POST",
          datatype: "json",
          data: {opcion,idcita,peso,talla,imc,tempe,presion,frecu,satu},
          success: function (response) {
            data = $.parseJSON(response);

                TablaTriaje.ajax.reload(null, false);
                MostrarAlerta('Éxito','Los datos del paciente se registraron con exito','success');
                $('#modaltriaje').modal('hide');
              
            
          },
        });
      }
    });
  }
});

/*=============================   CRUD TABLA ATENCIÓN E HISTORIAS CLINICAS  ================================= */

$("#SaveSin").click(function(){
  opcion = 1;
  idatencion = $("#idate").val();
  idcita = $("#idaci").val();
  peso = $("#apeso").val();
  talla = $("#atalla").val();
  imc = $("#aimc").val();
  tempe = $("#atemperatura").val();
  presion = $("#apres").val();
  frecu = $("#afrec").val();
  satu = $("#asatur").val();

  motivo = $("#amotivo").val();
  tiempo = $("#atiempo").val();
  diag = $("#adx option:selected").text();
  
  trata = $("#atrata option:selected").text();
  refe = $("#refere").val();
  fech = $("#proxcita").val();
  firma = $("#dniuser").val();
  alert( idatencion+' HOKA '+diag+' '+trata);
  
  if(peso.length == 0 || talla == 0 || imc.length == 0 || tempe.length == 0 || presion.length == 0 || frecu.length == 0 || satu.length == 0
    || motivo.length == 0 || tiempo.length == 0 || diag.length == 0 || trata.length == 0 || firma.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Se guardará la atención al paciente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudatencion.php",
          type: "POST",
          datatype: "json",
          data: {opcion,idatencion,idcita,peso,talla,imc,tempe,presion,frecu,satu, motivo, tiempo, diag, trata, refe, fech, firma},
          success: function (response) {
            data = $.parseJSON(response);
            
            if (data.length > 0) {
            alert(data)
            }
          },
        });
      }
    });
  }
});

$("#SaveCon").click(function(){
  opcion = 2;
  idatencion = $("#idate").val();
  idcita = $("#idaci").val();
  peso = $("#apeso").val();
  talla = $("#atalla").val();
  imc = $("#aimc").val();
  tempe = $("#atemperatura").val();
  presion = $("#apres").val();
  frecu = $("#afrec").val();
  satu = $("#asatur").val();

  motivo = $("#amotivo").val();
  tiempo = $("#atiempo").val();
  diag = $("#adx option:selected").text();
  
  trata = $("#atrata option:selected").text();
  refe = $("#refere").val();
  fech = $("#proxcita").val();
  firma = $("#dniuser").val();
  // alert( idatencion+' HOKA '+diag+' '+trata);
  
  if(peso.length == 0 || talla == 0 || imc.length == 0 || tempe.length == 0 || presion.length == 0 || frecu.length == 0 || satu.length == 0
    || motivo.length == 0 || tiempo.length == 0 || diag.length == 0 || trata.length == 0 || firma.length == 0){
    alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
  }else{
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Se guardará la atención al paciente",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, Guardar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudatencion.php",
          type: "POST",
          datatype: "json",
          data: {opcion,idatencion,idcita,peso,talla,imc,tempe,presion,frecu,satu, motivo, tiempo, diag, trata, refe, fech, firma},
          success: function (response) {
            data = $.parseJSON(response);
            
            if (data.length > 0) {
            // alert(idatencion); 
            $("#HC").hide();
            $("#tablacitass").hide(); 
            $("#cardate").hide(); 
            $("#arec").show();
            $("#idreceta").val(data);
            idreceta = $("#idreceta").val();
            $("#nroreceta").text(idreceta);
            opcion = 4;
            // alert('opcion '+opcion+' idreceta '+idreceta)

            // var t = $('#tablarecdes').DataTable({
            //   "columnDefs": [ {
            //       "searchable": false,
            //       "orderable": false,
            //       "targets": 0
            //   } ],
            //   "order": [[ 1, 'asc' ]]
            // } );
        
            // t.on( 'order.dt search.dt', function () {
            //     t.column(0,{search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            //         cell.innerHTML = i+1;
            //     });
            // }).draw();

            tablarecdes = $('#tablarecdes').DataTable({  
              "destroy":true,
                "language": {
                  "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
              "ajax":{            
                  "url": "../../controller/crudreceta.php", 
                  "method": 'POST', //usamos el metodo POST
                  "data":{opcion, idreceta}, //enviamos opcion 4 para que haga un SELECT
                  "dataSrc":""
              },
              "columns":[
                  {"data": "ID"},
                  {"data": "denom"},
                  {"data": "tipo"},
                  {"data": "dias"},
                  {"data": "cantidad"},
                  {"data": "indicacion"},
                  {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btneditdet'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btndeldet'><i class='material-icons'>delete</i></button></div></div>"}
              ]
          
          });

            }
          },
        });
      }
    });
  }
});

$("#cerrarhc").click(function(){
  $("#HC").hide();
  $("#arec").hide();
  $("#cardate").hide();
  $("#tablacitass").show();
});

$("#CancelarAte").click(function(){
  // ResetForm('formatencion');
  $("#idate").text('');
  $("#apac").text('');
  $("#adni").text('');
  $("#aedad").text('');
  $("#aser").text('');
  $("#amed").text('');

  $("#apeso").val('');
  $("#atalla").val('');
  $("#aimc").val('');
  $("#atemperatura").val('');
  $("#apres").val('');
  $("#afrec").val('');
  $("#asatur").val('');
  $("#agsan").val('');

  $("#amotivo").val('');
  $("#atiempo").val('');
  $("#adx").val('');
  $("#atrata").val('');
  $("#refere").val('');
  $("#proxcita").val('');

  $("#cardate").hide();
  $("#HC").hide();
  $("#tablacitass").show();
  $("#arec").hide();
});

$("#SaveDES").click(function(){
  opcion = 1;
  idreceta = $("#idreceta").val();
  idmedicina = $("#rmed").val();
  dias = $("#rdia").val();
  cantidad = $("#rcant").val();
  indicacion = $("#rindi").val();
  // alert(idreceta+''+idmedicina+''+dias+''+cantidad+''+indicacion)
  if(idreceta.length == 0 || idmedicina.length == 0 || dias.length == 0 || cantidad.length == 0 || indicacion.length == 0){
    alert('COMPLETE LOS CAMPOS NECESARIOS...');
  }
  else{
    $.ajax({
      url: "../../controller/crudreceta.php",
      type: "POST",
      datatype: "json",
      data: {opcion,idreceta,idmedicina,dias,cantidad,indicacion},
      success: function (response) {
        data = $.parseJSON(response);
        // alert(data);
          if (data == 1) {
            MostrarAlerta('Error','Ya existe el medicamento en la receta','error');
          }else{
            MostrarAlerta('Hecho','','success')
            tablarecdes.ajax.reload(null, false);
            $("#rmed").val('1');
            $("#rdia").val('');
            $("#rcant").val('');
            $("#rindi").val('');
            $("#EditRES").prop('disabled', true);
            $("#SaveDES").prop('disabled', false);
          }        
      },
    });
  }
  
});


$(document).on("click", ".btnHistCl", function () {
  opcion = 5;
  fila = $(this).closest("tr");
  dnipaciente = parseInt(fila.find("td:eq(4)").text()); //capturo el ID
  
  $.ajax({
    url: "../../controller/crudatencion.php",
    type: "POST",
    datatype: "json",
    data: { opcion: opcion, dnipaciente: dnipaciente },
    success: function (response) {
      data = $.parseJSON(response);
      
      if (data.length > 0) {
        // alert(data);
        $("#NHC").text(data[0]['num_hc']);
        $("#dnipac").text(data[0]['DNI']);
        $("#apepac").text(data[0]['apell']);
        $("#nompac").text(data[0]['nom']);
        $("#edadpac").text(data[0]['edad']);
        $("#sexopac").text(data[0]['sexo']);
        $("#rhpac").text(data[0]['rh']);
        $("#HC").show();
        $("#tablacitass").hide();
        opcion = 8;
        // alert(opcion);
        tablaHC = $("#tablaHC").DataTable({
          destroy: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          ajax: {
            url: "../../controller/crudatencion.php",
            method: "POST", //usamos el metodo POST
            data: { opcion: opcion, dnipaciente: dnipaciente },
            dataSrc: "",
          },
          columns: [
            { data: "idatencion" },
            { data: "fech_ate" },
            { data: "motivocons" },
            { data: "tiempo_enferm" },
            { data: "diagnostico" },
            { data: "tratamiento" },
            { defaultContent: "<span></span>" },
          ],
        });

        tablaCit = $('#tablaCit').DataTable({  
          "destroy":true,
            "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
          "ajax":{            
              "url": "../../controller/crudcita.php", 
              "method": 'POST', //usamos el metodo POST
              "data":{opcion, dnipaciente}, //enviamos opcion 4 para que haga un SELECT
              "dataSrc":""
          },
          "columns":[
              {"data": "ID"},
              {"data": "Fecha"},
              {"data": "Hora"},
              {"data": "Paciente"},
              {"data": "Médico"},
              {"data": "especialidad"},
              {"data": "Consultorio"},
              {"data": 'estado',"render": function (data, type) {
                let country = '';
                switch (data) {
                    case 'Registrado':
                        country = 'bg-dark';
                        break;
                    case 'Atendido':
                        country = 'bg-success';
                        break;
                    case 'No Asistió':
                        country = 'bg-danger';
                        break;
                    case 'Triaje':
                      country = 'bg-warning';
                      break;
                }
                return  '<span style="font-size:14px"  class="badge ' + country + '">'+ data +'</span> ' ;  
        }
      }
          ]
      
      });

      }
    },
  });
});


  $(document).on("click", ".btnAtencion", function () {
    opcion = 7;
    fila = $(this).closest("tr");
    idatencion = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    
    $.ajax({
      url: "../../controller/crudatencion.php",
      type: "POST",
      datatype: "json",
      data: { opcion, idatencion },
      success: function (response) {
        data = $.parseJSON(response);
        
        if (data.length > 0) {
          // alert(data);
          $("#idate").val(data[0]['idatencion']);
          $("#idaci").val(data[0]['idci']);
          $("#apac").text(data[0]['paci']);
          $("#adni").text(data[0]['DNI']);
          $("#aedad").text(data[0]['edad']);
          $("#aser").text(data[0]['especialidad']);
          $("#amed").text(data[0]['medi']);

          $("#apeso").val(data[0]['peso']);
          $("#atalla").val(data[0]['talla']);
          $("#aimc").val(data[0]['imc']);
          $("#atemperatura").val(data[0]['temperatura']);
          $("#apres").val(data[0]['presion_art']);
          $("#afrec").val(data[0]['frec_cardio']);
          $("#asatur").val(data[0]['satur_o2']);
          $("#agsan").val(data[0]['rh']);
          $("#cardate").show();
          $("#tablacitass").hide();
        }
      },
    });




  });

  $("#EditRES").click(function(){
    opcion = 2;
    idreceta = $("#idreceta").val();
    idmedicina = $("#rmed").val();
    dias = $("#rdia").val();
    cantidad = $("#rcant").val();
    indicacion = $("#rindi").val();
    iddetalle = $("#iddetalle").val();
    alert(indicacion);
    if(idreceta.length == 0 || idmedicina.length == 0 || dias.length == 0 || cantidad.length == 0 || indicacion.length == 0){
      alert('COMPLETE LOS CAMPOS NECESARIOS...');
    }
    else{
      $.ajax({
        url: "../../controller/crudreceta.php",
        type: "POST",
        datatype: "json",
        data: {opcion,idreceta,idmedicina,dias,cantidad,indicacion,iddetalle},
        success: function (response) {
          data = $.parseJSON(response);
          
          if (data == 1) {
            MostrarAlerta('Error','Los datos ingresados generan duplicidad','error');
          }else{
            if(data == 2){
              MostrarAlerta('Hecho','Sin cambios','success')
              tablarecdes.ajax.reload(null, false);
              $("#rmed").val('1');
              $("#rdia").val('');
              $("#rcant").val('');
              $("#rindi").val('');
              $("#EditRES").prop('disabled', true);
              $("#SaveDES").prop('disabled', false);
            }else{
              MostrarAlerta('Hecho','','success')
              tablarecdes.ajax.reload(null, false);
              $("#rmed").val('1');
              $("#rdia").val('');
              $("#rcant").val('');
              $("#rindi").val('');
              $("#EditRES").prop('disabled', true);
              $("#SaveDES").prop('disabled', false);
            }

          }    
        },
      });
    }
    
  });

  $(document).on("click", ".btneditdet", function () {
    // alert('HOLA');
    opcion = 5;
    fila = $(this).closest("tr");
    iddetalle = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    // $("#modalcitaed").modal({ backdrop: "static", keyboard: false });
    $.ajax({
      url: "../../controller/crudreceta.php",
      type: "POST",
      datatype: "json",
      data: { opcion, iddetalle},
      success: function (response) {
        data = $.parseJSON(response);
        // alert(data);
        if (data.length > 0) {
          // alert(data);
          $("#iddetalle").val(data[0]["ID"]);
          $("#rmed").val(data[0]["IDM"]);
          $("#rdia").val(data[0]['dias']);
          $("#rcant").val(data[0]['cantidad']);
          $("#rindi").val(data[0]['indicacion']);
          $("#EditRES").prop('disabled', false);
          $("#SaveDES").prop('disabled', true);
        }
      },
    });
  });

  $(document).on("click", ".btndeldet", function () {
    // alert('HOLA');
    opcion = 3;
    fila = $(this).closest("tr");
    iddetalle = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    // $("#modalcitaed").modal({ backdrop: "static", keyboard: false });
    $.ajax({
      url: "../../controller/crudreceta.php",
      type: "POST",
      datatype: "json",
      data: { opcion, iddetalle},
      success: function (response) {
        tablarecdes.ajax.reload(null, false);
      },
    });
  });
  
  $("#Finalizar").click(function(){
    tablaCitasProgramadas.ajax.reload(null, false);
    $("#HC").hide();
    $("#arec").hide();
    $("#cardate").hide();
    $("#tablacitass").show();
  });

  $(document).on("click", ".btnentre", function () {
    // alert('HOLA');
    opcion = 5;
    fila = $(this).closest("tr");
    idreceta = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    Swal.fire({
      title: "¿Estás seguro?",
      html: "Cambiar el estado de receta",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonText: "Cancelar",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, cambiar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "../../controller/crudrecetas.php",
          type: "POST",
          datatype: "json",
          data: { opcion, idreceta},
          success: function (response) {
            tablaRecetas.ajax.reload(null, false);
          },
        });
      }
    });

  });

  $(document).on("click", ".btnDescr", function () {
    // alert('HOLA');
    opcion = 1;
    fila = $(this).closest("tr");
    idreceta = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
    $('#nrodesc1').text(idreceta);
    $('#modaldescr').modal('show')
    tabladescr = $('#tabladescr').DataTable({  
      "destroy":true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
      "ajax":{            
          "url": "../../controller/crudrecetas.php", 
          "method": 'POST', //usamos el metodo POST
          "data":{opcion, idreceta}, //enviamos opcion 4 para que haga un SELECT
          "dataSrc":""
      },
      "columns":[
          {"data": "ID"},
          {"data": "denom"},
          {"data": "tipo"},
          {"data": "dias"},
          {"data": "cantidad"},
          {"data": "indicacion"}
      ]
  
  });


  });

// $("#dnip").blur(function(){
//   opcion = 5;
//   dni = $("#dnip").val();
//   idpe = $("#idpersonaP").val();
//   if(dni.length < 8){
//     alert('INGRESE EL DNI');
//   }else{
//     if(idpe != 0){

//     }else{
//       $.ajax({
//         url: "../../controller/crudpaciente.php",
//         type: "POST",
//         datatype: "json",
//         data: {opcion,dni},
//         success: function (response) {
//           data = $.parseJSON(response);
//           if (data == 1) {
            
//           }else{
//             var datos = data[0]['nombres']+' '+ data[0]['ap'] +' '+ data[0]['am'];
//             var mensaje = confirm("El DNI pertenece al Usuario "+datos+"\n ¿Desea agregar sus datos?");
//             if(mensaje){
//               $("#dnip").prop('readonly', true);
//               $("#idpersonaP").val(data[0]['ID2']);
//               $("#nomp").val(data[0]['nombres']);
//               $("#app").val(data[0]['ap']);
//               $("#amp").val(data[0]['am']);
//               $("#celp").val(data[0]['telefono']);
//               $("#dirp").val(data[0]['direccion']);
//               $("#isp").val(data[0]['sexo']);
  
//               $("#datepicker1").val(data[0]['fech_nac']);
//               $("#lnacp").val(data[0]['lugar_nac']);
//               $("#gsanp").val(data[0]['g_sangui']);
//               $("#rhp").val(data[0]['factor_rh']);   
//             }else{
//               $("#dnip").val('');
//             }
        
//           }
//         },
//       });
//     }
//   }
// });


//   $('#datepicker1').change(function() {
//     // alert( $('#datepicker1').val());
//     let suEdad = edad($('#datepicker1').val());
//     // alert(suEdad);
//     if(suEdad) {
//       $('#edadp').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
//     } else {
//       $('#edadp').val('');
//     }
//   });

// $("#SavePa").click(function(){
//   opcion = 1;
//   idper = $("#idpersonaP").val();
//   dni = $("#dnip").val();
//   nombres = $("#nomp").val();
//   appat = $("#app").val();
//   apmat = $("#amp").val();
//   cel = $("#celp").val();
//   dir = $("#dirp").val();
//   sexo = $("#isp").val();
//   fecha = $('#datepicker1').val();
//   fechN = convertirfecha(fecha);
//   lugarN = $("#lnacp").val();
//   edadP = $("#edadp").val();
//   gsang = $("#gsanp").val();
//   Rh = $("#rhp").val();
//   alergia = $("#ialergia").val();
//   // alert(fecha+' '+typeof(fecha)+' '+fechN);
//   // alert(convertirfecha(fechaH) +' cupo'+cupoH.toString()+' hora'+horarioH+' cons'+consul+' esp'+espc)
//   if(dni.length == 0 || nombres == 0 || appat.length == 0 || apmat.length == 0 || cel.length < 9 || dir.length == 0 || fecha == '' || lugarN.length == 0
//     ){
//     alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
//   }else{
//     Swal.fire({
//       title: "¿Estás seguro?",
//       html: "Guardar los datos del nuevo paciente",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#3085d6",
//       cancelButtonText: "Cancelar",
//       cancelButtonColor: "#d33",
//       confirmButtonText: "Si, Guardar",
//     }).then((result) => {
//       if (result.isConfirmed) {
//         $.ajax({
//           url: "../../controller/crudpaciente.php",
//           type: "POST",
//           datatype: "json",
//           data: {opcion,idper,dni,nombres,appat,apmat,cel,dir,sexo,fechN,lugarN,edadP,gsang,Rh,alergia},
//           success: function (response) {
//             data = $.parseJSON(response);
//             if (data == 1) {
//               MostrarAlerta('Error','No se pudo registrar los datos del paciente','error');
//             }else{
//                 tablaPacientes.ajax.reload(null, false);
//                 MostrarAlerta('Éxito','Los datos del paciente se registraron con exito','success');
//                 $('#modalpaciente').modal('hide');
              
//             }
//           },
//         });
//       }
//     });
//   }
// });

// $(document).on("click", ".btnEditarPa", function () {
//   // alert('HOLA');
//   opcion = 6;
//   fila = $(this).closest("tr");
//   id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
//   $.ajax({
//     url: "../../controller/crudpaciente.php",
//     type: "POST",
//     datatype: "json",
//     data: { opcion: opcion, id: id },
//     success: function (response) {
//       data = $.parseJSON(response);

//       if (data.length > 0) {

//         $("#idpersonaP").val(data[0]["IDP"]);
//         $("#idpaciente").val(data[0]["ID"]);
//         $("#nhc").val(data[0]['num_hc']);
//         $("#autog").val(data[0]['establec']);

//         $("#dnip").val(data[0]['DNI']);
//         $("#nomp").val(data[0]['nombres']);
//         $("#app").val(data[0]['ap']);
//         $("#amp").val(data[0]['am']);
//         $("#celp").val(data[0]['telefono']);
//         $("#dirp").val(data[0]['direccion']);
//         $("#isp").val(data[0]['sexo']);

//         $("#datepicker1").val(data[0]['fech_nac']);
//         $("#lnacp").val(data[0]['lugar_nac']);
//         $("#gsanp").val(data[0]['g_sangui']);
//         $("#rhp").val(data[0]['factor_rh']);

//         $("#ialergia").val(data[0]['alergia_medi']);
//         $("#SavePa").hide();
//         $("#EditPa").show();
//         $("#hcpa").show();

//         let suEdad = edad($('#datepicker1').val());
//         if(suEdad) {
//           $('#edadp').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
//         } else {
//           $('#edadp').val('');
//         }

//         $("#modalpaciente").modal({ backdrop: "static", keyboard: false });
//       }
//     },
//   });
// });

// $('#EditPa').click(function(){
//   opcion = 2;
//   idper = $("#idpersonaP").val();
//   id = $("#idpaciente").val();
//   dni = $("#dnip").val();
//   nombres = $("#nomp").val();
//   appat = $("#app").val();
//   apmat = $("#amp").val();
//   cel = $("#celp").val();
//   dir = $("#dirp").val();
//   sexo = $("#isp").val();
//   fecha = $('#datepicker1').val();
//   fechN = convertirfecha(fecha);
//   lugarN = $("#lnacp").val();
//   edadP = $("#edadp").val();
//   gsang = $("#gsanp").val();
//   Rh = $("#rhp").val();
//   alergia = $("#ialergia").val();
//   if(dni.length == 0 || nombres == 0 || appat.length == 0 || apmat.length == 0 || cel.length < 9 || dir.length == 0 || fecha == '' || lugarN.length == 0
//     ){
//     alert('COMPLETE LOS CAMPOS OBLIGATORIOS')
//   }else{
//     Swal.fire({
//       title: "¿Estás seguro?",
//       html: "Se editará los datos paciente",
//       icon: "warning",
//       showCancelButton: true,
//       confirmButtonColor: "#3085d6",
//       cancelButtonText: "Cancelar",
//       cancelButtonColor: "#d33",
//       confirmButtonText: "Si, Guardar",
//     }).then((result) => {
//       if (result.isConfirmed) {
//         $.ajax({
//           url: "../../controller/crudpaciente.php",
//           type: "POST",
//           datatype: "json",
//           data: {opcion,idper,id,dni,nombres,appat,apmat,cel,dir,sexo,fechN,lugarN,edadP,gsang,Rh,alergia},
//           success: function (response) {
//             data = $.parseJSON(response);
//             if (data == 1) {
//               MostrarAlerta('Error','El DNI debe ser único, ya existe el DNI','error');
//             }else{
//                 tablaPacientes.ajax.reload(null, false);
//                 MostrarAlerta('Edicción completa','Se editaron los datos del paciente','success');
//                 $('#modalpaciente').modal('hide');
              
//             }
//           },
//         });
//       }
//     });
//   }
// });

// $(document).on("click", ".btnBorraPa", function () {
//   opcion = 3;
//   fila = $(this).closest("tr");
//   id = parseInt(fila.find("td:eq(0)").text()); //capturo el ID
//   Swal.fire({
//     title: "¿Estás seguro?",
//     text: "Se eliminará al paciente seleccionado",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonText: "Cancelar",
//     cancelButtonColor: "#d33",
//     confirmButtonText: "Si, Eliminar",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       $.ajax({
//         url: "../../controller/crudpaciente.php",
//         type: "POST",
//         datatype: "json",
//         data: {id:id,opcion: opcion},
//         success: function (data) {
//           if (data == 1) {
//             MostrarAlerta('Error','No se puede borrar, se tiene datos asociados','error');
//           }else{
//             MostrarAlerta("Hecho", "Se eliminaron los datos del paciente", "success");
//             tablaPacientes.ajax.reload(null, false);
//           }
//         },
//       });
//     }
//   });
// });
/*=============================  VALIDACION DE INGRESO DE CONTRASEÑAS  ================================= */
    $('#ipassco').keyup(function() {

        var pass1 = $('#ipasss').val();
        var pass2 = $('#ipassco').val();

        if ( pass1 == pass2 ) {
            $('#error2').text("Las contraseñas coinciden.").css("color","green");
            $("#guardar").prop('disabled', false);
        } else {
            $('#error2').text("Las contraseñas no coinciden.").css("color","red");
            $("#guardar").prop('disabled', true);
        }
        if(pass2 == ""){ 
            $('#error2').text("No se debe dejar en blanco").css("color","red");
            $("#guardar").prop('disabled', true);
        }
        
    });


    $('#ipasss').keyup(function() {

        var pass1 = $('#ipasss').val();
        var pass2 = $('#ipassco').val();

        if ( pass1 == pass2 ) {
            $('#error2').text("Las contraseñas coinciden.").css("color","green");
            $("#guardar").prop('disabled', false);
        } else {
            $('#error2').text("Las contraseñas no coinciden.").css("color","red");
            $("#guardar").prop('disabled', true);
        }
        if(pass2 == ""){ 
            $("#guardar").prop('disabled', true);
        }
        
    });

    $('#ipassco1').keyup(function() {

      var pass1 = $('#ipasss1').val();
      var pass2 = $('#ipassco1').val();

      if ( pass1 == pass2 ) {
          $('#error3').text("Las contraseñas coinciden.").css("color","green");
          $("#guardar").prop('disabled', false);
      } else {
          $('#error3').text("Las contraseñas no coinciden.").css("color","red");
          $("#guardar").prop('disabled', true);
      }
      if(pass2 == ""){ 
          $('#error3').text("No se debe dejar en blanco").css("color","red");
          $("#guardar").prop('disabled', true);
      }
      
    });


    $('#ipasss1').keyup(function() {

        var pass1 = $('#ipasss1').val();
        var pass2 = $('#ipassco1').val();

        if ( pass1 == pass2 ) {
            $('#error3').text("Las contraseñas coinciden.").css("color","green");
            $("#guardar").prop('disabled', false);
        } else {
            $('#error3').text("Las contraseñas no coinciden.").css("color","red");
            $("#guardar").prop('disabled', true);
        }

        
    });
      $('#guardar1').click(function(){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Guardar los datos registrados",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, guardar'
          }).then((result) => {
            if (result.isConfirmed) {
                var datos=$('#formnew').serialize();  
                $.ajax({
                    type:"POST",
                    url:"../../controller/insertar.php",
                    data:datos,
                    success: function (r) {
                      if (r == true) {
                      MostrarAlerta("¡Hecho!","Registro Guardado Correctamente","success");
                      limpiarcampos();
                      $('#modaleditusuario').modal('hide');
                      }else{
                      MostrarAlerta("¡Aviso!","Error al guardar","error");}
                    }
                    
                });
                return false;
            }
          })
          
          
      });

      $('#eliminar').click(function(){
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se eliminará el registro seleccionado",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                '¡Hecho!',
                'Se eliminó el registro.',
                'success'
              )
            }
          })
      });  

  // $('#NuevaDescri').click(function(){
  //   $('#recetabody').append("<tr><td><select class='form-control rec'><?php while($datos = $medic->fetch(PDO::FETCH_ASSOC)) { ?><option value='<?php echo $datos['idmedicina']  ?> <?php echo $datos['descr'] ?></option><?php } ?></select></td><td><input type='number' class='form-control'></td><td><input type='number' class='form-control'></td><td><input type='text' class='form-control'></td><td><button class='btn btn-danger btn-sm'><i class='material-icons'>delete</i></button></td></tr>");
  // })
  // "<td><select class='form-control rec'><?php while($datos = $medic->fetch(PDO::FETCH_ASSOC)) { ?><option value='<?php echo $datos['idmedicina']  ?>'> <?php echo $datos['descr'] ?></option><?php } ?><select></td>"
});    

function validaNumericos(event) {
    if (event.charCode >= 48 && event.charCode <= 57) {
        return true;
    }
    return false;
}
function MostrarAlerta(mensaje,descripcion,tipoalerta){
    Swal.fire(
        mensaje,
        descripcion,
        tipoalerta
      )
}
function limpiarcampos(){
    document.getElementById("formnew").reset();
    $('#error1').text("");
    $('#error2').text("");
    $('#AvisoE').text("");
    $('#Aviso').text("");
}

function limpiarcamposarea(){
  document.getElementById("formarea").reset();
}
function salir(){
    window.location="/SistemaAtencion/controller/salir.php";//Redireccionar al momento de salir 
}

function LimpiarForm(form){
  document.getElementById(form).reset();
}

function ValidarCorreo(correo){
  var expReg= /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/;
  var esValido = expReg.test(correo);
  if(esValido == true){
    return true;
  }else{
    return false;
  }
}

function ResetForm(id) {
  document.getElementById(id).reset();
}

function convertirfecha(fecha){
  if(typeof fecha != 'string'){
      return false;
  }else{
    let partes = fecha.split('/');  
    return partes[2] + '-' + partes[1] + '-' + partes[0];
  }
}

const input = document.getElementById('icupo');

const check = () => {
  if (!input.validity.valid) input.value = 1;
  if (+input.value < 0) input.value = 1;
};

const edad = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return 1;
  let dias = hoy.getUTCDate() - dateNac.getUTCDate();
  let meses = hoy.getUTCMonth() - dateNac.getUTCMonth();
  let years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  if(dias < 0) {
    meses--;
    dias = 30 + dias;
  }
  if(meses < 0) {
    years--;
    meses = 12 + meses;
  }
  
  return [years, meses, dias];
}

function saldos(){
  $('#idtabla tr').each(function(){
    let a=$(this).find('input[type="text"]').val();
  }); 
  
}