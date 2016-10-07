<?php

class Strategy_ComingOrFreeNearest
    extends Strategy_Abstract
{
    /**
     * @return ICheck[]
     */
    protected function _getCheckPoints()
    {
        return [
            new Strategy_Check_Free(),
            new Strategy_Check_Alreadymovingtofloor(),
            new Strategy_Check_Distancetofloor(),
        ];
    }
}
