<?php

namespace CompeticionBundle\Entity;

/**
 * ParticipantesRondas
 */
class PartiRonda
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $inscrito;

    /**
     * @var string
     */
    private $pagado;

    /**
     * @var integer
     */
    private $puntos;

    /**
     * @var integer
     */
    private $onces;

    /**
     * @var integer
     */
    private $dieces;

    /**
     * @var integer
     */
    private $presentado;

    /**
     * @var \CompeticionBundle\Entity\Ronda
     */
    private $ronda;

    /**
     * @var \CompeticionBundle\Entity\Participante
     */
    private $participante;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set inscrito
     *
     * @param string $inscrito
     *
     * @return PartiRonda
     */
    public function setInscrito($inscrito)
    {
        $this->inscrito = $inscrito;

        return $this;
    }

    /**
     * Get inscrito
     *
     * @return string
     */
    public function getInscrito()
    {
        return $this->inscrito;
    }

    /**
     * Set pagado
     *
     * @param string $pagado
     *
     * @return PartiRonda
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get pagado
     *
     * @return string
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set puntos
     *
     * @param integer $puntos
     *
     * @return ParticipantesRondas
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return integer
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set onces
     *
     * @param integer $onces
     *
     * @return ParticipantesRondas
     */
    public function setOnces($onces)
    {
        $this->onces = $onces;

        return $this;
    }

    /**
     * Get onces
     *
     * @return integer
     */
    public function getOnces()
    {
        return $this->onces;
    }

    /**
     * Set dieces
     *
     * @param integer $dieces
     *
     * @return ParticipantesRondas
     */
    public function setDieces($dieces)
    {
        $this->dieces = $dieces;

        return $this;
    }

    /**
     * Get dieces
     *
     * @return integer
     */
    public function getDieces()
    {
        return $this->dieces;
    }

    /**
     * Set presentado
     *
     * @param integer $presentado
     *
     * @return ParticipantesRondas
     */
    public function setPresentado($presentado)
    {
        $this->presentado = $presentado;

        return $this;
    }

    /**
     * Get presentado
     *
     * @return integer
     */
    public function getPresentado()
    {
        return $this->presentado;
    }

    /**
     * Set ronda
     *
     * @param \CompeticionBundle\Entity\Rondas $ronda
     *
     * @return PartiRonda
     */
    public function setRonda(\CompeticionBundle\Entity\Ronda $ronda = null)
    {
        $this->ronda = $ronda;

        return $this;
    }

    /**
     * Get ronda
     *
     * @return \CompeticionBundle\Entity\Ronda
     */
    public function getRonda()
    {
        return $this->ronda;
    }

    /**
     * Set participante
     *
     * @param \CompeticionBundle\Entity\Participantes $participante
     *
     * @return PartiRonda
     */
    public function setParticipante(\CompeticionBundle\Entity\Participante $participante = null)
    {
        $this->participante = $participante;

        return $this;
    }

    /**
     * Get participante
     *
     * @return \CompeticionBundle\Entity\Participante
     */
    public function getParticipante()
    {
        return $this->participante;
    }
}

