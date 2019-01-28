<?php

include_once 'Zaposlenik.php';


function ex()
{
    echo "Exiting!\n";
    exit();
}

function getAll($z)
{
    foreach ($z as $rez)
    {
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
    $z=new Zaposlenik();
    $z->setId();
//    $z->setIme(setString('ime'));
//    $z->setPrezime(setString('prezime'));
    $z->setDatumRođenja(setDate());
//    $z->setSpol(setSpol());
//    $z->setMjesečnaPrimanja(setDecimal());
    return $z;
}

function setString($y)
{
    do {
        echo 'Unesite ', $y,': ';
        $x = readline();
        $x = trim($x);
    }while (!(!preg_match('/[^A-Za-z]+/', $x) && strlen($x) !== 0));
    $x = ucfirst(strtolower($x));
    return $x;
}

function setDate()
{
    do{
        echo 'Unesite datum rodenja: ';
        $d = readline();

        $date = DateTime::createFromFormat("d. m. Y", $d);
        $errors = DateTime::getLastErrors();
    }while($errors['warning_count'] + $errors['error_count'] > 0);
    return $date;
}

function setSpol()
{
    do{
        echo 'Unesite spol (m/f): ';
        $s = readline();
    }while(!($s === 'm' || $s === 'f'));
    return $s;
}

function setDecimal()
{
    do{
        echo 'Unesite mjesecna primanja: ';
        $p = readline();
    }while(!preg_match('/^(0|[1-9]\d*)(\,\d+)?$/', $p));
    return $p;
}

function proPri($z)
{
    $count = count($z);
    $payment = 0;
    foreach ($z as $rez){
        $payment += floatval(number_format(floatval(str_replace(',','.', $rez->getMjesečnaPrimanja())),2));
    }
    $pro = $payment/$count;

    return str_replace('.',',', $pro);
}

function changeZaposlenik($id, $z)
{
    echo "Stare vrijednosti\n";
    echo "Id: \t\t\t", $z[$id-1]->getId(), "\n";
    echo "Ime: \t\t\t", $z[$id-1]->getIme(), "\n";
    echo "Prezime: \t\t", $z[$id-1]->getPrezime(), "\n";
    echo "Datum rodenja: \t\t", $z[$id-1]->getDatumRođenja()->format('d. m. Y'), "\n";
    echo "Spol: \t\t\t", $z[$id-1]->getSpol(), "\n";
    echo "Mjesecna primanja: \t", $z[$id-1]->getMjesečnaPrimanja(), "\n";
    echo "Unos novih\n";
    $z[$id-1]->setIme(setString('ime'));
    $z[$id-1]->setPrezime(setString('prezime'));
    $z[$id-1]->setDatumRođenja(setDate());
    $z[$id-1]->setSpol(setSpol());
    $z[$id-1]->setMjesečnaPrimanja(setDecimal());
    return $z;
}

function deleteZaposlenik($id, $z)
{
    unset($z[$id-1]);
    return $z;
}

function ukupStar($z)
{
    $date = 0;
    foreach ($z as $rez){
        $date += $rez->getAge();
    }

    $year = ($date / 365);
    $year = floor($year);
    $date = $date -$year*365;
    $month = ($date / 30) ;
    $month = floor($month);
    $days = ($date % 30);
    $str = $days.". ".$month.". ".$year;

    return $str;
}