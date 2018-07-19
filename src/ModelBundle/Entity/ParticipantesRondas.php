<?php

namespace ModelBundle\Entity;

/**
 * ParticipantesRondas
 */
class ParticipantesRondas
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
     * @var \ModelBundle\Entity\Rondas
     */
    private $ronda;

    /**
     * @var \ModelBundle\Entity\Participantes
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
     * @return ParticipantesRondas
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
     * @return ParticipantesRondas
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
     * @param \ModelBundle\Entity\Rondas $ronda
     *
     * @return ParticipantesRondas
     */
    public function setRonda(\ModelBundle\Entity\Rondas $ronda = null)
    {
        $this->ronda = $ronda;

        return $this;
    }

    /**
     * Get ronda
     *
     * @return \ModelBundle\Entity\Rondas
     */
    public function getRonda()
    {
        return $this->ronda;
    }

    /**
     * Set participante
     *
     * @param \ModelBundle\Entity\Participantes $participante
     *
     * @return ParticipantesRondas
     */
    public function setParticipante(\ModelBundle\Entity\Participantes $participante = null)
    {
        $this->participante = $participante;

        return $this;
    }

    /**
     * Get participante
     *
     * @return \ModelBundle\Entity\Participantes
     */
    public function getParticipante()
    {
        return $this->participante;
    }
}

