<?php

class Utils {
    public static function formatarPreco($preco) {

        return number_format($preco, 2, ",", ".");

    }
}