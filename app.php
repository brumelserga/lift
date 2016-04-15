<?php
require_once 'autoload.php';


$options = getopt('', array('your_floor::', 'lifts_count::', 'strategy:'));

$app = new App($options);
$app->callLift((int)$options['your_floor']);

/**
 * App
 */
class App {
    
    const FLOORS_COUNT = 30;
    
    /**
     *
     * @var Manager
     */
    protected $_manager;
    
    /**
     * 
     * @param array $options
     */
    public function __construct($options)
    {
        try {
            $this->_validateOptions($options);
            $this->_manager = new Manager();
            for ($i = 1; $i <= $options['lifts_count']; $i++) {
                $rndData = $this->_getRandomData();
                $lift = new Lift($i, $rndData['status'], $rndData['current_floor']);
                $this->_manager->setLift($lift);
                echo $this->_getLiftDescription($lift);
            }
            
            $strategyName = !empty($options['strategy']) ? $options['strategy'] : 'Default';
            $strategy = $this->_getStrategy($strategyName);
            $this->_manager->setStrategy($strategy);
            
        } catch (Exception $e) {
            echo PHP_EOL . $e->getMessage() . PHP_EOL;
            exit;
        }
    }
    
    /**
     * 
     * @param int $floor
     */
    public function callLift($floor)
    {
        while (!($lift = $this->_manager->getLift($floor))) {
            $lift = $this->_manager->changeStatusOfRandLift();
            sleep(1);
            echo '------------------' . PHP_EOL;
            echo 'All lifts are busy' . PHP_EOL;
            echo 'Emulate changing status for random lift' . PHP_EOL;
            echo $this->_getLiftDescription($lift);
        }

        /** Lift start moving to floor from which it was called */
        $lift->moveTo($floor);
    }
    
    /**
     * 
     * @return array
     */
    protected function _getRandomData()
    {
        $statuses = array(Lift::STATUS_FREE, Lift::STATUS_MOVING_UP, Lift::STATUS_MOVING_DOWN);
        $result['status'] = $statuses[array_rand($statuses)];
        $result['current_floor'] = rand(1, self::FLOORS_COUNT);
        return $result;
    }
    
    /**
     * 
     * @param array $options
     * @throws Exception
     */
    protected function _validateOptions(Array $options)
    {
        if (empty($options['lifts_count'])) {
            throw new Exception('Enter number of lifts');
        }
        
        if (!is_numeric($options['lifts_count'])) {
            throw new Exception('Enter  valid number of lifts');
        }
        
        if ($options['lifts_count'] < 1 or $options['lifts_count'] > 10) {
            throw new Exception('Enter  valid number of lifts');
        }
        
        if (!empty($options['strategy            '])) {
            if (!in_array($options['strategy'], array('Default', 'Nearest', 'Free'))) {
                throw new Exception('Enter  valid strategy - Default, Nearest or Free');
            }
        }
        
        if (!is_numeric($options['your_floor'])) {
            throw new Exception('Enter  valid floor');
        }
        
        if ((int)$options['your_floor'] < 0 || (int)$options['your_floor'] > self::FLOORS_COUNT) {
            throw new Exception('Enter  valid floor');
        }
    }
    
    /**
     * 
     * @param ILift $lift
     * @return string
     * @throws Exception
     */
    protected function _getLiftDescription(ILift $lift)
    {
        switch ($lift->getStatus()) {
            case LIFT::STATUS_FREE:
                $status = 'Free';
               break;
            case LIFT::STATUS_MOVING_DOWN:
                $status = 'Moving down';
                break;
            case LIFT::STATUS_MOVING_UP:
                $status = 'Moving up';
                break;
            default:
                throw new Exception('Unknown lift status');
                break;
        }
        
        return sprintf('Lift #%s: status - %s, current floor - %s%s',
            $lift->id, $status, (int)$lift->getCurrentFloor(), PHP_EOL
        );
    }
    
    /**
     * 
     * @param string $strategyStr
     * @return \Strategy_Free
     * @throws Exception
     */
    protected function _getStrategy($strategyStr)
    {
        switch ($strategyStr) {
            case 'Default':
                $strategy = new Strategy_ComingOrFreeNearest();
                break;
            case 'Nearest':
                $strategy = new Strategy_Nearest();
                break;
            case 'Free':
                $strategy = new Strategy_Free();
                break;
            default:
                throw new Exception('Set valid strategy');
                break;            
        }
        return $strategy;
    }
}





