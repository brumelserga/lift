<?php
/**
 * Strategy default
 */
class Strategy_Nearest extends Strategy_Abstract
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_checkPoints = array(
            new Strategy_Check_Distancetofloor(),
        );
    }
}



