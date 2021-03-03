/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var consultas =
        {
            add: function () {
                    
            },
            index: function () {

            },
            buscarmedicina: function () {
                var medicina = document.getElementById('ConsultaBuscar').value;
                if (medicina == '')
                {
                } else
                {
                    $.ajax(
                            {
                                async: true, 
                                data: $("#ConsultaBuscar").serialize(),
                                dataType: "html", 
                                success: function (data, textStatus)
                                {
                                    $("#medicinaspaciente").html(data);
                                }, 
                                type: "post", 
                                url: urlApp + "consultas\/buscarmedicina"
                            });
                    return false;
                }
            },
            agregarmedicina: function ()
            {
                var id = document.getElementById("medicina_id").value;
                var nombre = document.getElementById("nombre").value;
                var referencia = document.getElementById("referencia").value;
                var buscar = document.getElementById("ConsultaBuscar").value;
             
                if (buscar != '')
                {
                    var indicacion =document.getElementById("indicacion").value;
                    if (document.getElementById("tRIR" + id) === null) {
                    } else
                    {
                        var fila = document.getElementById("tRIR" + id);
                        fila.parentNode.removeChild(fila);
                    }
                    $("<tr id='tRIR" + id + "'>\n\
                    <td id='tDIR" + id + "' width='20%'>" + id + "</td>\n\
                    <td width='20%'>" + nombre + "</td>\n\
                    <td width='20%'>" + referencia + "</td>\n\
                    <td width='30%'>" + indicacion + "</td>\n\
                    <td width='10%'><input class='btn btn-sm' type='button' onclick=consultas.borrarfila('tRIR" + id + "'); value=Eliminar></td></tr>").insertAfter($('#tablamedicinas'));
                    $("<input type='hidden' id='ConsultaMedicinaMedicina_id' name='data[Consulta][" + id + "][medicina_id]' value='" + id + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ConsultaMedicinaNombre' name='data[Consulta][" + id + "][nombre]' value='" + nombre + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ConsultaMedicinaReferencia' name='data[Consulta][" + id + "][referencia]' value='" + referencia + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ConsultaMedicinaIndicacion' name='data[Consulta][" + id + "][indicacion]' value='" + indicacion + "'>").insertBefore($('#tDIR' + id));
                }

            },
            borrarfila: function (idfila)
            {
                var fila = document.getElementById(idfila);
                fila.parentNode.removeChild(fila);
            }
        };


//agregar : function()
//        {
//             $("#PredioBigEstadoId").bind("change", function (event)
//                {
//                $.ajax(
//                    {
//                    async:true, data:$("#PredioBigEstadoId").serialize(),
//                    dataType:"html", success:function (data, textStatus)
//                        {
//                        $("#ListadoMunicipios").html(data);
//                        $("#PredioBigMunicipioId").bind("change", function (event)
//                            {
//                            $.ajax(
//                                {
//                                async:true, data:$("#PredioBigMunicipioId").serialize(),
//                                dataType:"html", success:function (data, textStatus)
//                                    {
//                                    $("#ListadoParroquias").html(data);
//                                    }
//                                , type:"post", url:"\/Revocatoria\/listaparroquias"
//                                });
//                            return false;
//                            });
//                        }
//                    ,type:"post", url:"\/Revocatoria\/listamunicipios"
//                    });
//                return false;
//                });
//            $(function ()
//                {
//                $('#myTab a:first').tab('show')
//                });
//            $("#SolicitudAceptar").bind("change", function (event)
//                {
//                $.ajax(
//                    {
//                    async:true, data:$("#SolicitudAceptar").serialize(),
//                    dataType:"html", success:function (data, textStatus)
//                        {
//                        $("#divAceptar").html(data);
//                        }
//                    , type:"post", url:"\/Revocatoria\/aceptar"
//                    });
//                return false;
//                });
//
//            $(function ()
//                {
//                $('#myTab a:first').tab('show')
//                });
//            $("#SolicitudrevocatoriaBigValtiposolicitudId").bind("change", function (event)
//                {
//                   
//            $.ajax(
//                {
//                async:true, data:$("#RevocatoriaAgregarForm").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#formulariodenunciante").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/formulariodenunciante"
//                });
//            return false;
//            }); 
//            $("#RevocatoriaAceptar").bind("change", function (event) 
//            {
//            $.ajax(
//                {
//                async:true, data:$("#RevocatoriaAceptar").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#divAceptar").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/aceptar"
//                });
//             return false;
//            });
//           
//        },
//     formulariodenunciante : function()
//        {
//           
//        },
//     buscardenunciante : function()
//        {
//        var cedula= document.getElementById('DenuncianteNumDencedula').value;
//        if(cedula=='')
//            {
//            }
//        else 
//            {
//            $.ajax(
//                {
//                async:true, data:$("#DenuncianteNumDencedula").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#buscar").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/buscardenunciante"
//                });
//            return false;
//            }
//        },
//    buscarheredero : function()
//        {
//            var cedula= document.getElementById('HerederoNumDecedula').value;
//            if(cedula=='')
//            {
//            }
//            else
//            {
//                $.ajax(
//                    {
//                        async:true, data:$("#HerederoNumDecedula").serialize(),
//                        dataType:"html", success:function (data, textStatus)
//                    {
//                        $("#integrantes").html(data);
//                    }
//                        , type:"post", url:"\/Revocatoria\/buscarheredero"
//                    });
//                return false;
//            }
//        },
//    agregarheredero : function()
//    {
//    var nombre = document.getElementById("nombre").value;
//    var apellido = document.getElementById("apellido").value;
//    var cedula = document.getElementById("cedula").value;
//    var id = document.getElementById("id").value;
//    var big_sujetoprotagonico_id = document.getElementById("big_sujetoprotagonico_id").value;
//    if (cedula!='')
//        {
//        if (document.getElementById("tRIR"+id) === null){}
//        else 
//            { 
//            var fila = document.getElementById("tRIR"+id);
//            fila.parentNode.removeChild(fila);
//            }
//            $("<tr id='tRIR"+id+"'><td id='tDIR"+id+"' width='20%'>"+cedula+"</td><td width='70%'>"+nombre+" "+apellido+"</td><td width='10%'><input class='btn btn-sm' type='button' onclick=Revocatoria.BorrarFila('tRIR"+id+"'); value=Eliminar></td></tr>").insertAfter($('#tablaintegrantes'));
//            $("<input type='hidden' id='IntegrantesBig_sujetoprotagonico_id' name='data[Integrantes]["+id+"][big_sujetoprotagonico_id]' value='"+big_sujetoprotagonico_id+"'>").insertBefore($('#tDIR'+id));
//            $("<input type='hidden' id='IntegrantesBig_sujetosnatural_id' name='data[Integrantes]["+id+"][big_sujetosnatural_id]' value='"+id+"'>").insertBefore($('#tDIR'+id));
//            $("<input type='hidden' id='IntegrantesCedula' name='data[Integrantes]["+id+"][cedula]' value='"+cedula+"'>").insertBefore($('#tDIR'+id));
//            $("<input type='hidden' id='IntegrantesNombre' name='data[Integrantes]["+id+"][nombre]' value='"+nombre+"'>").insertBefore($('#tDIR'+id));
//            $("<input type='hidden' id='IntegrantesApellido' name='data[Integrantes]["+id+"][apellido]' value='"+apellido+"'>").insertBefore($('#tDIR'+id));        
//    }
//        
//    },
//    BorrarFila : function(idfila)
//    {
//    var fila = document.getElementById(idfila);
//    fila.parentNode.removeChild(fila);   
//    },
//    buscarotorgamiento : function()
//        {
//        var cedula= document.getElementById('OtorgamientoNumDencedula').value;
//        if(cedula=='')
//            {
//            }
//        else 
//            {
//            $.ajax(
//                {
//                async:true, data:$("#OtorgamientoNumDencedula").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#buscar").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/buscarotorgamiento"
//                });
//            return false;
//            }
//        },
//    establecerOtorgamiento : function(id)
//        {
//        $.ajax(
//                {
//                async:true, data:'data%5BSolicitanteaotorgar%5D%5Bbig_sujetoprotagonico_id%5D='+id, 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#formulariodenunciante").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/solicitanteaotorgar"
//                });
//            return false;
//           
//        },
//    cedulaescaneada : function()
//        {
//        archivo= document.getElementById('str_archivo').value;
//        extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
//        if (extension=='.png' || extension=='.jpg' || extension=='.jpeg')
//            {
//            }
//        else
//            {
//            document.getElementById('str_archivo').value=null
//            }
//        },
//    inspeccion : function()
//        {
//        $("#SolicitudAceptar").bind("change", function (event) 
//            {
//            $.ajax(
//                {
//                async:true, data:$("#SolicitudAceptar").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#divAceptar").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/aceptar"
//                });
//            return false;
//            }); 
//
//        $(function ()
//            {
//            $('#myTab a:first').tab('show')
//            });
//        $("#SolicitudrevocatoriaBigValtiposolicitudId").bind("change", function (event) 
//            {
//            $.ajax(
//                {
//                async:true, data:$("#SolicitudrevocatoriaBigValtiposolicitudId").serialize(), 
//                dataType:"html", success:function (data, textStatus) 
//                    {
//                    $("#formulariodenunciante").html(data);
//                    }
//                , type:"post", url:"\/Revocatoria\/formulariodenunciante"
//                });
//            return false;
//            }); 
//        },
//    validarArchivoActa : function()
//    {
//    archivo= document.getElementById('RevocatoriaStrArcimagenarchivo').value
//    extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
//    if (extension=='.pdf')
//        {
//        document.getElementById('msjImgActa').style.display='none'    
//        }
//    else
//        {
//        document.getElementById('msjImgActa').style.display='inline';
//        document.getElementById('RevocatoriaStrArcimagenarchivo').value=null
//        }
//    },
//    guardardocumento : function()
//        {
//        var cantidad=document.getElementsByTagName("tr").length;
//        var Tipo = document.getElementById("RevocatoriaValtipoarchivo").value;//el valor del campo
//        var Documento=document.getElementById("RevocatoriaValtipoarchivo").options[document.getElementById("RevocatoriaValtipoarchivo").selectedIndex].innerHTML; //el texto o nombre del valor
//        var descripcion = document.getElementById("RevocatoriaValtipoarchivo").value;
//        if (Tipo!='' && Documento!='')
//            {        
//                
//             if (document.getElementById("trDocumento"+Tipo) === null){}
//            else 
//                { 
//                var fila = document.getElementById("trDocumento"+Tipo);
//                fila.parentNode.removeChild(fila);
// //                }
//            $("<tr id='trDocumento"+Tipo+"'>
// 				<td id='tdDocumento"+Tipo+"' width='20%'>
// 						<input type='hidden' id='RevocatoriaValtipoarchivo'  name='data[Archivosolicitud1]["+cantidad+"][valtipoarchivo]' value='"+Tipo+"'>"+Documento+"</td>\n\
//        				<td width='100%'>
// 	               		<input type='file' id='RevocatoriaStrArcimagenarchivo' onChange=Revocatoria.validarArchivoActa(); name='data[Archivosolicitud1]["+cantidad+"][str_arcimagenarchivo]' value='"+descripcion+"'>
// 	               		<a id='msjImgActa' style='color:red;display:none;'> Solo se permite archivos formato pdf. </a>
//                		</td>
//            		<td>
//            		<input class='btn btn-sm' type='button' onclick=Revocatoria.BorrarFila('trDocumento"+Tipo+"'); value=Eliminar></td></tr>").insertAfter($('#tablaArchivo'));
           //$("<input type='hidden' id='Documentosbig_valinstitucion_id'  name='data[Documentos]["+cantidad+"][big_valinstitucion_id]' value='"+Tipo+"'>").insertBefore($('#tdDocumento'+Tipo));
          //}
//        document.getElementById("RevocatoriaValtipoarchivo").value='';
//        document.getElementById("RevocatoriaStrArcimagenarchivo").value=''; 
//        
//        
// },
//        