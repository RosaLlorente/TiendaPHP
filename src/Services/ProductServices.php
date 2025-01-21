<?php
namespace Services;

use Models\Product;
use Repositories\ProductRepository;

class ProductServices
{
    //PROPIEDADES
    private ProductRepository $productRepository;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    //METODOS
    /**
     * Conexión con repositorio para registrar un producto.
     *
     * Este método se encarga de conectar el controlador con el repositorio para acceder a la base de datos.
     * 
     * @param Product $product Los datos del producto introducidos por el usuario.
     * 
     * @return void
     */
    public function CreateProduct(Product $product) : void
    {
        $this->productRepository->CreateProduct($product);
    }

    /**
     * Obtener todos los productos.
     *
     * Este método conecta el controlador con el repositorio para obtener una lista de todos los productos
     * almacenados en la base de datos.
     * 
     * @return array Un array con la información de todos los productos.
     */
    public function getAllProduct(): array
    {
        return $this->productRepository->getAllProduct();
    }

    /**
     * Eliminar un producto por su ID.
     *
     * Este método se encarga de conectar el controlador con el repositorio para eliminar un producto
     * específico de la base de datos utilizando su identificador único.
     * 
     * @param int $id El identificador único del producto que se desea eliminar.
     * 
     * @return void
     */
    public function DeleteProduct(int $id): void
    {
        $this->productRepository->DeleteProduct($id);
    }

    /**
     * Mostrar productos aleatorios.
     *
     * Este método conecta el controlador con el repositorio para obtener una lista de productos seleccionados
     * aleatoriamente de la base de datos.
     * 
     * @return array Un array con la información de los productos seleccionados aleatoriamente.
     */
    public function ShowRandomProducts(): array
    {
        return $this->productRepository->ShowRandomProducts();
    }

}