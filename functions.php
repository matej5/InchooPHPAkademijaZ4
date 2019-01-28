<?php

function getAll($z)
{
    foreach ($z as $rez) {
        echo "Id: \t\t\t", $rez->getId(), "\n";
        echo "Ime: \t\t\t", $rez->getIme(), "\n";
        echo "Prezime: \t\t", $rez->getPrezime(), "\n";
        echo "Datum rodenja: \t\t", $rez->getDatumRodenja()->format('d. m. Y'), "\n";
        echo "Spol: \t\t\t", $rez->getSpol(), "\n";
        echo "Mjesecna primanja: \t", $rez->getMjesecnaPrimanja(), "\n";
        echo "________________________________________________\n\n";
    }
}

function set()
{
    $z = new Zaposlenik();
    $z->setIme(setString('ime'));
    $z->setPrezime(setString('prezime'));
    $z->setDatumRodenja(setDate());
    $z->setSpol(setSpol());
    $z->setMjesecnaPrimanja(setDecimal());
    return $z;
}

function setString($y)
{
    do {
        echo 'Unesite ', $y, ': ';
        $x = readline();
        $x = trim($x);
    } while (!(!preg_match('/[^A-Za-z]+/', $x) && strlen($x) !== 0));
    $x = ucfirst(strtolower($x));
    return $x;
}

function setDate()
{
    do {
        echo 'Unesite datum rodenja: ';
        $d = readline();
        $date = DateTime::createFromFormat("d. m. Y", $d);
        $errors = DateTime::getLastErrors();
    } while ($errors['warning_count'] + $errors['error_count'] > 0);
    return $date;
}

function setSpol()
{
    do {
        echo 'Unesite spol (m/f): ';
        $s = readline();
    } while (!($s === 'm' || $s === 'f'));
    return $s;
}

function setDecimal()
{
    do {
        echo 'Unesite mjesecna primanja: ';
        $p = readline();
    } while (!preg_match('/^(0|[1-9]\d*)(\,\d+)?$/', $p));
    return $p;
}

function changeZaposlenik($id, $z)
{
    foreach ($z as $rez) {
        if($rez->getId() == $id){
            echo "Stare vrijednosti\n";
            echo "Id: \t\t\t", $rez->getId(), "\n";
            echo "Ime: \t\t\t", $rez->getIme(), "\n";
            echo "Prezime: \t\t", $rez->getPrezime(), "\n";
            echo "Datum rodenja: \t\t", $rez->getDatumRodenja()->format('d. m. Y'), "\n";
            echo "Spol: \t\t\t", $rez->getSpol(), "\n";
            echo "Mjesecna primanja: \t", $rez->getMjesecnaPrimanja(), "\n";
            echo "Unos novih\n";
            $rez->setIme(setString('ime'));
            $rez->setPrezime(setString('prezime'));
            $rez->setDatumRodenja(setDate());
            $rez->setSpol(setSpol());
            $rez->setMjesecnaPrimanja(setDecimal());
            return $z;
        }
    }
    echo "Ne postoji taj zaposlenk.";
    return $z;
}

function deleteZaposlenik($id, $z)
{
    $num =count($z);
    for($i =0;$i<$num;$i++){
        if($z[$i]->getId() == $id)
        {
            do {
                echo 'Jeste li sigurni da cete obrisati osobu s id = ', $id, ' (y/n): ';
                $x = readline();
                if ($x === 'y') {
                    unset($z[$i]);
                    return $z;
                } elseif ($x === 'n') {
                    return $z;
                } else {
                    echo "Pogresan unos\n";
                }
            } while (true);
        }
    }
    echo "Ne postoji taj zaposlenk.";
    return $z;
}

function ukupStar($z)
{
    $date = 0;
    foreach ($z as $rez) {
        $date += $rez->getAge();
    }

    $year = ($date / 365);
    $year = floor($year);
    $date = $date - $year * 365;
    $month = ($date / 30);
    $month = floor($month);
    $days = ($date % 30);
    $str = $year . " g. " . $month . " m. " . $days." d.";

    return $str;
}

function proStar($z)
{
    $date = 0;
    foreach ($z as $rez) {
        $date += $rez->getAge();
    }
    $year = ($date / 365);
    $year /= count($z);
    return "Prosjecna starost u godinama(zaokruzeno): ".floor($year);
}

function proPri($z)
{
    $m = 0;
    $f = 0;
    $paymentMale = 0;
    $paymentFemale = 0;
    foreach ($z as $rez) {
        if ($rez->getSpol() === 'm') {
            $paymentMale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja())), 2));
            $m++;
        } elseif ($rez->getSpol() === 'f') {
            $paymentFemale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja())), 2));
            $f++;
        }

    }
    if ($m !== 0) {
        $proM = $paymentMale / $m;
    }else{
        $proM = 0;
    }

    if ($f !== 0) {
        $proF = $paymentFemale / $m;
    }else{
        $proF = 0;
    }

    echo "Prosjecna primanja muskaraca je ", str_replace('.', ',', $proM), "kn\n";
    echo "Prosjecna primanja zena je ", str_replace('.', ',', $proF), "kn\n";
    echo ($proM - $proF > 0) ? "Muskarci zaraduju " . str_replace('.', ',', $proM - $proF) . "kune/na vise kn od zena\n" : "Zene zaraduju " . str_replace('.', ',', $proF - $proM) . "kune/a vise kn od muskaraca\n";
}

function ukuPri($z)
{
    $a = 0;
    $b = 0;
    $c = 0;
    $d = 0;
    foreach ($z as $rez) {
        $g = $rez->getAge()/365;
        if ($g<20) {
            $a += floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja()));
        }elseif($g<30){
            $b += floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja()));
        }elseif ($g<40) {
            $c += floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja()));
        }else{
            $d += floatval(str_replace(',', '.', $rez->getMjesecnaPrimanja()));
        }
    }
    echo "Ukupna primanja osoba do 20 godina: ", str_replace('.', ',', $a),"kn\n";
    echo "Ukupna primanja osoba od 20 do 30 godina: ", str_replace('.', ',', $b),"kn\n";
    echo "Ukupna primanja osoba od 30 do 40 godina: ", str_replace('.', ',', $c),"kn\n";
    echo "Ukupna primanja osoba od 40 pa na dalje godina: ", str_replace('.', ',', $d),"kn\n";
}


//Code for generating n zaposlenici

function zaposleniciGenerator($z)
{
        $z = new Zaposlenik();
        $z->setIme(ucfirst(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5)));
        $z->setPrezime(ucfirst(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5)));
        $z->setDatumRodenja(DateTime::createFromFormat("d. m. Y", rand(1, 28) . '.' . rand(1, 12) . '.' . rand(1956, 2018)));
        $z->setSpol((rand(0, 1) === 1) ? 'm' : 'f');
        $z->setMjesecnaPrimanja(str_replace('.', ',', (floatval(number_format(rand(1000, 100000) / 100, 2)))));


        //$z = new Zaposlenik($ime, $prezime, $datum, $spol, $mjes);
    return $z;
}