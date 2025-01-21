<?php
namespace Controllers;

use Lib\Pages;
use Models\Category;
use Services\CategoryServices;

class CategoryController{

    //PROPIEDADES
    private Pages $page;
    private CategoryServices $categoryservices;

    //CONSTRUCTOR
    function __construct()
    {
        $this->page = new Pages();
        $this->categoryservices = new CategoryServices();
    }

    //METODOS
    /**
     * Panel de gestión de categorias
     *
     * Este método permite mostrar el panel de gestión de categorias.
     *
     * @return void
     */
    public function HandleCategory(): void
    {
        $this->CreateCategory();
        $this->ShowCategory();
    }

    /**
     * Crea una nueva categoría.
     *
     * Este método permite crear una nueva categoria en el sistema.
     * 
     * @param array $data Los datos del producto a crear.
     * @return void
     */
    public function CreateCategory(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($_POST['data'])
            {
                $Category = Category::fromArray($_POST['data']);
                $Category->sanear();
                if($Category->ValidarCreateCategory())
                {
                    try{
                        $this->categoryservices-> CreateCategory($Category);
                        $_SESSION['category'] = 'Complete';
                        header('Location: ' . BASE_URL .'ManageCategory'); 
                    }
                    catch(\Exception $e)
                    {
                        $_SESSION['category'] = 'Fail';
                        $_SESSION['errores'] = $e->getMessage();
                    }
                }
                else
                {
                    $_SESSION['category'] = 'Fail';
                    $_SESSION['errores'] = Category::getErrores();
                    if (isset($_SESSION['errores']) && is_array($_SESSION['errores']))
                    {
                        foreach ($_SESSION['errores'] as $error){
                            echo '<p style="color:red">*'.htmlspecialchars($error).'</p>';
                        }
                    }
                    $this->page->render('Category/ManageCategory');
                }
            }
            else
            {
                $_SESSION['category'] = 'Fail';
            }
        }
        else
        {
            $this->page->render('Category/ManageCategory');
            $_SESSION['category'] = 'Fail';
        }
    }

    /**
     * Muestra la lista de categorias.
     *
     * Este método obtiene todas las categorias utilizando el servicio de categorias
     * y los pasa a la vista para su renderización. En caso de que ocurra una excepción,
     * se registra el error en el log y se muestra una página de error.
     *
     * @return void
     */
    public function ShowCategory(): void
    {
        try 
        {
        $categories = $this->categoryservices->getAllCategories();
        $this->page->render('Category/ListCategories', ['categories' => $categories]);
        } catch (\Exception $e) 
        {
            error_log("Error al mostrar las categorías: " . $e->getMessage());
            $_SESSION['error'] = "No se pudieron cargar las categorías.";
            $this->page->render('Error/ErrorPage');
        }
    }

    /**
     * Elimina un categoria basada en la ID proporcionada a través de una solicitud POST.
     * 
     * Este método verifica si la solicitud es de tipo POST y luego intenta eliminar la categoria
     * utilizando el servicio de categorias. 
     * 
     * @return void
     */
    public function DeleteCategory(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $id = $_POST['id'] ?? null;

            if ($id) 
            {
                try 
                {
                    $this->categoryservices->DeleteCategory($id);
                    $_SESSION['message'] = "Categoría eliminada correctamente.";
                } 
                catch (\Exception $e) 
                {
                    $_SESSION['error'] = "Error al eliminar la categoría: " . $e->getMessage();
                }
            } 
            else 
            {
                $_SESSION['error'] = "ID no válido.";
            }
            header('Location: ' . BASE_URL . 'ManageCategory');
            exit;
        }
    } 
}