<?php
require_once __DIR__ . '/../models/User.php'; // Requiere el modelo User para interactuar con la base de datos.

class UserController // Controller para manejar las operaciones relacionadas con los usuarios.
{
    private $userModel; // Declara una propiedad privada para el modelo User.

    public function __construct(PDO $db) // Constructor de la clase UserController.
    {

        $this->userModel = new User($db); // Inicializa el modelo User.
    }

    // Mostrar la lista de usuarios
    // Display the list of users
    public function index()
    {
        session_start();
        $users = $this->userModel->getAll(); // Obtiene todos los usuarios del modelo.
        require_once __DIR__ . '/../views/users/index.php'; // Carga la vista para mostrar los usuarios.
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }
    }


    // Metodo create(): muestra el formularion para crear un nuevo usuario
    public function create()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }
        include __DIR__ . '/../views/users/create.php'; // Incluye la vista para mostrar el formulario de creación de un nuevo usuario.
    }


    // Método store(): Guarda un nuevo usuario en la base de datos.
    public function store($nombre, $email, $password, $rol)
    {
        $errors = []; // Declara un array para almacenar errores de validación.

        if (empty($nombre)) { // Si el nombre está vacío
            $errors[] = "El nombre es obligatorio."; // Agrega un mensaje de error al array.
        }

        if (empty($email)) { // Si el correo electrónico está vacío
            $errors[] = "El correo electrónico es obligatorio."; // Agrega un mensaje de error al array.
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Si el correo electrónico no es válido
            $errors[] = "El formato del correo no es válido."; // Agrega un mensaje de error al array.
        }

        if (empty($password)) { // Si la contraseña está vacía
            $errors[] = "El password es obligatorio."; // Agrega un mensaje de error al array.
        }

        if (empty($rol)) { // Si el rol está vacío
            $errors[] = "El rol es obligatorio."; // Agrega un mensaje de error al array.
        }

        if (count($errors) > 0) { // Si hay errores de validación
            $oldData = ['nombre' => $nombre, 'email' => $email]; // Guarda los datos ingresados en un array para volver a mostrarlos en el formulario.
            include __DIR__ . '/../views/users/create.php'; // Incluye la vista para mostrar el formulario de creación de un nuevo usuario con los datos ingresados.
        } else {
            // Aquí se aplica el hash
            $hashedPass = password_hash($password, PASSWORD_DEFAULT); // Aplica un hash a la contraseña ingresada para almacenarla de forma segura en la base de datos.

             // Crea una instancia del modelo User para interactuar con la base de datos.
            $this->$userModel->create($id, $nombre, $email, $hashedPass, $rol); // Guarda el nuevo usuario en la base de datos.
                

            header("Location: index.php?controller=user&action=index&success=1"); // Redirige a la lista de usuarios con un mensaje de éxito.
            exit;
        }
    }


    // Método edit(): Muestra el formulario para editar un usuario existente.
    public function edit($id)
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=iniciarSesion");
            exit;
        }
        $user = $this->userModel->find($id);

        


        if (!$user) { // Si no se encuentra el usuario
            die("Usuario no encontrado"); // Muestra un mensaje de error.
        }

        include __DIR__ . '/../views/users/edit.php'; // Incluye la vista para mostrar el formulario de edición del usuario.
    }


    // Método update(): Actualiza un usuario existente en la base de datos.
       
   public function update()
    {
        $id = $_POST['id'];
        $name = $_POST['nombre'];
        $email = $_POST['email'];
        $role = $_POST['rol'];

        $resultado = $this->userModel->update($id, $name, $email, $role);

        if ($resultado) {
            header('Location: index.php?controller=user&action=index');
        } else {
            echo "Error al actualizar el usuario."; // Error updating user
        }
    }

    // Método delete(): Elimina un usuario de la base de datos.
    public function delete($id)
    { 
        $this->userModel->delete($id);
        header("Location: index.php?controller=user&action=index&deleted=1"); // Redirige a la lista de usuarios con un mensaje de éxito.
        exit; // Redirige a la lista de usuarios con un mensaje de éxito.
    }



}