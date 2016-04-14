<?php
/**
 * Strategy free
 */
class Strategy_Free extends Strategy_Abstract
{
    /**
     * Construct
     */
    public function __construct()
    {
        $this->_checkPoints = array(
            new Strategy_Check_Free(),
        );
    }
}

