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
function validateField(campo, tipo, valor){
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
    return result;
}

$(function(){
   //DOES NOTHING BY NOW;
});



/*******************LÚPULO********************/
function saveLupulo(form){
    var nombre = form.nombre_nuevo_lupulo.value;
    var alfaacidos = form.alfaacidos_nuevo_lupulo.value.replace(",", ".");
//"?c=lupulo&a=saveLupulo"
    $.ajax({
        url : "./lupulo/saveLupulo",
        method : "POST",
        data : {"nombre" : nombre, "alfaacidos" : alfaacidos},
        error : function(err){
            ce(err);
            alert(err.message);
            return false;
        },
        success : function(response){
            cw(response);
            if(response.status !== 'ok'){
                alert(response.message);
                return false;
            }else{
                window.location.href = './lupulo';
                return true;
            }
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
           url : './lupulo/deleteLupulo',
            method : 'POST',
            data : {"id" : id},
            error : function(resperror){
              ce("erroraco");
              ce(resperror);
              return false;
            },
            success : function(response){
               cw(response);
               if(response.status !== 'ok'){
                   alert(response.message);
                   return false;
               }else{
                   window.location.href = "./lupulo";
                   return true;
               }
            }

        });
    }
}
function editLupulo(id){
    window.location.href = './lupulo/editLupulo/' + id;
}
function updateLupulo(form){

    //cambio la coma por punto para que php lo valide como float
    $("#alfaacidos_editar_lupulo").val(
        $("#alfaacidos_editar_lupulo").val().replace(",", ".")
    );

    $.ajax({
       url : './lupulo/saveEditedLupulo',
       method : 'POST',
       data : $(form).serialize(),
       error : function(err){
           ce(err);
           alert(err.message)
           return false;
       } ,
       success : function(response){
           if(response.status === 'error'){
               alert(response.message);
               return false;
           }else{
               window.location.href = './lupulo';
               return true;
           }
       }
    });

}

/*******************MALTA********************/
function saveMalta(form){
    var nombre = form.nombre_nueva_malta.value;
    var tipo = form.tipo_nueva_malta.value;
    var ebc = form.ebc_nueva_malta.value;

    $.ajax({
        url : "./malta/saveMalta",//"?c=malta&a=saveMalta"
        method : "POST",
        data : {"nombre" : nombre, "tipo" : tipo, "ebc" : ebc},
        error : function(err){
            ce(err);
        },
        success : function(response){
           if(response.status === 'error'){
               alert(response.message);
               return false;
           }else{
               window.location.href = './malta';
               return true;
           }
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
           url : './malta/deleteMalta',//'?c=malta&a=deleteMalta'
            method : 'POST',
            data : {"id" : id},
            error : function(resperror){
              ce("erroraco");
              ce(resperror);
            },
            success : function(response){
               if(response.status === 'error'){
                   alert(response.message);
                   return false;
               }else{
                   window.location.href = './malta';
                   return true;
               }
            }

        });
        return false;
    }
}
function editMalta(id){
    // window.location.href = '?c=malta&a=editMalta&id=' + id;
    window.location.href = './malta/editMalta/' + id;
}
function updateMalta(form){
    // var id = form.id_editar_malta.value;
    // var nombre = form.nombre_editar_malta.value;
    // var tipo = form.tipo_editar_malta.value;
    // var ebc = form.ebc_editar_malta.value;

    $.ajax({
       url : './malta/saveEditedMalta', //'?c=malta&a=saveEditedMalta'
       method : 'POST',
       data : $(form).serialize(),
        error: function (r_error){
          ce("ERRORACO!!");
          ce(r_error);
          return false;
        },
        success : function(response){
            console.warn(response);

            if(response.status === 'error'){
                alert(response.message);
                return false;
            }else{
                window.location.href = './malta';
                return true;
            }
        }
    });

    /*
    ,
       error : function(err){
           ce("SUPERERROR!!!");
           ce(err);
           return false;
       }
    * */

}

/*******************LOTE********************/
function saveLote(form) {

    //VALIDACION DE CAMPOS REQUERIDOS
    if(!validateField('nombre_nuevo_lote', 'REQUIRED'))return alert('El nombre es obligatorio.');
    if(!validateField('referencia_nuevo_lote', 'REQUIRED'))return alert('La referencia es obligatoria.');
    if(!validateField('cocinado_nuevo_lote', 'REQUIRED'))return alert('La fecha de cocinado es obligatoria.');
    if(!validateField('agua_macerado_nuevo_lote', 'REQUIRED'))return alert('El agua de macerado es obligatorio.');
    if(!validateField('agua_lavado_nuevo_lote', 'REQUIRED'))return alert('El agua de lavado es obligatorio.');
    if(!validateField('total_maltas', 'MIN', 1))return alert('Al menos hay que aportar una malta.');
    if(!validateField('levadura_nuevo_lote', 'REQUIRED'))return alert('Hay que seleccionar la levadura.');

    let elform = $(form).serialize();

    $.ajax({
       url : "./lote/saveLote",
       method : "post",
       data : elform,
        error : function (error) {
            ce(error);
            return false;
        },
        success : function (response) {
           cl(response);
           if(response.status === "error"){
               alert(response.message);
           }
            return false;
        }

    });
}
function deleteLote(id) {
    var lote_name = $("#row_lote_" + id)
        .find('[data-name="lotename"]')
        .html();

    var del = confirm("Se va a eliminar el lote " + lote_name);

    if(del){
        $.ajax({
           url : './lote/deleteLote',
           method : 'POST',
            data : {"id" : id},
            error : function (err) {
                ce(err);
                alert(err);
                return false;
            },
            success : function (response) {
                if(response. status === 'error'){
                    ce(response.message);
                    alert(response.message);
                    return false
                }else{
                    window.location.href = './lote';
                    return true;
                }
            }

        });
    }
    return false;
}
function editLote(id) {
    window.location.href = './lote/editLote/' + id;
}
function saveEditedLote(form) {

    //VALIDACION DE CAMPOS REQUERIDOS
    if(!validateField('nombre_edited_lote', 'REQUIRED'))return alert('El nombre es obligatorio.');
    if(!validateField('referencia_edited_lote', 'REQUIRED'))return alert('La referencia es obligatoria.');
    if(!validateField('cocinado_edited_lote', 'REQUIRED'))return alert('La fecha de cocinado es obligatoria.');
    if(!validateField('agua_macerado_edited_lote', 'REQUIRED'))return alert('El agua de macerado es obligatorio.');
    if(!validateField('agua_lavado_edited_lote', 'REQUIRED'))return alert('El agua de lavado es obligatorio.');
    if(!validateField('total_maltas', 'MIN', 1))return alert('Al menos hay que aportar una malta.');
    if(!validateField('levadura_edited_lote', 'REQUIRED'))return alert('Hay que seleccionar la levadura.');

    let elform = $(form).serialize();

    $.ajax({
       url : "./lote/updateLote",
       method : "post",
       data : elform,
        error : function (error) {
            ce(error);
            return false;
        },
        success : function (response) {
           cl(response);
           if(response.status !== "ok"){
               alert(response.message);
           }else{
               window.location.href = './lote';
           }
            return false;
        }

    });
}

/**************** INSUMOS *****************/
//Añade una malta al lote
function addNewMalta(){
    maltas ++;
    let html = '';
    cl('add new malta');
    $.ajax({
        url : './lote/getNewMaltaHtml',
        method : 'POST',
        data : {"orden" : maltas},
        error : function(resperror){
            ce(resperror);
        },
        success : function(response){
            if(response.status === "ok"){
                html = response.content;
                $("#area_maltas").append(html);
                $("#total_maltas").val(maltas);
            }else{
                alert("No ha sido posible realizar la acción.");
            }
        }
    });
}
//Elimina la última malta añadida al lote
function delNewMalta() {
    $("#malta_" + maltas).remove();
    if(maltas > 0)maltas --;
    $("#total_maltas").val(maltas)

}
//Añade una adición de lúpulo al lote
function addNewAdicion(){
    adiciones ++;
    let html = '';
    cl('add new adicion');
    $.ajax({
        url : './lote/getNewAdicionHtml',
        method : 'POST',
        data : {"orden" : adiciones},
        error : function(resperror){
            ce(resperror);
        },
        success : function(response){
            if(response.status ==="ok"){
                html = response.content;
                $("#area_lupulos").append(html);
                $("#total_lupulos").val(adiciones);
            }else{
                alert("No ha sido posible realizar la acción.");
            }

        }
    });
}
//Elimina la última adición de lúpulo añadida al lote
function delNewAdicion(){
    $("#lupulo_" + adiciones).remove();
    if(adiciones > 0)adiciones --;
    $("#total_lupulos").val(adiciones);
}
