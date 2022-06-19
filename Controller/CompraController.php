<?php

    require "../Model/Endereco.php";
    require "../Model/Cliente.php";
    require "../Model/Produto.php";
    require "../Model/Pedido.php";



    class CompraController {

        private $camposObrigatorios = ["nome", "telefone", "entrega","pagamento", "carrinho"];
        private $camposEndereco = ["estado", "cidade", "bairro", "rua", "numero", "complemento"];

        public function main()
        {

            if (!$this->verificarCamposObrigatorios()) {
                $this->redirecionar("https://http.cat/400");
            }

            if ($_POST["entrega"] == "delivery") {

                $delivery = true;

                if (!$this->verificarCamposEndereco()) {
                    $this->redirecionar("https://http.cat/400");
                }

                $endereco = new Endereco();
                foreach($this->camposEndereco as $campoEndereco) {
                    $endereco->set($campoEndereco, $_POST[$campoEndereco]);
                }

            } else {
                $endereco = null;
                $delivery = false;
            }

            $cliente = new Cliente($_POST["nome"], $_POST["telefone"], $endereco);
            $carrinho = $this->getCarrinho();

            $pedido = new Pedido($cliente, $carrinho, $delivery);

            $this->render($pedido);

        }
        private function redirecionar($url) {
            header("Location: ".$url);
        }

        private function verificarCamposObrigatorios() {

            foreach ($this->camposObrigatorios as $campoObrigatorio) {
                if (empty($_POST[$campoObrigatorio])) {
                    return false;
                }
            }
            return true;
        }

        private function verificarCamposEndereco() {

            foreach($this->camposEndereco as $campoEndereco) {
                if (empty($_POST[$campoEndereco])) {
                    return false;
                }
            }

            return true;
        }

        private function getCarrinho() {
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

        private function render($pedido) {
            $template = file_get_contents("../View/infos-pedido.html");

            $template = str_replace("{{precoTotal}}", $pedido->getPrecoTotal(), $template);
            $template = str_replace("{{precoEntrega}}", $pedido->getPrecoDelivery(), $template);
            $template = str_replace("{{precoSubTotal}}", $pedido->getPrecoSubTotal(), $template);

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
