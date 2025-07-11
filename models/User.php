<?php
require_once __DIR__ . '/../config/database.php';

class User
{
    private $db;

    public function __construct(PDO $conexion) // Ahora espera una conexión PDO
    {
        $this->db = $conexion; // Asigna la conexión recibida
    }

    //Método getAll(): Devuelve todos los usuarios.
    public function getAll()
    {
        $stmt = $this->db->query("SELECT id, nombre, email, password, rol, fecha_registro FROM users"); //Ejecuta la consulta SQL y devuelve todos los resultados como un array asociativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //Devuelve todos los resultados como un array asociativo.
    }

    //Método create(): Crea un nuevo usuario en la base de datos.
    public function create($nombre, $email, $password, $rol, $fecha_registro)
    {
        $stmt = $this->db->prepare("INSERT INTO users (nombre, email, password, rol, fecha_registro) VALUES (?, ?, ?, ?, ?)"); //Prepara una consulta SQL para insertar un nuevo usuario en la base de datos.
        return $stmt->execute([$nombre, $email, $password, $rol, $fecha_registro]); //Ejecuta la consulta SQL con los parámetros proporcionados.
    }


    //Método find(): Busca un usuario por su ID.
    public function find($id)
    { 
        $stmt = $this->db->prepare("SELECT id, nombre, email, password, rol, fecha_registro FROM users WHERE id = ?"); //Prepara una consulta SQL para buscar un usuario por su ID.
        $stmt->execute([$id]); //Ejecuta la consulta SQL con el ID proporcionado.
        return $stmt->fetch(PDO::FETCH_ASSOC); //Devuelve el resultado como un array asociativo.
    }


    //Método update(): Actualiza un usuario en la base de datos.
   public function update($id, $name, $email)
    { //Método update(): Actualiza un usuario en la base de datos.
        $stmt = $this->db->prepare("UPDATE users SET nombre = ?, email = ? WHERE id = ?"); //Prepara una consulta SQL para actualizar un usuario en la base de datos.
        return $stmt->execute([$name, $email, $id]); //Ejecuta la consulta SQL con los parámetros proporcionados.
    }


    //Método delete(): Elimina un usuario de la base de datos.
    public function delete($id)
    { 
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?"); //Prepara una consulta SQL para eliminar un usuario de la base de datos.
        return $stmt->execute([$id]); //Ejecuta la consulta SQL con el ID proporcionado.
    }

    // Método getByEmail(): Busca un usuario por su correo electrónico. Para la autenticacion
    public function getByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT id, nombre, email, password, rol, fecha_registro FROM users WHERE email = ?");// Prepara una consulta SQL para buscar un usuario por su correo electrónico.
        $stmt->execute([$email]);// Ejecuta la consulta SQL con el correo electrónico proporcionado.
        return $stmt->fetch(PDO::FETCH_ASSOC);// Devuelve el resultado como un array asociativo.
    }


    //Metodos para recupetacion de contrasena
    public function saveResetToken($userId, $token, $expiry)
    {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = ?, token_expiry = ? WHERE id = ?");
        $stmt->execute([$token, $expiry, $userId]);
    }

    public function findByToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE reset_token = ?");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $userId]);
    }

    public function clearResetToken($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = NULL, token_expiry = NULL WHERE id = ?");
        $stmt->execute([$userId]);
    }

    
}