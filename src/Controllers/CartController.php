<?php
namespace Controllers;

use Lib\Pages;

class CartController
{
    // PROPIEDADES
    private Pages $page;

    // CONSTRUCTOR
    public function __construct()
    {
        $this->page = new Pages();
    }

    //METODOS
    public function viewCart()
    {
        $this->page->render('Cart/Cart');
    }
}
