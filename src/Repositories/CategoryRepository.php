<?php
namespace Repositories;

use Lib\DataBase;
use Models\Category;
use PDOException;
use PDO;

class CategoryRepository{
    //PROPIEDADES
    private DataBase $db;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->db = new DataBase;
    }

    //METODOS
    /**
     * Crea una nueva categoría en la base de datos.
     *
     * @param Category $category El objeto categoría que se va a crear.
     * @return bool Devuelve true si la categoría se creó correctamente, false en caso contrario.
     * @throws PDOException Si ocurre un error al interactuar con la base de datos.
     */
    public function CreateCategory(Category $category) : bool
    {
        try{
            $sql = $this->db->prepare('INSERT INTO categorias (nombre) VALUES (:nombre)');
            $sql->bindValue(':nombre', $category->getNombre(),PDO::PARAM_STR);
            $sql->execute();
            return true;
        }
        catch(PDOException $err)
        {
            error_log("Error al crear la categoria:" . $err->getMessage());
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
     * Obtiene todas las categorías de la base de datos.
     *
     * @return array Un arreglo asociativo que contiene todos las categorías.
     * @throws PDOException Si ocurre un error al ejecutar la consulta.
     */
    public function getAllCategories(): array
    {
        try 
        {
            $sql = $this->db->prepare('SELECT * FROM categorias');
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $err) 
        {
            error_log("Error al obtener categorías: " . $err->getMessage());
            return [];
        }
    }

    /**
     * Elimina una categoría de la base de datos.
     *
     * @param int $id El ID del categoría a eliminar.
     * @return bool Devuelve true si el categoría fue eliminado exitosamente, false en caso contrario.
     */
    public function DeleteCategory(int $id): bool
    {
        try {
            $sql = $this->db->prepare('DELETE FROM categorias WHERE id = :id');
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $err) {
            error_log("Error al eliminar la categoría: " . $err->getMessage());
            return false;
        } finally {
            if (isset($sql)) {
                $sql->closeCursor();
            }
        }
    }
}