<?php
    namespace Controllers;
    use Lib\Pages;
    class ErrorController
    {
        /**
         * Maneja la página de error 404.
         *
         * Este método renderiza la página de error 404 cuando no se encuentra una página solicitada.
         * Utiliza la clase Pages para renderizar la vista 'error/error404' con un título
         * que indica que la página no fue encontrada.
         *
         * @return void
         */
        public static function error404()
        {
            $pages = new Pages();
            $pages->render('error/error404',['titulo' => 'Página no encontrada']);
        }
    }
?>