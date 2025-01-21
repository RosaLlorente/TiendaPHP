<?php
namespace Repositories;

use Lib\DataBase;
use Models\Product;
use PDOException;
use PDO;
use Exception;

class ProductRepository{
    //PROPIEDADES
    private DataBase $db;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->db = new DataBase;
    }

    //METODOS
    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param Product $product El objeto producto que se va a crear.
     * @return bool Devuelve true si el producto se creó correctamente, false en caso contrario.
     * @throws Exception Si la categoría del producto no existe.
     */
    public function CreateProduct(Product $product) : bool
    {
        try {
            $sql = $this->db->prepare('SELECT COUNT(*) FROM categorias WHERE id = :categoria_id');
            $sql->bindValue(':categoria_id', $product->getCategoriaId(), PDO::PARAM_INT);
            $sql->execute();
            $count = $sql->fetchColumn();

            if ($count == 0) {
                throw new Exception("La categoría no existe.");
            }

            $sql = $this->db->prepare('INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) 
                                    VALUES (:categoria_id, :nombre, :descripcion, :precio, :stock, :oferta, :fecha, :imagen)');
            $sql->bindValue(':categoria_id', $product->getCategoriaId(), PDO::PARAM_INT);
            $sql->bindValue(':nombre', $product->getNombre(), PDO::PARAM_STR);
            $sql->bindValue(':descripcion', $product->getDescripcion(), PDO::PARAM_STR);
            $sql->bindValue(':precio', $product->getPrecio(), PDO::PARAM_STR);
            $sql->bindValue(':stock', $product->getStock(), PDO::PARAM_INT);
            $sql->bindValue(':oferta', $product->getOferta(), PDO::PARAM_INT);
            $sql->bindValue(':fecha', $product->getFecha()->format('Y-m-d'), PDO::PARAM_STR);
            $sql->bindValue(':imagen', $product->getImagen(), PDO::PARAM_STR);
            $sql->execute();

            return true;
        } catch (PDOException $err) {
            error_log("Error al crear el producto: " . $err->getMessage());
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        } finally {
            if (isset($sql)) {
                $sql->closeCursor();
            }
        }
    }

    /**
     * Obtiene todos los productos de la base de datos.
     *
     * @return array Un arreglo asociativo que contiene todos los productos.
     * @throws PDOException Si ocurre un error al ejecutar la consulta.
     */
    public function getAllProduct(): array
    {
        try 
        {
            $sql = $this->db->prepare('SELECT * FROM productos');
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $err) 
        {
            error_log("Error al obtener productos: " . $err->getMessage());
            return [];
        }
    }

    /**
     * Elimina un producto de la base de datos.
     *
     * @param int $id El ID del producto a eliminar.
     * @return bool Devuelve true si el producto fue eliminado exitosamente, false en caso contrario.
     */
    public function DeleteProduct(int $id): bool
    {
        try {
            $sql = $this->db->prepare('DELETE FROM productos WHERE id = :id');
            $sql->bindValue(':id', $id, PDO::PARAM_INT);
            $sql->execute();
            return true;
        } catch (PDOException $err) {
            error_log("Error al eliminar el producto: " . $err->getMessage());
            return false;
        } finally {
            if (isset($sql)) {
                $sql->closeCursor();
            }
        }
    }

    /**
     * Muestra productos aleatorios.
     *
     * Este método selecciona 3 productos aleatorios de la base de datos y los devuelve en un array.
     *
     * @return array Un array asociativo que contiene los datos de los productos aleatorios.
     * @throws PDOException Si ocurre un error al ejecutar la consulta SQL.
     */
    public function ShowRandomProducts(): array
    {
        try {
            // Seleccionar 3 productos aleatorios
            $sql = $this->db->prepare('SELECT * FROM productos ORDER BY RAND() LIMIT 3');
            $sql->execute();
            $products = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $err) {
            error_log("Error al obtener productos aleatorios: " . $err->getMessage());
            return [];
        } finally {
            if (isset($sql)) {
                $sql->closeCursor();
            }
        }
    }
}