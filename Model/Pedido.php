<?php

    class Pedido {
        private $cliente;
        private $produtos;
        private $delivery;
        private $precoDelivery = 10;

        public function __construct($cliente, $produtos, $delivery=false) {
            $this->cliente = $cliente;
            $this->produtos = $produtos;
            $this->delivery = $delivery;
        }

        public function getPrecoTotal() {

            $soma = 0;

            foreach ($this->produtos as $produto) {

                $soma += $produto->getPrecoTotal();

            }

            if ($this->delivery) {
                $soma += $this->precoDelivery;
            }

            return $soma;
        }

        public function getPrecoSubTotal() {
            return $this->getPrecoTotal() - $this->getPrecoDelivery();
        }

        public function getPrecoDelivery()
        {
            if ($this->delivery) {
                return $this->precoDelivery;
            } else {
                return 0;
            }

        }

        public function getCliente()
        {
            return $this->cliente;
        }

        public function setCliente($cliente)
        {
            $this->cliente = $cliente;
        }

        public function getProdutos()
        {
            return $this->produtos;
        }

        public function setProdutos($produtos)
        {
            $this->produtos = $produtos;
        }

        public function getDelivery()
        {
            return $this->delivery;
        }

        public function setDelivery(mixed $delivery)
        {
            $this->delivery = $delivery;
        }
}