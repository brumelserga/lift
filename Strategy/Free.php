<?php

class Strategy_Free extends Strategy_Abstract
{
    /**
     * @return ICheck[]
     */
    protected function _getCheckPoints()
    {
        return [
            new Strategy_Check_Free(),
        ];
    }
}

