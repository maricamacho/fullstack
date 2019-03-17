<?php

/*
 * Clase para representar a los políticos
 * 
 * Contiene los métodos captadores y definidores para poder acceder a las 
 * propiedades de un objeto político
 * 
 * 
 */

namespace BackendBundle\Document;


class Politician {
    
    //Campos de la colección Politicians
    protected $id;
    protected $TITULAR;
    protected $PARTIDO;
    protected $PARTIDO_PARA_FILTRO;
    protected $GENERO;
    protected $CARGO_PARA_FILTRO;
    protected $CARGO;
    protected $INSTITUCION;
    protected $CCAA;
    protected $SUELDOBASE_SUELDO;
    protected $COMPLEMENTOS_SUELDO;
    protected $PAGASEXTRA_SUELDO;
    protected $OTRASDIETASEINDEMNIZACIONES_SUELDO;
    protected $RETRIBUCIONMENSUAL;
    protected $RETRIBUCIONANUAL;
    protected $OBSERVACIONES;
    protected $TRIENIOS_SUELDO;




    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tITULAR
     *
     * @param string $tITULAR
     * @return $this
     */
    public function setTITULAR($tITULAR)
    {
        $this->TITULAR = $tITULAR;
        return $this;
    }

    /**
     * Get tITULAR
     *
     * @return string $tITULAR
     */
    public function getTITULAR()
    {
        return $this->TITULAR;
    }

    /**
     * Set pARTIDO
     *
     * @param string $pARTIDO
     * @return $this
     */
    public function setPARTIDO($pARTIDO)
    {
        $this->PARTIDO = $pARTIDO;
        return $this;
    }

    /**
     * Get pARTIDO
     *
     * @return string $pARTIDO
     */
    public function getPARTIDO()
    {
        return $this->PARTIDO;
    }

    /**
     * Set pARTIDOPARAFILTRO
     *
     * @param string $pARTIDOPARAFILTRO
     * @return $this
     */
    public function setPARTIDOPARAFILTRO($pARTIDOPARAFILTRO)
    {
        $this->PARTIDO_PARA_FILTRO = $pARTIDOPARAFILTRO;
        return $this;
    }

    /**
     * Get PARTIDO_PARA_FILTRO
     *
     * @return string $PARTIDO_PARA_FILTRO
     */
    public function getPARTIDO_PARA_FILTRO()
    {
        return $this->PARTIDO_PARA_FILTRO;
    }

    /**
     * Set gENERO
     *
     * @param string $gENERO
     * @return $this
     */
    public function setGENERO($gENERO)
    {
        $this->GENERO = $gENERO;
        return $this;
    }

    /**
     * Get gENERO
     *
     * @return string $gENERO
     */
    public function getGENERO()
    {
        return $this->GENERO;
    }

    /**
     * Set cARGOPARAFILTRO
     *
     * @param string $cARGOPARAFILTRO
     * @return $this
     */
    public function setCARGOPARAFILTRO($cARGOPARAFILTRO)
    {
        $this->CARGO_PARA_FILTRO = $cARGOPARAFILTRO;
        return $this;
    }

    /**
     * Get CARGO_PARA_FILTRO
     *
     * @return string $CARGO_PARA_FILTRO
     */
    public function getCARGO_PARA_FILTRO()
    {
        return $this->CARGO_PARA_FILTRO;
    }

    /**
     * Set cARGO
     *
     * @param string $cARGO
     * @return $this
     */
    public function setCARGO($cARGO)
    {
        $this->CARGO = $cARGO;
        return $this;
    }

    /**
     * Get cARGO
     *
     * @return string $cARGO
     */
    public function getCARGO()
    {
        return $this->CARGO;
    }

    /**
     * Set iNSTITUCION
     *
     * @param string $iNSTITUCION
     * @return $this
     */
    public function setINSTITUCION($iNSTITUCION)
    {
        $this->INSTITUCION = $iNSTITUCION;
        return $this;
    }

    /**
     * Get iNSTITUCION
     *
     * @return string $iNSTITUCION
     */
    public function getINSTITUCION()
    {
        return $this->INSTITUCION;
    }

    /**
     * Set cCAA
     *
     * @param string $cCAA
     * @return $this
     */
    public function setCCAA($cCAA)
    {
        $this->CCAA = $cCAA;
        return $this;
    }

    /**
     * Get cCAA
     *
     * @return string $cCAA
     */
    public function getCCAA()
    {
        return $this->CCAA;
    }

    /**
     * Set sUELDOBASESUELDO
     *
     * @param float $sUELDOBASESUELDO
     * @return $this
     */
    public function setSUELDOBASESUELDO($sUELDOBASESUELDO)
    {
        $this->SUELDOBASE_SUELDO = $sUELDOBASESUELDO;
        return $this;
    }

    /**
     * Get SUELDOBASE_SUELDO
     *
     * @return float $SUELDOBASE_SUELDO
     */
    public function getSUELDOBASE_SUELDO()
    {
        return $this->SUELDOBASE_SUELDO;
    }

    /**
     * Set cOMPLEMENTOSSUELDO
     *
     * @param float $cOMPLEMENTOSSUELDO
     * @return $this
     */
    public function setCOMPLEMENTOSSUELDO($cOMPLEMENTOSSUELDO)
    {
        $this->COMPLEMENTOS_SUELDO = $cOMPLEMENTOSSUELDO;
        return $this;
    }

    /**
     * Get COMPLEMENTOS_SUELDO
     *
     * @return float $COMPLEMENTOS_SUELDO
     */
    public function getCOMPLEMENTOS_SUELDO()
    {
        return $this->COMPLEMENTOS_SUELDO;
    }

    /**
     * Set pAGASEXTRASUELDO
     *
     * @param float $pAGASEXTRASUELDO
     * @return $this
     */
    public function setPAGASEXTRASUELDO($pAGASEXTRASUELDO)
    {
        $this->PAGASEXTRA_SUELDO = $pAGASEXTRASUELDO;
        return $this;
    }

    /**
     * Get PAGASEXTRA_SUELDO
     *
     * @return float $PAGASEXTRA_SUELDO
     */
    public function getPAGASEXTRA_SUELDO()
    {
        return $this->PAGASEXTRA_SUELDO;
    }

    /**
     * Set oTRASDIETASEINDEMNIZACIONESSUELDO
     *
     * @param float $oTRASDIETASEINDEMNIZACIONESSUELDO
     * @return $this
     */
    public function setOTRASDIETASEINDEMNIZACIONESSUELDO($oTRASDIETASEINDEMNIZACIONESSUELDO)
    {
        $this->OTRASDIETASEINDEMNIZACIONES_SUELDO = $oTRASDIETASEINDEMNIZACIONESSUELDO;
        return $this;
    }

    /**
     * Get OTRASDIETASEINDEMNIZACIONES_SUELDO
     *
     * @return float $OTRASDIETASEINDEMNIZACIONES_SUELDO
     */
    public function getOTRASDIETASEINDEMNIZACIONES_SUELDO()
    {
        return $this->OTRASDIETASEINDEMNIZACIONES_SUELDO;
    }

    /**
     * Set tRIENIOSSUELDO
     *
     * @param float $tRIENIOSSUELDO
     * @return $this
     */
    public function setTRIENIOSSUELDO($tRIENIOSSUELDO)
    {
        $this->TRIENIOS_SUELDO = $tRIENIOSSUELDO;
        return $this;
    }

    /**
     * Get TRIENIOS_SUELDO
     *
     * @return float $TRIENIOS_SUELDO
     */
    public function getTRIENIOS_SUELDO()
    {
        return $this->TRIENIOS_SUELDO;
    }

    /**
     * Set rETRIBUCIONMENSUAL
     *
     * @param float $rETRIBUCIONMENSUAL
     * @return $this
     */
    public function setRETRIBUCIONMENSUAL($rETRIBUCIONMENSUAL)
    {
        $this->RETRIBUCIONMENSUAL = $rETRIBUCIONMENSUAL;
        return $this;
    }

    /**
     * Get rETRIBUCIONMENSUAL
     *
     * @return float $rETRIBUCIONMENSUAL
     */
    public function getRETRIBUCIONMENSUAL()
    {
        return $this->RETRIBUCIONMENSUAL;
    }

    /**
     * Set rETRIBUCIONANUAL
     *
     * @param float $rETRIBUCIONANUAL
     * @return $this
     */
    public function setRETRIBUCIONANUAL($rETRIBUCIONANUAL)
    {
        $this->RETRIBUCIONANUAL = $rETRIBUCIONANUAL;
        return $this;
    }

    /**
     * Get rETRIBUCIONANUAL
     *
     * @return float $rETRIBUCIONANUAL
     */
    public function getRETRIBUCIONANUAL()
    {
        return $this->RETRIBUCIONANUAL;
    }

    /**
     * Set oBSERVACIONES
     *
     * @param string $oBSERVACIONES
     * @return $this
     */
    public function setOBSERVACIONES($oBSERVACIONES)
    {
        $this->OBSERVACIONES = $oBSERVACIONES;
        return $this;
    }

    /**
     * Get oBSERVACIONES
     *
     * @return string $oBSERVACIONES
     */
    public function getOBSERVACIONES()
    {
        return $this->OBSERVACIONES;
    }
 
}
