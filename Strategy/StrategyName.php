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
        $name = empty($name) ? $this->_getDefaultName() : $name;
        $this->_guardName($name);

        $this->_name =$name;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }


    private function _getDefaultName()
    {
        return self::COMING_OR_FREE_NEAREST;
    }


    private function _guardName($name)
    {
        if (!in_array($name, self::$_names))
            throw new InvalidArgumentException("Strategy name is not valid");
    }
}