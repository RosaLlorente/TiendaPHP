<?php
namespace Services;

use Repositories\CategoryRepository;
use Models\Category;

class CategoryServices{
    
    //PROPIEDADES
    private CategoryRepository $categoryRepository;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    //METODOS
    /**
     * Crear una nueva categoría.
     *
     * Este método se encarga de conectar el controlador con el repositorio para registrar una nueva categoría
     * en la base de datos.
     * 
     * @param Category $category Los datos de la categoría introducidos por el usuario.
     * 
     * @return void
     */
    public function CreateCategory(Category $category) : void
    {
        $this->categoryRepository->CreateCategory($category);
    }

    /**
     * Obtener todas las categorías.
     *
     * Este método conecta el controlador con el repositorio para obtener una lista de todas las categorías
     * almacenadas en la base de datos.
     * 
     * @return array Un array con la información de todas las categorías.
     */
    public function getAllCategories(): array
    {
        return $this->categoryRepository->getAllCategories();
    }

    /**
     * Eliminar una categoría por su ID.
     *
     * Este método se encarga de conectar el controlador con el repositorio para eliminar una categoría
     * específica de la base de datos utilizando su identificador único.
     * 
     * @param int $id El identificador único de la categoría que se desea eliminar.
     * 
     * @return void
     */
    public function DeleteCategory(int $id): void
    {
        $this->categoryRepository->DeleteCategory($id);
    }
}