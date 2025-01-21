<?php
namespace Services;

use Models\User;
use Repositories\UserRepository;

class UserServices{
    //PROPIEDADES
    private UserRepository $userRepository;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    //METODOS
    /**
     * Conexión con repositorio para registrar usuario.
     *
     * Este método se encarga de conectar el controlador con el repositorio,para acceder a la base de datos.
     * 
     * @param user los datos anteriormente introducidos por el usuario
     * 
     * @return User Devuelve los datos anteriormente introducidos por el usuario
     */
    public function RegisterUser(User $user)
    {
        $this->userRepository->create($user);
    }

    /**
     * Conexión con repositorio para loguear usuario.
     *
     * Este método se encarga de conectar el controlador con el repositorio,para acceder a la base de datos.
     * 
     * @return User Devuelve los datos anteriormente introducidos por el usuario
     */
    public function LoginUser($User)
    {
        $email = $User->getEmail();
        $password = $User->getPassword();
        $userData = $this->userRepository->login($email, $password);
        if ($userData) 
        {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['role'] = $userData['rol']; 
            $_SESSION['user_name'] = $userData['nombre'];
            return true;
        } 
        else 
        {
            return false;
        }
    }
}