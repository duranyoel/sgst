/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var articles =
        {
            add: function () {
                    
            },
            index: function () {

            },
            buscar_articulo_soporte: function () {
                var articulo = document.getElementById('ServiceStatuBuscar').value;
                
                    $.ajax(
                            {
                                async: true, 
                                data: $("#ServiceStatuBuscar").serialize(),
                                dataType: "html", 
                                success: function (data, textStatus)
                                {
                                    $("#tablaarticulos").html(data);
                                }, 
                                type: "post", 
                                url: urlApp + "articles\/buscar_articulo_soporte"
                            });
                    return false;
                
            },
            addarticle:function(){
               
                
                    $.ajax(
                            {
                                async: true, 
                                data: $("#ServiceStatuSoporteForm").serialize(),
                                dataType: "html", 
                                success: function (data, textStatus)
                                {
                                    $("#articulosagregados").html(data);
                                }, 
                                type: "post", 
                                url: urlApp + "services\/addarticle"
                            });
                    return false;
            },
            deletearticleservice:function(id){
                 var id_service = document.getElementById('servicesart_id').value;
                $.ajax(
                            {
                                async: true, 
                                data: $("#ServiceStatuSoporteForm").serialize(),
                                dataType: "html", 
                                success: function (data, textStatus)
                                {
                                    $("#articulosagregados").html(data);
                                }, 
                                type: "post", 
                                url: urlApp + "services\/deletearticleservice\/"+id+"\/"+id_service
                            });
                           
                    return false;
                     
            },
            agregararticle: function ()
            {
                var id = document.getElementById("articles_id").value;
                var nombre = document.getElementById("nombre").value;
                var codigo = document.getElementById("codigo").value;
                var costo = document.getElementById("costo").value;
                var buscar = document.getElementById("ServiceStatuBuscar").value;
             
                if (buscar != '')
                {
                   var id_tr=document.getElementById("tRIR" + id);
                    if (id_tr === null) {
                    } else
                    {
                       
                        var fila = id_tr;
                        fila.parentNode.removeChild(fila);
                    }
                    $("<tr id='tRIR" + id + "'>\n\
                    <td id='tDIR" + id + "' width='20%'>" + id + "</td>\n\
                    <td width='20%'>" + codigo + "</td>\n\
                    <td width='20%'>" + nombre + "</td>\n\
                    <td width='30%'>" + costo + "</td>\n\
                    <td width='10%'><buttom class='btn btn-danger btn-sm btn-flat' type='button' onclick=articles.borrarfila('tRIR" + id + "');><span class='fa fa-trash'></span> Eliminar</buttom></td></tr>").insertAfter($('#articulosoporte'));
                    $("<input type='hidden' id='ServiceStatuArticle_id' name='data[ServiceStatu][" + id + "][articles_id]' value='" + id + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ServiceStatuCodigo' name='data[ServiceStatu][" + id + "][codigo]' value='" + codigo + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ServiceStatuNombre' name='data[ServiceStatu][" + id + "][nombre]' value='" + nombre + "'>").insertBefore($('#tDIR' + id));
                    $("<input type='hidden' id='ServiceStatuCosto' name='data[ServiceStatu][" + id + "][costo]' value='" + costo + "'>").insertBefore($('#tDIR' + id));
                    
                    
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