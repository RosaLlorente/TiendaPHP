<?php

namespace Repositories;

use Lib\DataBase;
use Models\User;
use PDOException;
use PDO;

class UserRepository{
    //PROPIEDADES
    private DataBase $db;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->db = new DataBase;
    }

    //METODOS
    /**
     * Insertar nuevo usuario en la base de datos.
     *
     * Este método se encarga de conectar con la base de datos e interactua con ella para realizar la insercción de un nuevo usuario.
     * 
     * @return bool Devuelve true si la ejecución ha sido exitosa,devuelve false si no ha sido exitosa.
     */
    public function create(User $user) : bool
    {
        try{
            $sql = $this->db->prepare('INSERT INTO usuarios (nombre,apellidos,email,password,rol) VALUES (:nombre, :apellidos, :email, :password, :rol)');
            $sql->bindValue(':nombre', $user->getNombre(),PDO::PARAM_STR);
            $sql->bindValue(':apellidos', $user->getApellidos(),PDO::PARAM_STR);
            $sql->bindValue(':email', $user->getEmail(),PDO::PARAM_STR);
            $sql->bindValue(':password', $user->getPassword(),PDO::PARAM_STR);
            $sql->bindValue(':rol', $user->getRole(),PDO::PARAM_STR);

            $sql->execute();
            return true;
        }
        catch(PDOException $err)
        {
            error_log("Error al crear el usuario:" . $err->getMessage());
            return false;
        }
        finally
        {
            if(isset($sql))
            {
                $sql->closeCursor();
            }
        }
    }

    /**
     * Buscar usuario en la base de datos.
     *
     * Este método se encarga de conectar con la base de datos y realizar una consulta
     * para extraer los datos de un usuario,luego verificara si los datos coinciden con los anteriores
     * que introdujo el usuario en el formulario.
     * 
     * @return bool Devuelve true si la ejecución ha sido exitosa,devuelve false si no ha sido exitosa.
     */
    public function login(string $email, string $password): ?array
    {
        try{
            $sql = $this->db->prepare('SELECT * FROM usuarios WHERE email = :email');
            $sql->bindValue(':email', $email, PDO::PARAM_STR);
            $sql->execute();

            $user = $sql->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($password, $user['password'])) 
                {
                    return $user;
                } 
                else 
                {
                    return null;
                }
            } 
            else 
            {
                return null;
            }
        }
        catch(PDOException $err)
        {
            error_log("Error al buscar el email:" . $err->getMessage());
            return false;
        }
        finally
        {
            if(isset($sql))
            {
                $sql->closeCursor();
            }
        }
    }
}