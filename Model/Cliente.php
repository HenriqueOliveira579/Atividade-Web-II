<?php

class Cliente {
    private $nome;
    private $telefone;
    private $endereco;

    function __construct($nome, $telefone, $endereco=null)
    {
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->endereco = $endereco;

    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function set($key, $value) {
        $this->$key = $value;
    }
}


?>