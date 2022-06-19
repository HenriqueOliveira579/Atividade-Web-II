<?php

    require "Model/Produto.php";
    require "Utils/Utils.php";

    class IndexController {

        public function main() 
        {

            $templateProdutos = "";
            foreach (Produto::getAll() as $produto) {
                $templateProdutos = $templateProdutos . $produto->renderCard();
            }

            $templateIndex = file_get_contents("View/index.html");

            echo str_replace("{{cardsProdutos}}", $templateProdutos, $templateIndex);
        }

    }

    $controller = new IndexController();
    $controller->main();

