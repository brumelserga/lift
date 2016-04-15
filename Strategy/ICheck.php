<?php

interface ICheck
{
    /**
     * @param ILift $lift
     * @param int $floor
     *
     * @return int
     */
    public function getPoints(ILift $lift, $floor);
}