<?php

/**
 * Formatar.class [ utilitario ]
 * Auxilia na Formatação de dados do Sistema
 * @copyright (c) 2016, Armando JR. ELFISERVICE
 */
class Formatar {

    /**
     * Formatar data do Banco de Dados para o Padrão Brasileiro <b>com</b> a HORA e MINUTOS inclusos
     * @param date $dataBD = valor da DATA no formato do Banco de Dados <b>0000-00-00 00:00:00</b>
     * @return date  = retorna valor no formato BR <b>00/00/0000, 00:00</b>
     */
    public static function formatarDataComHora($dataBD) {
        return date('d/m/Y, H:i', strtotime($dataBD));
    }

    /**
     * Formatar data do Banco de Dados para o Padrão Brasileiro <b>SEM</b> a HORA e MINUTOS inclusos
     * @param date $dataBD = valor da DATA no formato do Banco de Dados <b>0000-00-00 00:00:00</b>
     * @return date  = retorna valor no formato BR <b>00/00/0000</b>
     */
    public static function formatarDataSemHora($dataBD) {
        return date('d/m/Y', strtotime($dataBD));
    }

    /**
     * Formatar <b>CPF</b> ou <b>CNPJ</b> para apenas <b>Numeros</b>
     * @param string $valor = valor do CPF ou CNPJ <b>com</b> pontos e traços e/ou barras
     * @return string  =  retorna valor <b>sem</b> pontos, traços e/ou barras, apenas numeros
     */
    public static function limpaCPF_CNPJ($valor) {
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    /**
     * Formatar <b>Tel, CEP, CNPJ ou CPF</b> para ser mostrado em <b>TELA</b>
     * @param string $string = recebe valor com <b>apenas numeros</b> do <b>tipo </b>FONE, CEP, CPF OU CNPJ
     * @param string $tipo = <b>caso queira</b>, informe o <b>tipo</b> que quer Formatar explicitamente ou não preencha
     * @return string = retonar o valor FONE <b>(XX) XXXX-XXXX</b>, CEP <b>XXXXX-XXX</b>, CPF <b>XXX.XXX.XXX-XX</b>, CNPJ <b>XX.XXX.XXX/XXXX-XX</b>
     */
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

    /**
     * Formata o TEXTO <b>limitando</b> na TELA
     * @param string $texto = Recebe o TEXTO completo
     * @param int $limite = <b>Numero</b> de CARACTERES a serem Mostrados na TELA
     * @param boolean $quebra = se TRUE para deixar Quebrar o TEXTO
     * @return string = Texto com a limitação <b>" ... "</b>
     */
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

    /**
     * Formata valor MONETARIO para INSERIR no Banco de Dados
     * @param float $get_valor = recebe valor Formato Brasileiro 
     * @return float = retorna valor no Formato 00000.00 para INSERIR no BD
     */
    public static function moedaBD($get_valor) {
        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    /**
     * Formatar valor do BD para Monetario Brasileiro
     * @param float $valorDoBancoDados = Valor vindo do Banco de Dados no formato <b>00000.00 </b>
     * @return number = formatado ex: 0.000,00
     */
    public static function moedaBR($valorDoBancoDados) {
        return number_format($valorDoBancoDados, '2', ',', '.');
    }

    /**
     * Faz a diferença em DIAS das duas datas fornecidas <b>(NOTA: sem as HORAS e formato AMERICANO -> xxxx-xx-xx )</b> 
     * @param date $dataInical = Data no Formato <b>US ( xxxx-xx-xx ) inicial</b> a Menor
     * @param date $dataFinal = Data no Formato <b>US ( xxxx-xx-xx ) Final</b> a Maior
     * @return int = <b>Numero</b> da Diferença de <b>Dias</b> entre as duas datas
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

    /**
     * Formatar data para formato de <b>Periodo atrás</b>
     * @param date $date = Formato 0000-00-00 00:00:00
     * @return string = retorna data amigavel ex: xxminutos atrás, xx dias atrás, xx meses atras, etc..
     */
    public static function dataTimeLine($date) {
        if ($date == "0000-00-00 00:00:00") {
            return '<span style= "color: red;">Nunca Entrou</span>';
        }

        $periods = array("segundo", "minuto", "hora", "dia", "semana", "mes", "ano", "decada");
        $lengths = array("60", "60", "24", "7", "4.35", "12", "10");

        $now = time();
        $unix_date = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return "erro na data";
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference = $now - $unix_date;
            $tense = "atrás";
        } else {
            $difference = $unix_date - $now;
            $tense = "agora mesmo";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {

            if ($periods[$j] <> "mes") {
                $periods[$j] .= "s";
            } else {

                $periods[$j] .= "es";
            }
        }

        return "$difference $periods[$j] {$tense}";
    }

    /**
     * Formatar data para adicionar <b>Dias</b> ou <b>Mes</b> ou <b>Anos</b> a mesma
     * @param date $date = Formato 0000-00-00 00:00:00, int $number = Formato numeros inteiros, String $type = <b>Dia "d", Mes "m" e Ano "y"</b> 
     * @return string = retorna data adicionando dia ou mes ou anos a ela no formato de <b>0000-00-00</b>
     */
    public static function addToDate($date, $number, $type) {
        switch ($type) {
            case 'd':
                $type = ' day';
                break;
            case 'm':
                $type = ' month';
                break;
            case 'y':
                $type = ' year';
                break;
        }

        return strtotime($date . "+" . $number . $type);
    }

    /**
     * Formatar <b>Email</b> retirando seu prefixo até o "@"
     * @param String $email = String $type = <b>prefixo@sufixo</b> 
     * @return string = retorna o prefixo do email fornecido
     */
    public static function prefixEmail($email) {

        $array = explode("@", $email);
        return $array[0];
    }    
    
    

}
