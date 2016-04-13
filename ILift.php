<?php
interface ILift
{
    /**
     * 
     * @param int $floor
     */
    public function moveTo($floor);
    
    /**
     * 
     * @param int $status
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
}