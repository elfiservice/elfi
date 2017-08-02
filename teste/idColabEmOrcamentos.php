<?php

require './../classes/Config.inc.php';

$orcCtrl = new OrcamentoCtrl();
$orc = $orcCtrl->buscarOrcamentos(" id, colaborador_orc", "");


$colabCtrl = new UsuarioCtrl();
$colaboradores = $colabCtrl->buscarBD("*", "");

foreach ($colaboradores as $linha){

   
   echo $linha->getLogin()."<br>";

    $count = 0;
    $countCheck = 0;
    foreach ($orc as $linhaORC){
        //var_dump($linhaORC);

       // echo $linhaORC['colaborador_orc'];
        
        if($linha->getLogin() == $linhaORC['colaborador_orc'] ){
          //  echo "- ".$linhaORC['razao_social_contr']."<br>";
            $count++;
            $orcmento = new Orcamento($linhaORC['id'], "" , $linha->getId(), "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
            
//$orcCtrl = new OrcamentoCtrl();
            $orcAtualizado = $orcCtrl->atualizarOrcamento($orcmento);
                       // var_dump($orcAtualizado);
           // exit;
            if($orcAtualizado[0]){
                $countCheck++;
            }
            echo "{$linha->getLogin() } ID {$linha->getId()} =  ORC {$linhaORC['colaborador_orc']} ID {$linhaORC['id']} -> tem {$count} orcamentos e foram Atualizados {$countCheck} <br>";
        }
       
    }
     
     //var_dump($linhaORC);

    
}