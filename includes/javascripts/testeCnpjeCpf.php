<?php
?>
<!-- TESTE do CNPJ e CPF -->

<script type="text/javascript"
	src="http://www.shiguenori.com/jquery/jquery-1.3.1.js"></script>
<script type="text/javascript" src="./js/validacao/jquery.validate.js"></script>

<script> 
function isNUMB(c) 
 { 
 if((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+"."+c.substring(cx+1); 
  } 
 if((parseFloat(c) / c != 1)) 
  { 
  if(parseFloat(c) * c == 0) 
   { 
   return(1); 
   } 
  else 
   { 
   return(0); 
   } 
  } 
 else 
  { 
  return(1); 
  } 
 }
function LIMP(c) 
 { 
 while((cx=c.indexOf("-"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("/"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(","))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("."))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf("("))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(")"))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 while((cx=c.indexOf(" "))!=-1) 
  { 
  c = c.substring(0,cx)+c.substring(cx+1); 
  } 
 return(c); 
 }

function VerifyCNPJ(CNPJ) 
 { 
 CNPJ = LIMP(CNPJ); 
 if(isNUMB(CNPJ) != 1) 
  { 
  return(0); 
  } 
 else 
  { 
  if(CNPJ == 0) 
   { 
   return(0); 
   } 
  else 
   { 
   g=CNPJ.length-2; 
   if(RealTestaCNPJ(CNPJ,g) == 1) 
    { 
    g=CNPJ.length-1; 
    if(RealTestaCNPJ(CNPJ,g) == 1) 
     { 
     return(1); 
     } 
    else 
     { 
     return(0); 
     } 
    } 
   else 
    { 
    return(0); 
    } 
   } 
  } 
 } 
function RealTestaCNPJ(CNPJ,g) 
 { 
 var VerCNPJ=0; 
 var ind=2; 
 var tam; 
 for(f=g;f>0;f--) 
  { 
  VerCNPJ+=parseInt(CNPJ.charAt(f-1))*ind; 
  if(ind>8) 
   { 
   ind=2; 
   } 
  else 
   { 
   ind++; 
   } 
  } 
  VerCNPJ%=11; 
  if(VerCNPJ==0 || VerCNPJ==1) 
   { 
   VerCNPJ=0; 
   } 
  else 
   { 
   VerCNPJ=11-VerCNPJ; 
   } 
 if(VerCNPJ!=parseInt(CNPJ.charAt(g))) 
  { 
  return(0); 
  } 
 else 
  { 
  return(1); 
  } 
 } 
 

  function FormataCGC(Formulario, Campo, TeclaPres) 
  { 
    var tecla = TeclaPres.keyCode; 
    var strCampo; 
    var vr; 
    var tam; 
    var TamanhoMaximo = 14; 
  
    eval("strCampo = document." + Formulario + "." + Campo); 
  
    vr = strCampo.value; 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace("/", ""); 
    vr = vr.replace(",", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace(".", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    vr = vr.replace("-", ""); 
    tam = vr.length;

    if (tam < TamanhoMaximo && tecla != 8) 
    { 
      tam = vr.length + 1; 
    }

    if (tecla == 8) 
    { 
      tam = tam - 1; 
    }

    if (tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105) 
    { 
      if (tam <= 2) 
      { 
        strCampo.value = vr; 
      } 
       if ((tam > 2) && (tam <= 6)) 
       { 
         strCampo.value = vr.substr(0, tam - 2) + "-" + vr.substr(tam - 2, tam); 
       } 
       if ((tam >= 7) && (tam <= 9)) 
       { 
         strCampo.value = vr.substr(0, tam - 6) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 10) && (tam <= 12)) 
       { 
         strCampo.value = vr.substr(0, tam - 9) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 13) && (tam <= 14)) 
       { 
         strCampo.value = vr.substr(0, tam - 12) + "." + vr.substr(tam - 12, 3) + "." + vr.substr(tam - 9, 3) + "/" + vr.substr(tam - 6, 4) + "-" + vr.substr(tam - 2, tam); 
      } 
       if ((tam >= 15) && (tam <= 17)) 
       { 
         strCampo.value = vr.substr(0, tam - 14) + "." + vr.substr(tam - 14, 3) + "." + vr.substr(tam - 11, 3) + "." + vr.substr(tam - 8, 3) + "." + vr.substr(tam - 5, 3) + "-" + vr.substr(tam - 2, tam); 
      } 
    } 
  }

function TESTA() 
 { 
 if(VerifyCNPJ(document.forms[0].cnpj.value) == 1) 
  { 
  exit;
  } 
 else 
  { 
  alert("CNPJ nao e valido!"); 
  
  } 
  
  if(VerifyCNPJ(document.forms[0].cnpj.value) == "")
      {
          exit;
      }else
          {
 document.forms[0].cnpj.focus(); 
 return; 
 }
 } 
</script>
