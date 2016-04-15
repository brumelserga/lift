<?php

class StrategyName
{
    const COMING_OR_FREE_NEAREST = 'ComingOrFreeNearest';
    const FREE = 'Free';
    const NEAREST = 'Nearest';


    static private $_names = [
        self::COMING_OR_FREE_NEAREST,
        self::FREE,
        self::NEAREST,
    ];


    /** @var string */
    private $_name;


    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->_name = empty($name) ? $this->_getDefaultName() : $name;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }


    /**
     * @param string $name
     *
     * @return bool
     */
    static public function isValid($name)
    {
        return in_array($name, self::$_names);
    }


    private function _getDefaultName()
    {
        return self::COMING_OR_FREE_NEAREST;
    }
}