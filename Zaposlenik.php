<?php
/**
 * Created by PhpStorm.
 * User: Apolon
 * Date: 1/27/2019
 * Time: 6:29 PM
 */

include_once 'singleton.php';

class Zaposlenik
{
    private $id;
    private $ime;
    private $prezime;
    private $datumRodenja;
    private $spol;
    private $mjesecnaPrimanja;

    function __construct()
    {
        $this->id = IdGenerator::getInstance();
    }

    function __construct1($ime, $prezime, $datumRocenja, $spol, $mjesenaPrimanja)
    {
        $this->id = IdGenerator::getInstance();
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datumRodenja = $datumRodenja;
        $this->spol = $spol;
        $this->mjesecnaPrimanja = $mjesecnaPrimanja;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $ime
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
    }

    /**
     * @return mixed
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * @param mixed $prezime
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    }

    /**
     * @return mixed
     */
    public function getPrezime()
    {
        return $this->prezime;
    }

    /**
     * @param mixed $datumRođenja
     */
    public function setDatumRodenja($datumRodenja)
    {
        $this->datumRodenja = $datumRodenja;
    }

    /**
     * @return mixed
     */
    public function getDatumRodenja()
    {
        return $this->datumRodenja;
    }

    /**
     * @return mixed
     */
    public function getSpol()
    {
        return $this->spol;
    }

    /**
     * @param mixed $spol
     */
    public function setSpol($spol)
    {
        $this->spol = $spol;
    }

    /**
     * @return mixed
     */
    public function getMjesecnaPrimanja()
    {
        return $this->mjesecnaPrimanja;
    }

    /**
     * @param mixed $mjesecnaPrimanja
     */
    public function setMjesecnaPrimanja($mjesecnaPrimanja)
    {
        $this->mjesecnaPrimanja = $mjesecnaPrimanja;
    }

    public function getAge()
    {
        $date = $this->datumRodenja;
        $now = new DateTime('NOW');
        $interval = $date->diff($now)->format('%a');
        return intval($interval);
    }
}