/**
 * Created by eugenio on 14/03/2017.
 */
function getel(e){
    return document.getElementById(e);
}
function cl(txt){
    console.log(txt);
}
function cw(w){
    console.warn(w);
}
function ce(e){
    console.error(e);
}
function isString(value) {
    return typeof value === 'string';
}
function isJson(strjson){
    try {
        JSON.parse(strjson);
    } catch (e) {
        return false;
    }
    return true;
}
function logErrorJS(error_msg){
    $.ajax({
        method: "POST",
        url: "controllers/shared/utils_controller.php",
        data: {"action" : "errorlogJS", "msg" : error_msg}
    });
}//end of logErrorJS
function checknumber(input){
    var typed = input.value;
    if(isNaN(typed)){
        input.value = typed.substring(0, typed.length -1);
    }
    console.log(typed);
    return false;
}

$(document).ready(function(){
   //DOES NOTHING BY NOW;
});

/*******************LUPULO********************/
function saveLupulo(form){
    var nombre = form.nombre_nuevo_lupulo.value;
    var alfaacidos = form.alfaacidos_nuevo_lupulo.value;

    $.ajax({
        url : "?c=lupulo&a=saveLupulo",
        method : "POST",
        data : {"nombre" : nombre, "alfaacidos" : alfaacidos},
        error : function(err){
            ce(err);
        },
        success : function(response){
            cw(response);
            return false;
        }
    });
}
function deleteLupulo(id) {
    var lupulo_name = $("#row_lupulo_"+id)
        .find('[data-name="lupuname"]')
        .html();
    // console.log($(this).parent().get(0).tagName);
    var del = confirm("Se va a eliminar el lúpulo " + lupulo_name);

    if(del){
        $.ajax({
           url : '?c=lupulo&a=deleteLupulo',
            method : 'POST',
            data : {"id" : id},
            error : function(resperror){
              ce("erroraco");
              ce(resperror);
            },
            success : function(response){
               cl("tutto bene");
               cw(response);
               if(response == true){
                   window.location.href = "?c=lupulo";
               }else{
                   cl('ha devuelto otra cosa que no es true.');
               }
            }

        });
        return false;
    }

}

/*******************MALTA********************/
function saveMalta(form){
    var nombre = form.nombre_nueva_malta.value;
    var tipo = form.tipo_nueva_malta.value;
    var ebc = form.ebc_nueva_malta.value;

    $.ajax({
        url : "?c=malta&a=saveMalta",
        method : "POST",
        data : {"nombre" : nombre, "tipo" : tipo, "ebc" : ebc},
        error : function(err){
            ce(err);
        },
        success : function(response){
            cw(response);
            return false;
        }
    });
}
function deleteMalta(id) {
    var malta_name = $("#row_malta_"+id)
        .find('[data-name="maltaname"]')
        .html();
    // console.log($(this).parent().get(0).tagName);
    var del = confirm("Se va a eliminar la malta " + malta_name);

    if(del){
        $.ajax({
           url : '?c=malta&a=deleteMalta',
            method : 'POST',
            data : {"id" : id},
            error : function(resperror){
              ce("erroraco");
              ce(resperror);
            },
            success : function(response){
               cl("tutto bene");
               cw(response);
               if(response == true){
                   window.location.href = "?c=malta";
               }else{
                   cl('ha devuelto otra cosa que no es true.');
               }
            }

        });
        return false;
    }
}

/*******************LOTE********************/
var maltas = 0;
function addNewMalta(){
    maltas ++;
    let html = '';
    cl('add new malta');
    $.ajax({
        url : '?c=lote&a=getNewMaltaHtml',
        method : 'POST',
        data : {"orden" : maltas},
        error : function(resperror){
            ce(resperror);
        },
        success : function(response){
            html = response;
            $("#area_maltas").append(html);
            $("#total_maltas").val(maltas);
        }
    });
}
function delNewMalta() {
    $("#malta_" + maltas).remove();
    if(maltas > 0)maltas --;
    $("#total_maltas").val(maltas)

}
var adiciones = 0;
function addNewAdicion(){
    adiciones ++;
    let html = '';
    cl('add new adicion');
    $.ajax({
       url : '?c=lote&a=getNewAdicionHtml',
       method : 'POST',
       data : {"orden" : adiciones},
       error : function(resperror){
           ce(resperror);
       },
       success : function(response){
            html = response;
            $("#area_lupulos").append(html);
            $("#total_lupulos").val(adiciones);
       }
    });
}
function delNewAdicion(){
    $("#lupulo_" + adiciones).remove();
    if(adiciones > 0)adiciones --;
    $("#total_lupulos").val(adiciones);
}
function saveLote(form) {

    //VALIDACION DE CAMPOS REQUERIDOS
    validateField('nombre_nuevo_lote', 'El nombre es obligatorio.', 'REQUIRED');
    validateField('referencia_nuevo_lote', 'La referencia es obligatoria.', 'REQUIRED');
    validateField('cocinado_nuevo_lote', 'La fecha de cocinado es obligatoria.', 'REQUIRED');
    validateField('agua_macerado_nuevo_lote', 'El agua de macerado es obligatorio.','REQUIRED');
    validateField('agua_lavado_nuevo_lote', 'El agua de lavado es obligatorio.', 'REQUIRED');
    validateField('total_maltas', 'Al menos hay que aportar una malta.', 'MIN', 1);


    let elform = $(form).serialize();
    $.ajax({
       url : "?c=lote&a=saveLote",
       method : "post",
       data : elform,
        error : function (error) {
            ce(error);
            return false;
        },
        success : function (response) {
            cw(response);
            return false;
        }

    });
}
function validateField(campo, mensaje, tipo, valor){
    let result;
    let campovalue = $("#"+campo).val().trim();
    let re;

    switch(tipo){
        case 'REQUIRED':
            result = campovalue.length >= 1;
            break;
        case 'INT':
            result = $.isNumeric(campovalue);
            break;
        case 'MIN':
            result = campovalue >= valor;
            break;
        case 'MAX':
            result = campovalue <= valor;
            break;
        case 'EMAIL':
            re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	        result = re.test(campovalue);
            break;
        case 'URL':
            re = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/;
            result = re.test(input);
            break;
        case 'PHONE':
            break;
    }
    if(!result){
        alert(mensaje);
        console.warn(mensaje);
        return false;
    }
    return result;
}