<?php



// Definir arrays associativos com os valores e seus respectivos nomes
$valoresENomesSetor = array(
    // CON - ESP - INF - GAB
    '0' => 'Secretaria',
    
    // ADM
    '1' => 'Guarda',
    '2' => 'Tributos',
    '3' => 'Almoxarifado ADM',
    '4' => 'Raio',
    '5' => 'Cotar',

    // ASS
    '6' => 'Secretaria SMPS',
    '7' => 'CRAS Almofala',
    '8' => 'CRAS Gargoe',
    '9' => 'CREAS',
    '10' => 'Casa do Cidadao',
    '11' => 'Conselho Tutelar',
    '12' => 'Casa Lar',

    // EDU
    '13' => 'Secretaria SME',
    '14' => 'NIT',
    '15' => 'Almoxarifado SME',
    '16' => 'Escola',
    
    // SAU
    '17' => 'Secretaria SMS',
    '18' => 'Hospital',
    '19' => 'Atencao Basica',
    '20' => 'MAC',

    // TUR
    '21' => 'Secretaria SEMAT',
    '22' => 'Museu',

);

header('Content-Type: application/json');
echo json_encode($valoresENomesSetor);
