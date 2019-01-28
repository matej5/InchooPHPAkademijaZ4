<?php

include_once 'Zaposlenik.php';

function getAll($z)
{
    foreach ($z as $rez) {
        echo "Id: \t\t\t", $rez->getId(), "\n";
        echo "Ime: \t\t\t", $rez->getIme(), "\n";
        echo "Prezime: \t\t", $rez->getPrezime(), "\n";
        echo "Datum rodenja: \t\t", $rez->getDatumRođenja()->format('d. m. Y'), "\n";
        echo "Spol: \t\t\t", $rez->getSpol(), "\n";
        echo "Mjesecna primanja: \t", $rez->getMjesečnaPrimanja(), "\n";
    }
}

function set()
{
    $z = new Zaposlenik();
    $z->setIme(setString('ime'));
    $z->setPrezime(setString('prezime'));
    $z->setDatumRođenja(setDate());
    $z->setSpol(setSpol());
    $z->setMjesečnaPrimanja(setDecimal());
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
    echo "Stare vrijednosti\n";
    echo "Id: \t\t\t", $z[$id - 1]->getId(), "\n";
    echo "Ime: \t\t\t", $z[$id - 1]->getIme(), "\n";
    echo "Prezime: \t\t", $z[$id - 1]->getPrezime(), "\n";
    echo "Datum rodenja: \t\t", $z[$id - 1]->getDatumRođenja()->format('d. m. Y'), "\n";
    echo "Spol: \t\t\t", $z[$id - 1]->getSpol(), "\n";
    echo "Mjesecna primanja: \t", $z[$id - 1]->getMjesečnaPrimanja(), "\n";
    echo "Unos novih\n";
    $z[$id - 1]->setIme(setString('ime'));
    $z[$id - 1]->setPrezime(setString('prezime'));
    $z[$id - 1]->setDatumRođenja(setDate());
    $z[$id - 1]->setSpol(setSpol());
    $z[$id - 1]->setMjesečnaPrimanja(setDecimal());
    return $z;
}

function deleteZaposlenik($id, $z)
{
    do {
        echo 'Jeste li sigurni da cete obrisati osobu s id = ', $id, ' (y/n): ';
        $x = readline();
        if ($x === 'y') {
            unset($z[$id - 1]);
            return $z;
        } elseif ($x === 'n') {
            return $z;
        } else {
            echo "Pogresan unos\n";
        }
    } while (true);
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
    $str = $days . ". " . $month . ". " . $year;

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
    return $year;
}

function proPri($z)
{
    $m = 0;
    $f = 0;
    $paymentMale = 0;
    $paymentFemale = 0;
    foreach ($z as $rez) {
        if ($rez->getSpol() === 'm') {
            $paymentMale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMjesečnaPrimanja())), 2));
            $m++;
        } elseif ($rez->getSpol() === 'f') {
            $paymentFemale += floatval(number_format(floatval(str_replace(',', '.', $rez->getMjesečnaPrimanja())), 2));
            $f++;
        }

    }
    $proM = $paymentMale / $m;
    $proF = $paymentFemale / $f;

    echo "Prosjecna primanja muskaraca je ", str_replace('.', ',', $proM), "kn\n";
    echo "Prosjecna primanja zena je ", str_replace('.', ',', $proF), "kn\n";
    echo ($proM - $proF > 0) ? "Muskaeci zaraduju " . str_replace('.', ',', $proM - $proF) . "kune/na vise kn od zena\n" : "Zene zaraduju " . str_replace('.', ',', $proF - $proM) . "kune/na vise kn od muskaraca\n";
}


//Code for generating n zaposlenici

function zaposleniciGenerator($z)
{
        $z = new Zaposlenik();
        $z->setIme(ucfirst(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5)));
        $z->setPrezime(ucfirst(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5)));
        $z->setDatumRođenja(DateTime::createFromFormat("d. m. Y", rand(1, 28) . '.' . rand(1, 12) . '.' . rand(1956, 2018)));
        $z->setSpol((rand(0, 1) === 1) ? 'm' : 'f');
        $z->setMjesečnaPrimanja(floatval(number_format(floatval(str_replace(',', '.', rand(1000, 100000) / 100)), 2)));


        //$z = new Zaposlenik($ime, $prezime, $datum, $spol, $mjes);
    return $z;
}