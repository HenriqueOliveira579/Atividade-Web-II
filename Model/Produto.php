<?php 

class Produto 
{
    private $id;
    private $nome;
    private $caminhoImagem;
    private $precoUnitario;
    private $quantidade;
    private $categoria;

    function __construct($nome, $caminhoImagem, $precoUnitario, $categoria, $id=null) 
    {

        $this->id = $id;
        $this->nome = $nome;
        $this->caminhoImagem = $caminhoImagem;
        $this->precoUnitario = $precoUnitario;
        $this->categoria = $categoria;

    }

    public function renderCard() 
    {
    
        $template = file_get_contents("Resources/templates/card-produto.html");

        $template = str_replace("{{caminhoImagem}}", $this->caminhoImagem, $template);
        $template = str_replace("{{nome}}", $this->nome, $template);
        $template = str_replace("{{preco}}", $this->precoUnitario, $template);
        $template = str_replace("{{id}}", $this->id, $template);
        $template = str_replace("{{categoria}}", $this->categoria, $template);

        return $template;

    }

    public function renderLinha() 
    {
        $template = file_get_contents("../Resources/templates/linha-produto.html");

        $template = str_replace("{{nome}}", $this->nome, $template);
        $template = str_replace("{{quantidade}}", $this->quantidade, $template);
        $template = str_replace("{{precoUnitario}}", $this->getPrecoUnitario(), $template);
        $template = str_replace("{{total}}", $this->getPrecoTotal(), $template);

        return $template;

    }

    public static function getAll() 
    {
        // Em uma versão futura vou implementar com banco de dados.
        $produtos = array();
        $produtos[] = new Produto("Pastel de Carne", "Resources/img/pastel-de-carne.jpg", 6.5, "Alimento", 1);
        $produtos[] = new Produto("Pastel de Calabresa", "Resources/img/pastel-de-calabresa.jpg", 6.5, "Alimento",2);
        $produtos[] = new Produto("Pastel de Queijo", "Resources/img/pastel-de-queijo.jpg", 6.5, "Alimento",3);
        $produtos[] = new Produto("Pastel de Pizza", "Resources/img/pastel-de-pizza.jpg", 6.5, "Alimento",4);
        $produtos[] = new Produto("Pastel de Frango", "Resources/img/pastel-de-frango.jpg", 6.5, "Alimento",5);
        $produtos[] = new Produto("Pastel de Chocolate", "Resources/img/pastel-de-chocolate-preto.jpg", 16.5, "Sobremesa",6);
        $produtos[] = new Produto("Coca Cola 2 Litros", "Resources/img/coca-cola-2l.jpg", 9, "Bebida",7);

        return $produtos;
    }

    public static function getById($id) 
    {
        // Isso também...
        $produtos = self::getAll();
        foreach ($produtos as $produto) {
            if ($produto->getId() == $id) {
                return $produto;
            }
        }

        return [];
    }

    public function getPrecoTotal() 
    {
        return $this->quantidade * $this->precoUnitario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(mixed $id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCaminhoImagem()
    {
        return $this->caminhoImagem;
    }

    public function setCaminhoImagem($caminhoImagem)
    {
        $this->caminhoImagem = $caminhoImagem;
    }

    public function getPrecoUnitario()
    {
        return $this->precoUnitario;
    }

    public function setPrecoUnitario($precoUnitario)
    {
        $this->precoUnitario = $precoUnitario;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
}