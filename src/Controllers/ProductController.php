<?php

namespace Controllers;

use Lib\Pages;
use Services\ProductServices;
use Models\Product;

class ProductController{

    //PROPIEDADES
    private Pages $page;
    private ProductServices $productServices;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->page = new Pages();
        $this->productServices = new ProductServices();
    }

    //METODOS
    /**
     * Panel de gestión de productos
     *
     * Este método permite mostrar el panel de gestión de productos.
     *
     * @return void
     */
    public function ManageProduct(): void
    {
        $this->CreateProduct();
        $this->ShowProduct();
    }

    /**
     * Crear producto
     *
     * Este método permite crear un nuevo producto en el sistema.
     *
     * @param array $data Los datos del producto a crear.
     * @return bool Devuelve true si el producto se creó correctamente, false en caso contrario.
     */
    public function CreateProduct(): void
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if($_POST['data'])
            {
                $_POST['data']['categoria_id'] = (int) $_POST['data']['categoria_id'];
                $_POST['data']['precio'] = (float) $_POST['data']['precio'];
                $_POST['data']['stock'] = (int) $_POST['data']['stock'];
                $_POST['data']['oferta'] = (int) $_POST['data']['oferta'];

                $Product = Product::fromArray($_POST['data']);
                $Product->sanear();
                if($Product->validarCreateProduct())
                {
                    try{
                        $this->productServices-> CreateProduct($Product);
                        $_SESSION['product'] = 'Complete';
                        header('Location: ' . BASE_URL .'ManageProduct'); 
                    }
                    catch(\Exception $e)
                    {
                        $_SESSION['product'] = 'Fail';
                        $_SESSION['errores'] = $e->getMessage();
                    }
                }
                else
                {
                    $_SESSION['product'] = 'Fail';
                    $_SESSION['errores'] = Product::getErrores();
                    if (isset($_SESSION['errores']) && is_array($_SESSION['errores']))
                    {
                        foreach ($_SESSION['errores'] as $error){
                            echo '<p style="color:red">*'.htmlspecialchars($error).'</p>';
                        }
                    }
                    $this->page->render('Product/ManageProduct');
                }
            }
            else
            {
                $_SESSION['product'] = 'Fail';
            }
        }
        else
        {
            $this->page->render('Product/ManageProduct');
            $_SESSION['product'] = 'Fail';
        }
    }


    /**
     * Muestra la lista de productos.
     *
     * Este método obtiene todos los productos utilizando el servicio de productos
     * y los pasa a la vista para su renderización. En caso de que ocurra una excepción,
     * se registra el error en el log y se muestra una página de error.
     *
     * @return void
     */
    public function ShowProduct(): void
    {
        try 
        {
        $products = $this->productServices->getAllProduct();
        $this->page->render('Product/ListProduct', ['products' => $products]);
        } catch (\Exception $e) 
        {
            error_log("Error al mostrar los productos: " . $e->getMessage());
            $_SESSION['error'] = "No se pudieron cargar los productos.";
            $this->page->render('Error/ErrorPage');
        }
    }

    /**
     * Elimina un producto basado en el ID proporcionado a través de una solicitud POST.
     * 
     * Este método verifica si la solicitud es de tipo POST y luego intenta eliminar el producto
     * utilizando el servicio de productos. 
     * 
     * @return void
     */
    public function DeleteProduct(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        {
            $id = $_POST['id'] ?? null;

            if ($id) 
            {
                try 
                {
                    $this->productServices->DeleteProduct($id);
                    $_SESSION['message'] = "Categoría eliminada correctamente.";
                } 
                catch (\Exception $e) 
                {
                    $_SESSION['error'] = "Error al eliminar el producto: " . $e->getMessage();
                }
            } 
            else 
            {
                $_SESSION['error'] = "ID no válido.";
            }
            header('Location: ' . BASE_URL . 'ManageProduct');
            exit;
        }
    }

    /**
     * Muestra productos aleatorios en la página.
     *
     * Este método intenta obtener una lista de productos aleatorios.
     * 
     * @return void
     */
    public function ShowRandomProducts()
    {
        try 
        {
            $products = $this->productServices->ShowRandomProducts();
            $this->page->render('Product/RandomProduct', ['products' => $products]);
        } catch (\Exception $e) 
        {
            error_log("Error al mostrar los productos: " . $e->getMessage());
            $_SESSION['error'] = "No se pudieron cargar los productos.";
            $this->page->render('Error/ErrorPage');
        }
    }

    /**
     * Muestra el catálogo de productos.
     *
     * Este método obtiene todos los productos utilizando el servicio de productos y 
     * renderiza la vista del catálogo de productos.
     *
     * @return void
     */
    public function ViewCatalog()
    {
        try 
        {
            $products = $this->productServices->getAllProduct();
            $this->page->render('Product/ViewCatalog', ['products' => $products]);
        } 
        catch (\Exception $e) 
        {
            error_log("Error al mostrar los productos: " . $e->getMessage());
            $_SESSION['error'] = "No se pudieron cargar los productos.";
            $this->page->render('Error/ErrorPage');
        }
    }
}
