<?php
require_once 'autoload.php';


$options = getopt('', array('your_floor::', 'lifts_count::', 'strategy:'));

$yourFloor = new FloorNumber($options['your_floor']);
$liftsQty = new LiftsQty($options['lifts_count']);
$strategyName = new StrategyName($options['strategy']);

$app = new App($liftsQty, $strategyName);
$app->callLift($yourFloor);

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
     * @param LiftsQty $liftsQty
     * @param StrategyName $strategyName
     */
    public function __construct($liftsQty, $strategyName)
    {
        try {
            $this->_manager = new Manager();
            for ($i = 1; $i <= $liftsQty->getQty(); $i++) {
                $rndData = $this->_getRandomData();
                $lift = new Lift($i, $rndData['status'], $rndData['current_floor']);
                $this->_manager->appendLift($lift);
                echo $this->_getLiftDescription($lift);
            }

            $strategy = $this->_getStrategy($strategyName);
            $this->_manager->setStrategy($strategy);
            
        } catch (Exception $e) {
            echo PHP_EOL . $e->getMessage() . PHP_EOL;
            exit;
        }
    }
    
    /**
     * 
     * @param FloorNumber $floor
     */
    public function callLift($floor)
    {
        while (!($lift = $this->_manager->getLift($floor->getNumber()))) {
            $lift = $this->_manager->changeStatusOfRandLift();
            sleep(1);
            echo '------------------' . PHP_EOL;
            echo 'All lifts are busy' . PHP_EOL;
            echo 'Emulate changing status for random lift' . PHP_EOL;
            echo $this->_getLiftDescription($lift);
        }

        /** Lift start moving to floor from which it was called */
        $lift->moveTo($floor->getNumber());
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
     * @param StrategyName $strategyName
     *
     * @return Strategy_Abstract
     * @throws Exception
     */
    protected function _getStrategy($strategyName)
    {
        switch ($strategyName->getName()) {
            case StrategyName::NEAREST:
                $strategy = new Strategy_Nearest();
                break;
            case StrategyName::FREE:
                $strategy = new Strategy_Free();
                break;
            case StrategyName::COMING_OR_FREE_NEAREST:
            default:
                $strategy = new Strategy_ComingOrFreeNearest();
                break;
        }
        return $strategy;
    }
}





