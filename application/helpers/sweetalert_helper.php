<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Helpers Sweetalert_helper
 *
 * This Helpers for ...
 *
 * @package   CodeIgniter
 * @category  Helpers
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 *
 */

// ------------------------------------------------------------------------

if (!function_exists('a_alert')) {
    function a_alert($type, $titulo, $mensaje)
    {
        $alert = "
    Swal.fire(
      '$titulo',
      '$mensaje',
      '$type'
    );";
        return $alert;
    }
}
if (!function_exists('a_pregunta')) {
    function a_pregunta($titulo, $mensaje, $function)
    {
        $exploted = explode('/', $function);

        if (count($exploted) > 0) {

            if (count($exploted) > 1) {
                $alert = "
                Swal.fire({
                    title: '$titulo',
                    text: '$mensaje',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '##d33',
                    confirmButtonText: 'Confirmar'
                }).then(function(result) {
                    if (result.value) {
                    " . $exploted[0] . "($exploted[1]);
                    }
                });";
            } else {
                $alert = "
                Swal.fire({
                    title: '$titulo',
                    text: '$mensaje',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '##d33',
                    confirmButtonText: 'Confirmar'
                }).then(function(result) {
                    if (result.value) {
                    " . $function . "();
                    }
                });";
            }
        } else {
            $alert = 'alert("error");';
        }

        return $alert;
    }
}

if (!function_exists('AjaxCatchError')) {
    function AjaxCatchError($type, $titulo, $selector)
    {
        $alert =
            "
    let XHRmenssage= " .
            $selector .
            ".responseJSON;
    Swal.fire(
      '$titulo',
      XHRmenssage,
      '$type'
    );";
        return $alert;
    }
}

if (!function_exists('AlertErrorAjax')) {
    function AlertErrorAjax($selector)
    {
        $alert =
            "
    let XHRmenssage= " .
            $selector .
            ".responseJSON;
    Swal.fire(
      'Wuups!',
      XHRmenssage,
      'error'
    );";
        return $alert;
    }
}

if (!function_exists('password_modal')) {


    function password_modal($titulo, $function)
    {

        $exploted = explode('/', $function);

        if (count($exploted) > 0) {

            $alert = '
                    Swal.fire({
                          title: "' . $titulo . '",
                          html: "Introduzca su contraseña para continuar",
                          input: "password",
                            inputPlaceholder: "Ingrese su contraseña",
    
                          inputAttributes: {
                            autocapitalize: "off"
                          },
                          showCancelButton: true,
                          
                          closeOnClickOutside: false,
                          cancelButtonText: "Cancelar",
                          confirmButtonText: "Confirmar",
                          
                          inputValidator: mipass => {
                              if(!mipass){
                                  return "Por favor ingrese su contraseña";
                              }else{
                                  return undefined;
                              }
                          },
                          showLoaderOnConfirm: true,
                          preConfirm: (contra) => {
                              token =  {"password":  contra};
                              
                                $.ajax({
                                    
                                    url: "' . base_url('Auth_controller/verificarpassword') . '",
                                    method: "POST",
                                    data: {
                                        "pass": token 
                                    },
                                    dataType: "json",
                                    success: function(response){
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "success",
                                            title: "Permiso concedido",
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                        
                                    },
                                    error:function(jqXHR){
                                        console.log(jqXHR);
                                        Swal.fire({
                                            position: "top-end",
                                            icon: "error",
                                            title: "Contraseña incorrecta",
                                            showConfirmButton: false,
                                            timer: 1500
                                          })
                                    }
                                    
                                    
                                    
                                });
                          },
                          allowOutsideClick: () => !Swal.isLoading()
                        })
    
    
            ';
        } else {
            $alert = 'alert("error");';
        }



        return $alert;
    }
}


// ------------------------------------------------------------------------

/* End of file Sweetalert_helper.php */
/* Location: ./application/helpers/Sweetalert_helper.php */
