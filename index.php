<?php

include_once 'Zaposlenik.php';
include_once 'functions.php';

$first = true;
$zaposlenici[] = array();
$x;
for (; ;) {
    echo "
          1. Pregled Zaposlenika\n
          2. Unos novog Zaposlenika\n
          3. Promjena podataka postojecem zaposleniku\n
          4. Brisanje Zaposlenika\n
          5. Statistika\n";
    echo 'Z4: ';
    $x = readline();
    switch ($x) {
        case 'e':
            ex();
        case '1':
            getAll($zaposlenici);
            break;
        case '2':
            if (empty($zaposlenici[0])){
                $zaposlenici[0] = set();
            }else{
                $zaposlenici[] = set();
            }
            break;
        case '3':
            print_r($zaposlenici);
            break;
        case '4':

            break;
        case '5':
            for (; $x != 'b';) {
                echo "
          1. Ukupna starost\n
          2. Prosjecna starost\n
          3. Ukupna primanja\n
          4. Prosjecna primanja\n
          b. Back\n";
                echo 'Z4: ';
                $x = readline();
                switch ($x) {
                    case 'e':
                        ex();
                    case '1':

                        break;
                    case '2':

                        break;
                    case '3':

                        break;
                    case '4':
                        echo proPri($zaposlenici);
                        break;
                    case 'b':
                        echo "Going Back!";
                        break;
                    default:
                        echo "Not valid input!";
                }
            }

            break;
        default:
            echo "Not valid input!";
    }
}