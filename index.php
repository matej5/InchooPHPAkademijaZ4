<?php

include_once 'Zaposlenik.php';
include_once 'functions.php';

$zaposlenici = [];

//generator for inserting multiple
//for ($i=0;$i<100;$i++){
//    $zaposlenici[$i] = zaposleniciGenerator($zaposlenici);
//}

$x = null;
for (; ;) {
    echo "
          1. Pregled Zaposlenika\n
          2. Unos novog Zaposlenika\n
          3. Promjena podataka postojecem zaposleniku\n
          4. Brisanje Zaposlenika\n
          5. Statistika\n
          e. Exit\n";
    echo 'Z4: ';
    $x = readline();
    switch ($x) {
        case 'e':
            echo "Exiting!\n";
            exit();
        case '1':
            if (count($zaposlenici) === 0) {
                echo "Nema unesenih zaposlenika!\n";
            } else {
                getAll($zaposlenici);
            }
            break;
        case '2':
            if (count($zaposlenici) === 0) {
                $zaposlenici[0] = set();
            } else {
                $zaposlenici[] = set();
            }
            break;
        case '3':
            echo "Unesite id zaposlenika kojeg zelite izmjeniti: ";
            $x = readline();
            changeZaposlenik($x, $zaposlenici);
            break;
        case '4':
            echo "Unesite id zaposlenika kojeg zelite obrisati: ";
            $x = readline();
            $zaposlenici = deleteZaposlenik($x, $zaposlenici);
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
                        echo "Exiting!\n";
                        exit();
                    case '1':
                        if (count($zaposlenici) === 0) {
                            echo "Nema unesenih zaposlenika!\n";
                        } else {
                            echo ukupStar($zaposlenici);
                        }
                        break;
                    case '2':
                        if (count($zaposlenici) === 0) {
                            echo "Nema unesenih zaposlenika!\n";
                        } else {
                            echo proStar($zaposlenici);
                        }
                        break;
                    case '3':
                        if (count($zaposlenici) === 0) {
                            echo "Nema unesenih zaposlenika!\n";
                        } else {
                            ukuPri($zaposlenici);
                        }
                        break;
                    case '4':
                        if (count($zaposlenici) === 0) {
                            echo "Nema unesenih zaposlenika!\n";
                        } else {
                            proPri($zaposlenici);
                        }
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