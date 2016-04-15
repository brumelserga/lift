<?php
interface ILift
{
    /**
     * @return int
     */
    public function getId();

    /**
     * 
     * @return FloorNumber
     */
    public function getCurrentFloor();
    
    /**
     * 
     * @param LiftStatus $status
     */
    public function setStatus($status);
    
    /**
     * @return bool
     */
    public function isFree();
    
    /**
     * @return bool
     */
    public function isMovingDown();
    
    /**
     * @return bool
     */
    public function isMovingUp();


    /**
     * @param FloorNumber $floor
     */
    public function moveTo($floor);

    /**
     * @return LiftStatus
     */
    public function getStatus();
}