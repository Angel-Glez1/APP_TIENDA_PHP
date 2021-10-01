<?php
require_once 'Models/usuarioModel.php';

// INICIO DE CLASE
class usuarioController
{
    // Mostramos vista del formulario de registro
    public function registro()
    {
        require_once 'Views/Usuarios/registro.php';
    }

    //Registar nuevo Usuario
    public function save()
    {
        if (isset($_POST)) {
            //Validamos que el email que ingreso el usuario sea valido
            $email = !empty($_POST['email'])  ? $_POST['email'] :  false;
            $email2 = filter_var($email, FILTER_VALIDATE_EMAIL);
            $email3 = $email2 != false ? $email2 : false;

            // Validamos el resto de los campos
            $nombre   = !empty($_POST['nombre'])   ? htmlspecialchars($_POST['nombre'])  : false;
            $apellido = !empty($_POST['apellido']) ? htmlspecialchars($_POST['apellido']) : false;
            $password = !empty($_POST['password']) ? htmlspecialchars($_POST['password']) : false;


            /* Si los campos no estas vacios y cumplen con el tipo de dato que les corresponde Instanciamos un objeto
                    de tipo Usuario, el cual nos insereta un nuevo usuario ala aplicacion */
            if ($nombre != false && $apellido != false && $email3 != false && $password != false) {
                $newUsuario = new Usuario();
                $newUsuario->setNombre($nombre);
                $newUsuario->setApellido($apellido);
                $newUsuario->setEmail($email3);
                $newUsuario->setPassword($password);
                $result = $newUsuario->save();

                /**El metodo save() nos retorna si el insert into fue existoso, tambien nos retorna un el un sentia select con fect_objtc */
                if ($result == true) {

                    // Si todo sale bien lo 
                    $_SESSION['user'] = $result;
                    $_SESSION['registro'] = 'Exito';
                    header("location:" . URL_BASE);

                } else {
                    // Error en el insert
                    $_SESSION['registro'] = "fallo";
                    header("location:" . URL_BASE . "usuario/registro");
                }
            }else{
                // Error en la validacion de los campos
                $_SESSION['registro'] = 'fallo';
                header("location:" . URL_BASE . "usuario/registro");

            }
        }

        header("location:" . URL_BASE . "usuario/registro");
        
    }



    public function login()
    {
        if (isset($_POST)) {

            $user = new Usuario();
            $verify = $user->login($_POST['email'], $_POST['password']);

            if ($verify == true && is_object($verify)) {

                $_SESSION['user'] = $verify;

                /* Si el usuario tuviera un rol de tipo admi creamos una sescion especial para que se aviliten todas las opciones del admi en la pagina*/
                if ($verify->rol == 'admi') {
                    $_SESSION['admi'] = true;
                }

            } else {
                // error de la sentencia select del Login() en el modelo usuario
                $_SESSION['error_login'] = 'Fallido';
            }
        }

        header("location:" . URL_BASE);
    }

    public function cerrar()
    {

        session_destroy();

        header("location:" . URL_BASE);
    }
}
