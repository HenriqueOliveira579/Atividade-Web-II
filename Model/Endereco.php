<?php

class Endereco {
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $complemento;

    function __construct($estado=null, $cidade=null, $bairro=null, $rua=null, $numero=null, $complemento=null) 
    {
        $this->estado = $estado;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->complemento = $complemento;

    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado(mixed $estado)
    {
        $this->estado = $estado;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade(mixed $cidade)
    {
        $this->cidade = $cidade;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro(mixed $bairro)
    {
        $this->bairro = $bairro;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function setRua(mixed $rua)
    {
        $this->rua = $rua;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero(mixed $numero)
    {
        $this->numero = $numero;
    }

    public function getComplemento()
    {
        return $this->complemento;
    }

    public function setComplemento(mixed $complemento)
    {
        $this->complemento = $complemento;
    }  

    public function set($key, $value) 
    {
        $this->$key = $value;
    }
}