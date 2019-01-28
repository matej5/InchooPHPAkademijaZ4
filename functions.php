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
        echo 'Id: ', $rez->getId(), "\n";
        echo 'Ime: ', $rez->getIme(), "\n";
        echo 'Prezime: ', $rez->getPrezime(), "\n";
        echo 'Datum rođenja: ', $rez->getDatumRođenja(), "\n";
        echo 'Spol: ', $rez->getSpol(), "\n";
        echo 'Mjesečna primanja: ', $rez->getMjesečnaPrimanja(), "\n";
    }
}

function set()
{
    $z=new Zaposlenik();
    $z->setId();
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