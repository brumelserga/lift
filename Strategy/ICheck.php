<?php

interface ICheck
{
    /**
     * @param ILift $lift
     * @param FloorNumber $floor
     *
     * @return int
     */
    public function getPoints(ILift $lift, $floor);
}