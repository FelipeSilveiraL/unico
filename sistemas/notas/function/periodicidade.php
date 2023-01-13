<?php
function periodicidade($id){
    switch ($id) {
        case '1':
            return 'AVULSA';
            break;
    
        case '5':
            return 'ANUAL';
            break;
        case '7':
            return 'AVULSA FUNILARIA';
            break;
    
        case '3':
            return 'BIMESTRAL';
            break;
        case '2':
            return 'MENSAL';
            break;
    
        case '4':
            return 'SEMESTRAL';
            break;
        case '6':
            return 'TRIAGEM';
            break;
    }
}
