<?php
namespace Routes;

use Controllers\CategoryController;
use Controllers\ErrorController;
use Controllers\ProductController;
use Controllers\UserController;
use Controllers\CartController;
use Lib\Router;

class Routes {
    //Página productos para el inicio
    public static function index(){
        Router::add('GET', '/', function() {
            (new ProductController()) -> ShowRandomProducts();
        });

    //Registro
    Router::add('GET', '/registro', function() {
        (new UserController())->Register();
    });
    Router::add('POST', '/registro', function() {
        (new UserController())->Register();
    });

    //Login
    Router::add('GET', '/login', function() {
        (new UserController())->Login();
    });
    Router::add('POST', '/login', function() {
        (new UserController())->Login();
    });
    Router::add('GET', '/logout', function() {
        (new UserController())->Logout();
    });

    //Category
    Router::add('GET', '/ManageCategory', function(){
        (new CategoryController())->HandleCategory();
    });
    Router::add('POST', '/ManageCategory', function(){
        (new CategoryController())->HandleCategory();
    });

    Router::add('GET', '/DeleteCategory', function(){
        (new CategoryController())->DeleteCategory();
    });
    Router::add('POST', '/DeleteCategory', function(){
        (new CategoryController())->DeleteCategory();
    });
    
    //Product
    Router::add('GET', '/ManageProduct', function(){
        (new ProductController())->ManageProduct();
    });
    Router::add('POST', '/ManageProduct', function(){
        (new ProductController())->ManageProduct();
    });
    Router::add('GET', '/DeleteProduct', function(){
        (new ProductController())->DeleteProduct();
    });
    Router::add('POST', '/DeleteProduct', function(){
        (new ProductController())->DeleteProduct();
    });
    Router::add('GET', '/Catalog', function(){
        (new ProductController())->ViewCatalog();
    });
    Router::add('POST', '/Catalog', function(){
        (new ProductController())->ViewCatalog();
    });

    //Cart
    Router::add('GET', '/Cart', function(){
        (new CartController())->viewCart();
    });
    Router::add('POST', '/Cart', function(){
        (new CartController())->viewCart();
    });
    
    //ERROR
    Router::add('GET', '/not-found', function() {
        ErrorController::error404();
    });

    Router::dispatch();
    }
}
