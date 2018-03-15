<?php

/**
 * PDF [ UTIL ]
 * Gerar PDFs Papel timbrado da Empresa ELFI
 * @copyright (c) 2018, Armando JR. ELFISERVICE
 * by biblioteca fpdf 
 */

class PDF extends FPDF
{
    private $textoRodaPe;
    
    function __construct($textoRodaPe, $orientation = 'P', $unit = 'mm', $size = 'A4') {
        parent::__construct($orientation, $unit, $size);
        $this->textoRodaPe = $textoRodaPe;
        
    }
    
    function setRodapeTexto($rodape) {
        $this->textoRodaPe = $rodape;
    }
    
// Page header
    function Header()
    {
        // Logo
        $this->Image('../../../imagens/logo_elfi.jpg',10,12,30);
        // Arial bold 15
        $this->SetFont('Arial','',10);
        // Move to the right
        $this->Cell(40);
        // Title
        $this->MultiCell(0,4, utf8_decode('Montagens e Manutenções de: Subestações, Transformadores, Grupo Geradores, Disjuntores Banco de Capacitores Fixo e Automático, Quadros de Comando, Força e Luz, S.P.D.A., Tratamento de Óleo Isolante pelo processo Termo-Vácuo, Comissionamento de Subestação, Termografia. Desde 1993 trazendo soluções para sua empresa.'),0,'L');
        $this->Ln(8);
    }

    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',8);

        $this->MultiCell(190, 4, utf8_decode($this->textoRodaPe),0,'C');
        // Page number
        $this->Cell(0,5,'Pg '.$this->PageNo().'/{nb}',0,0,'R');
    }

    function divisorHeader($texto) {
        $this->Ln(2);
        $this->SetFont('Arial','B',10);
        $this->Cell(0,6,$texto,1,1,'C');
        $this->SetFont('Arial','',9);
        $this->Ln(2);
    }
}