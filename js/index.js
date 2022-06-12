
const urlGlobal = "http://localhost:8000";

async function getEstados(){

    var html_option = "";

    await $.ajax({ 
        url: `${urlGlobal}/estado`
    }).done(function(data) {
        var datos = JSON.parse(data);
        for(var i = 0;i < datos.length;i++)
            html_option += `<option value='${datos[i]}'>${datos[i]}</option>`;
    });

    $("#estado").append(html_option);
}


async function getMunicipio(){

    const estado = $("#estado").val();
    var html_option = "<option value='' selected>- Selecciona Municipio -</option>";

    await $.ajax({
        url: `${urlGlobal}/municipio?estado=${estado}`
    }).done(function(data) {
        var datos = JSON.parse(data);
        for(var i = 0;i < datos.length;i++)
            html_option += `<option value='${datos[i]}'>${datos[i]}</option>`;
    });

    $("#municipio").html(html_option);
}


function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}


async function getUsers(){

    let html_option = "";

    let filtros = "?";
    filtros +=  "fecha_desde=" + $("#fecha_desde").val();
    filtros += "&fecha_hasta=" + $("#fecha_hasta").val();
    filtros += "&correo=" + $("#correo_filtro").val();
    filtros += "&telefono=" + $("#telefono_filtro").val();



    await $.ajax({
        url: `${urlGlobal}/lista_usuarios${filtros}`
    }).done(function(data) {
        var datos = JSON.parse(data);
        for(var i = 0;i < datos.length;i++)
            html_option += `<tr><td>${datos[i].correo}</td><td>${datos[i].tipo_telefono}</td><td>${datos[i].telefono}</td><td>${datos[i].estado}</td><td>${datos[i].municipio}</td><td>${datos[i].codigo_postal}</td><td>${datos[i].fecha_nacimiento}</td><td>${calcularEdad(datos[i].fecha_nacimiento)}</td></tr>`;
    });

    $("#dataUsuarios").html(html_option);

}


async function submitForm(){


        var form = $("#formRegister");


        await $.ajax({
            type: "POST",
            url: `${urlGlobal}/validacion_sat`,
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
              const date = JSON.parse(data); // show response from the php script.
              
              if(date.success) location.href='gracias.html'
              else alert(date.error);
            }
        });


      
}

async function submitFacturas(){
    
    var form = $("#formRegisterFacturas");


    await $.ajax({
        type: "POST",
        url: `${urlGlobal}/registrar_factura`,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
          const date = JSON.parse(data); // show response from the php script.
          
          if(date.success) location.href='gracias.html'
          else alert(date.error);
        }
    });
    

}


//events


$("#estado").change(function(){
    getMunicipio();
});

$("#btn-submit-user").click(function(){
    submitForm();
})

$("#btn-next-factura").click(function(){
    submitFacturas();
})

//ready
$(document).ready(function(){
    getEstados();
    getUsers();
})