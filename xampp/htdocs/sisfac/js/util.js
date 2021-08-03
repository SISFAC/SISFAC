/*
Sistema de Información para la Salud Familiar y Comunitaria – Sisfac, versión 5.1

Copyright (c) 2014, Medicus Mundi Navarra Aragón Madrid, Salud Sin Límites Perú y Soluciones Prácticas. Contacto: gerardoseminario@gmail.com

This file is part of Sisfac.

Sisfac is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, version 2 of the License.

Sisfac is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Sisfac.  If not, see <https://www.gnu.org/licenses/>.


*/

var ImagenReducida = function(c){
    jQuery(c).append('<div style="width: 550px; height: 250px; position: relative; margin-left: 10px;margin-top: 10px" class="ui-widget-shadow ui-corner-all"></div>\n\
        <div class="ui-widget ui-widget-content ui-corner-all" style="position: absolute; top:90px; width: 530px; height: 230px;padding: 10px; margin-left: 17.5px">\n\
        <img id="img" src="" alt="Mapa de referencia" style="top: -40px"/>\n\
        <label style="color: #525252; position: relative; top: -220px;">Escala: </label>\n\
        <input type="text" style="position:relative; top: -220px" value="1000" id="tbEscala" size="4"/>\n\
    </div>');
    jQuery('#tbEscala',jQuery(c)).keypress(function(e){
        if(e.keyCode==13){
            escalar(jQuery('#tbEscala',jQuery(c)).val());
        }
    });

    escalar = function(escala){
        jQuery.post('/sigurmun/funcionesphp/mapa.php',{alto:220,ancho:510,'escala':escala},function(data){
            alert(data);
            jQuery('#img',jQuery(c)).attr('src', data);
        });
    }

    escalar(1000);
}

function redondear(n,d){
    base10 = Math.pow(10,d);
    flotante = parseFloat(n);
    nuevo = Math.round(flotante*base10)/base10;
    fraccion = nuevo.toString().indexOf('.')==-1 ? repetirTexto('0',d) : nuevo.toString().substr(nuevo.toString().indexOf('.')+1);
    if(fraccion == nuevo.toString().substr(nuevo.toString().indexOf('.')+1) && fraccion.length==d){
        return nuevo;
    }
    fraccion = fraccion.length==d ? '.' + fraccion : repetirTexto('0',d-fraccion.length);
    return nuevo.toString().concat(fraccion);
}

function esVacio(obj,nombre){
    if(jQuery(obj).val().replace(/ /g, '')=='' || jQuery(obj).val()==''){
        //alert('El campo ' + nombre + ' no puede estar vacio')
        return true;
    }
    return false;
}

function repetirTexto(t,n){
    nt = '';
    for(i=0;i<n;i++){
        nt += t;
    }
    return nt;
}

function esChrome(){
    return navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
}

function conteclaenter(){
var obj=jQuery('input[type!="hidden"]:enabled:visible,textarea:enabled:visible, select:enabled:visible, button:enabled:visible' );

obj.each(function(idx,el){
    //jQuery(el).unbind('keyup', function(){});
    jQuery(el).attr('next',idx);
    //jQuery(el).trigger('keyup', [13]);
})
obj.each(function(idx,el){
  jQuery(el).keyup(function(e){
      actual=parseInt(jQuery(el).attr('next'))
        if(e.keyCode==13){
           objsig=jQuery('*[next="'+(actual+1)+'"]');
            sig=objsig[0];
            sig.focus();                          
        }
    });    
}
);
        
        
    }
    
/**
 * Funcion que devuelve true o false dependiendo de si la fecha es correcta.
 * Tiene que recibir el dia, mes y año
 */
function isValidDate(day,month,year)
{
    var dteDate;
 
    // En javascript, el mes empieza en la posicion 0 y termina en la 11
    //   siendo 0 el mes de enero
    // Por esta razon, tenemos que restar 1 al mes
    month=month-1;
    // Establecemos un objeto Data con los valore recibidos
    // Los parametros son: año, mes, dia, hora, minuto y segundos
    // getDate(); devuelve el dia como un entero entre 1 y 31
    // getDay(); devuelve un num del 0 al 6 indicando siel dia es lunes,
    //   martes, miercoles ...
    // getHours(); Devuelve la hora
    // getMinutes(); Devuelve los minutos
    // getMonth(); devuelve el mes como un numero de 0 a 11
    // getTime(); Devuelve el tiempo transcurrido en milisegundos desde el 1
    //   de enero de 1970 hasta el momento definido en el objeto date
    // setTime(); Establece una fecha pasandole en milisegundos el valor de esta.
    // getYear(); devuelve el año
    // getFullYear(); devuelve el año
    dteDate=new Date(year,month,day);
 
    //Devuelva true o false...
    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
}
 
/**
 * Funcion para validar una fecha
 * Tiene que recibir:
 *  La fecha en formato espanol dd/mm/yyyy
 * Devuelve:
 *  true-Fecha correcta
 *  false-Fecha Incorrecta
 */
function validate_fecha(fecha)
{
    //var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");
    var patron=new RegExp("^([0-9]{1,2})([/])([0-9]{1,2})([/])(19|20)+([0-9]{2})$");
 
    if(fecha.search(patron)==0)
    {
        //var values=fecha.split("-");
        //if(isValidDate(values[2],values[1],values[0]))
        var values=fecha.split("/");
        alert(values)
        if(isValidDate(values[0],values[1],values[2]))
        {
            return true;
        }
    }
    return false;
}
 
/**
 * Esta función calcula la edad de una persona y los meses
 * La fecha la tiene que tener el formato yyyy-mm-dd que es
 * metodo que por defecto lo devuelve el <input type="date">
 */
function calcularEdads(fecha,opc)
{
    //var fecha=document.getElementById("user_date").value;
    if(validate_fecha(fecha)==true)
    {
        // Si la fecha es correcta, calculamos la edad
        var values=fecha.split("/");
        var dia = values[0];
        var mes = values[1];
        var ano = values[2];
 
        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth() +1;
        var ahora_dia = fecha_hoy.getDate();
 
        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if ( ahora_mes < mes )
        {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia))
        {
            edad--;
        }
        if (edad > 1900)
        {
            edad -= 1900;
        }
 
        // calculamos los meses
        var meses=0;
        if(ahora_mes>mes)
            meses=ahora_mes-mes;
        if(ahora_mes<mes)
            meses=12-(mes-ahora_mes);
        if(ahora_mes==mes && dia>ahora_dia)
            meses=11;
 
        // calculamos los dias
        var dias=0;
        if(ahora_dia>dia)
            dias=ahora_dia-dia;
        if(ahora_dia<dia)
        {
            ultimoDiaMes=new Date(ahora_ano, ahora_mes, 0);
            dias=ultimoDiaMes.getDate()-(dia-ahora_dia);
        }
        if(opc==true) return edad + ',' + meses + ',' + dias
        else return edad+" a\xF1os, "+meses+" meses y "+dias+" d\xEDas";
        //document.getElementById("result").innerHTML="Tienes "+edad+" años, "+meses+" meses y "+dias+" días";
    }else{
        return "La fecha "+fecha+" es incorrecta";
        //document.getElementById("result").innerHTML="La fecha "+fecha+" es incorrecta";
    }
}

function obtenerEtapaMiembro(fecha,sexo,gestante){
    edad = calcularEdad(fecha,true)
    edad = edad.split(',')
    anio = parseInt(edad[0])
    mes = parseInt(edad[1])
    dia = parseInt(edad[2])
    //alert(edad[2])
    //alert(anio + '-' + mes + '-' + dia)
    if(sexo=='F' && gestante == 'GESTANTE') return 'GESTANTE'
    else if(anio<12 && mes<12 && dia<30) return 'NINO'
    else if(anio<18 && mes<12 && dia<30) return 'ADOLESCENTE'
    else if(anio<30 && mes<12 && dia<30) return 'JOVEN'
    else if(anio<60 && mes<12 && dia<30) return 'ADULTO'
    else return 'ADULTO MAYOR'
}

function calcularEdad(fecha_de_nacimiento, opc, opc1){
    //calcularEdad
    //var values=fecha.split("/");
    var array_actual = Array()
    array_nacimiento = fecha_de_nacimiento.split('/'); 
    
    var fecha_hoy = new Date();
    var ahora_ano = fecha_hoy.getFullYear();
    var ahora_mes = fecha_hoy.getMonth();
    var ahora_dia = fecha_hoy.getDate();
    array_actual[0] = ahora_ano//explode ( "-", date ("Y-m-d")); 
    array_actual[1] = ahora_mes + 1 //explode ( "-", date ("Y-m-d")); 
    array_actual[2] = ahora_dia //explode ( "-", date ("Y-m-d")); 
    
    //echo array_actual[0]."<br>";
    //echo fecha_de_nacimiento;
    anos =  array_actual[0] - array_nacimiento[2]; // calculamos años 
    meses = array_actual[1] - array_nacimiento[1]; // calculamos meses 
    dias =  array_actual[2] - array_nacimiento[0]; // calculamos días 

    //ajuste de posible negativo en $días 
    if (dias < 0) 
    { 
        --meses; 

        //ahora hay que sumar a dias los dias que tiene el mes anterior de la fecha actual 
        switch (array_actual[1]) { 
               case 1:dias_mes_anterior=31;break; 
               case 2:dias_mes_anterior=31;break; 
               case 3:
                    if (bisiesto(array_actual[0])) 
                    { 
                        dias_mes_anterior=29;break; 
                    } else { 
                        dias_mes_anterior=28;break; 
                    } 
               case 4:dias_mes_anterior=31;break; 
               case 5:dias_mes_anterior=30;break; 
               case 6:dias_mes_anterior=31;break; 
               case 7:dias_mes_anterior=30;break; 
               case 8:dias_mes_anterior=31;break; 
               case 9:dias_mes_anterior=31;break; 
               case 10:dias_mes_anterior=30;break; 
               case 11:dias_mes_anterior=31;break; 
               case 12:dias_mes_anterior=30;break; 
        } 

        dias=dias + dias_mes_anterior; 
    } 

    //ajuste de posible negativo en meses 
    if (meses < 0) 
    { 
        --anos; 
        meses=meses + 12; 
    } 
    if(opc1 == true) return anos
    else if(opc==true) return anos + ',' + meses + ',' + dias
    else return anos+" a\xF1os, "+meses+" meses y "+dias+" d\xEDas";
    //return "anos años, meses meses y dias días"; 
}

function bisiesto(anio_actual){ 
    console.log(anio_actual);
    ok=false; 
    //probamos si el mes de febrero del año actual tiene 29 días 
      if (checkDate(2,29,anio_actual)) 
      { 
        ok=true; 
    } 
    return ok; 
}

function checkDate(year, month, day){
  var d = new Date(year, month, day);

  return d.getFullYear() == year && 
         d.getMonth() == month &&
         d.getDate() == day;
}


function validarCaracteres(){
  //var regex = new RegExp('[^ 0-9a-zA-Zàèìòùáéíóúâêîôûãõ\b-]', 'g');
  //var regex = new RegExp('[^ 0-9a-zA-Z\b-]', 'g');
  var regex = new RegExp('[^ 0-9a-zA-Z\b-]', 'g');
  // repare a flag "g" de global, para substituir todas as ocorrências
  $('input').bind('input', function(){
    $(this).val($(this).val().replace(regex, ''));
  });
}