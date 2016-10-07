<?php

class Strategy_Nearest extends Strategy_Abstract
{
    /**
     * @return ICheck[]
     */
    protected function _getCheckPoints()
    {
        return [
            new Strategy_Check_Distancetofloor(),
        ];
    }
}
