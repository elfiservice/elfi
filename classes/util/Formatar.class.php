<?php

class Formatar {

    public static function formatarDataComHora($dataBD) {
        return date('d/m/Y, H:i', strtotime($dataBD));
    }

    public static function formatarDataSemHora($dataBD) {
        return date('d/m/Y', strtotime($dataBD));
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

    public static function moedaBD($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    /**
     * Faz a diferença em DIAS das duas datas fornecidas <b>(NOTA: sem as HORAS e formato AMERICANO -> xxxx-xx-xx )</b> 
     * @param date $dataInical = Data no Formato US ( xxxx-xx-xx ) inicial a Menor
     * @param date $dataFinal = Data no Formato US ( xxxx-xx-xx ) Final a Maior
     * @return int = Diferença de Dias entre as duas datas
     */
    public static function diffDuasDatas($dataInical, $dataFinal) {
        // Define os valores a serem usados
        $data_inicial = $dataInical;
        $data_final = $dataFinal;
// Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($data_inicial);
        $time_final = strtotime($data_final);
// Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
// Calcula a diferença de dias
        return (int) floor($diferenca / (60 * 60 * 24)); // 225 dias
    }

    /**
     * Resp. Formatar Data do Padrão Brasileiro para o Americano <b>(NOTA: sem as HORAS)</b>
     * @param date $dataFormBr = Data no Formato Brasil(Br) <b>ex.: xx/xx/xxxx</b>
     * @return date = Data no Formato Americano(US) <b>ex.: xxxx-xx-xx</b>
     */
    public static function dataBrToUS($dataFormBr) {
        $data = DateTime::createFromFormat('d/m/Y', $dataFormBr);
        return $data->format('Y-m-d');
    }

}
