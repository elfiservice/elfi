<?php

class Formatar {

    public static function formatarDataComHora($dataBD) {
        return date('d/m/Y, H:i', strtotime($dataBD));
    }

    public static function limpaCPF_CNPJ($valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    public static function formatTelCnpjCpf($string, $tipo = "") {
        $string = preg_replace("[^0-9]", "", $string);
        if (!$tipo) {
            switch (strlen($string)) {
                case 10: $tipo = 'fone';
                    break;
                case 8: $tipo = 'cep';
                    break;
                case 11: $tipo = 'cpf';
                    break;
                case 14: $tipo = 'cnpj';
                    break;
            }
        }
        switch ($tipo) {
            case 'fone':
                $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) .
                        '-' . substr($string, 6);
                break;
            case 'cep':
                $string = substr($string, 0, 5) . '-' . substr($string, 5, 3);
                break;
            case 'cpf':
                $string = substr($string, 0, 3) . '.' . substr($string, 3, 3) .
                        '.' . substr($string, 6, 3) . '-' . substr($string, 9, 2);
                break;
            case 'cnpj':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3) . '/' .
                        substr($string, 8, 4) . '-' . substr($string, 12, 2);
                break;
            case 'rg':
                $string = substr($string, 0, 2) . '.' . substr($string, 2, 3) .
                        '.' . substr($string, 5, 3);
                break;
        }
        return $string;
    }

    public static function limita_texto($texto, $limite, $quebra = true) {
        $tamanho = strlen($texto);
        // Verifica se o tamanho do texto é menor ou igual ao limite    
        if ($tamanho <= $limite) {
            $novo_texto = $texto;
            // Se o tamanho do texto for maior que o limite    
        } else {
            // Verifica a opção de quebrar o texto        
            if ($quebra == true) {
                $novo_texto = trim(substr($texto, 0, $limite)) . '...';
                // Se não, corta $texto na última palavra antes do limite        
            } else {
                // Localiza o útlimo espaço antes de $limite            
                $ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
                // Corta o $texto até a posição localizada            
                $novo_texto = trim(substr($texto, 0, $ultimo_espaco)) . '...';
            }
        }
        // Retorna o valor formatado    
        return $novo_texto;
    }

}
