<?php
/**
 * Strategy default
 */
class Strategy_Default extends Strategy_Abstract
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_checkPoints = array(
            new Strategy_Check_Free(),
            new Strategy_Check_Alreadymovingtofloor(),
            new Strategy_Check_Distancetofloor(),
        );
    }
}

