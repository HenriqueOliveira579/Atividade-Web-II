<?php

class Endereco {
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $complemento;

    function __construct($estado=null, $cidade=null, $bairro=null, $rua=null, $numero=null, $complemento=null) {
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;

    }

    public function getEstado(): mixed
    {
        return $this->estado;
    }

    public function setEstado(mixed $estado): void
    {
        $this->estado = $estado;
    }

    public function getCidade(): mixed
    {
        return $this->cidade;
    }

    public function setCidade(mixed $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getBairro(): mixed
    {
        return $this->bairro;
    }

    public function setBairro(mixed $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getRua(): mixed
    {
        return $this->rua;
    }

    public function setRua(mixed $rua): void
    {
        $this->rua = $rua;
    }

    public function getNumero(): mixed
    {
        return $this->numero;
    }

    public function setNumero(mixed $numero): void
    {
        $this->numero = $numero;
    }

    public function getComplemento(): mixed
    {
        return $this->complemento;
    }

    public function setComplemento(mixed $complemento): void
    {
        $this->complemento = $complemento;
    }




}