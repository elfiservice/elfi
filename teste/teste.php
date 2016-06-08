<?php
require './../classes/Config.inc.php';

                            $orc = new OrcamentoCtrl();
                            $consulta_ORC          = $orc->buscarOrcamentos("n_orc", "WHERE ano_orc = 2016", "orcamentos");
                           // var_dump($consulta_ORC);
                            var_dump(end($consulta_ORC));
                            $ultimaPos = end($consulta_ORC);
                            echo $ultimaPos['n_orc'];
                        if ($consulta_ORC == false) 
                        {
                            $numero_ORC = "1";
                        } else {
                            //$quant_orc = count($consulta_ORC);
                            
                            $numero_ORC = $ultimaPos['n_orc'] + 1;
                         }
                         
                         echo $numero_ORC;