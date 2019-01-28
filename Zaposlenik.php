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
    private $datumRođenja;
    private $spol;
    private $mjesečnaPrimanja;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId()
    {
        $this->id = IdGenerator::getInstance();
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
    public function setDatumRođenja($datumRođenja)
    {
        $this->datumRođenja = $datumRođenja;
    }

    /**
     * @return mixed
     */
    public function getDatumRođenja()
    {
        return date_format( $this->datumRođenja,"d. m. Y");
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
    public function getMjesečnaPrimanja()
    {
        return $this->mjesečnaPrimanja;
    }

    /**
     * @param mixed $mjesečnaPrimanja
     */
    public function setMjesečnaPrimanja($mjesečnaPrimanja)
    {
        $this->mjesečnaPrimanja = $mjesečnaPrimanja;
    }
}