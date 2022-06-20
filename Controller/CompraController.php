<?php

    require "../Model/Endereco.php";
    require "../Model/Cliente.php";
    require "../Model/Produto.php";
    require "../Model/Pedido.php";
    require "../Utils/Utils.php";

    class CompraController {

        private $camposObrigatorios = ["nome", "telefone", "entrega","pagamento", "carrinho"];
        private $camposObrigatoriosEndereco = ["estado", "cidade", "bairro", "rua", "numero"];
        private $camposOpcionaisEndereco = ["complemento"];

        public function main()
        {
            if (!$this->verificarCamposObrigatorios()) {
                $this->redirecionar("https://http.cat/400");
            }

            if ($_POST["entrega"] == "delivery") {

                $delivery = true;
                $endereco = new Endereco();

                if (!$this->verificarCamposObrigatoriosEndereco()) {
                    $this->redirecionar("https://http.cat/400");
                }

                if ($this->verificarCamposOpcionaisEndereco()) {
                    
                    $endereco->setComplemento($_POST["complemento"]);
                }

                
                foreach($this->camposObrigatoriosEndereco as $campoObrigatorioEndereco) {
                    $endereco->set($campoObrigatorioEndereco, $_POST[$campoObrigatorioEndereco]);
                }

                foreach ($this->camposOpcionaisEndereco as $campoOpcionalEndereco) {
                    $endereco->set($campoOpcionalEndereco, $_POST[$campoOpcionalEndereco]);
                }

            } else {
                $endereco = null;
                $delivery = false;
            }

            $cliente = new Cliente($_POST["nome"], $_POST["telefone"], $endereco);
            $carrinho = $this->getCarrinho();

            if (empty($carrinho)) {
                $this->redirecionar("https://http.cat/400");
            }

            $pedido = new Pedido($cliente, $carrinho, $delivery);

            $this->render($pedido);

        }
        private function redirecionar($url) 
        {
            header("Location: ".$url);
        }

        private function verificarCamposObrigatorios() 
        {
            foreach ($this->camposObrigatorios as $campoObrigatorio) {
                if (empty($_POST[$campoObrigatorio])) {
                    return false;
                }
            }
            return true;
        }

        private function verificarCamposOpcionaisEndereco() {
            foreach ($this->camposOpcionaisEndereco as $campoOpcionalEndereco) {
                if (empty($_POST[$campoOpcionalEndereco])) {
                    return false;
                }
            }
            return true;
        }

        private function verificarCamposObrigatoriosEndereco() 
        {
            foreach($this->camposObrigatoriosEndereco as $campoObrigatorioEndereco) {
                if (empty($_POST[$campoObrigatorioEndereco])) {
                    return false;
                }
            }

            return true;
        }

        private function getCarrinho() 
        {
            $carrinho = [];

            foreach ($_POST["carrinho"] as $item) {
                if (!empty($item["quantidade"])) {
                    $produto = Produto::getById((int)$item["id-produto"]);
                    $produto->setQuantidade((int)$item["quantidade"]);
                    $carrinho[] = $produto;
                }
            }

            return $carrinho;
        }

        private function render($pedido) 
        {
            $template = file_get_contents("../View/infos-pedido.html");

            $template = str_replace("{{precoTotal}}", Utils::formatarPreco($pedido->getPrecoTotal()), $template);
            $template = str_replace("{{precoEntrega}}", Utils::formatarPreco($pedido->getPrecoDelivery()), $template);
            $template = str_replace("{{precoSubTotal}}", Utils::formatarPreco($pedido->getPrecoSubTotal()), $template);

            $templateCarrinho = "";

            foreach ($pedido->getProdutos() as $produto) {

                $templateCarrinho = $templateCarrinho . $produto->renderLinha() . "<br>";

            }


            $template = str_replace("{{carrinho}}", $templateCarrinho, $template);

            echo $template;
        }

    }

    $controller = new CompraController();
    $controller->main();
