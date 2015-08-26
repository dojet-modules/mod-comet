<?php
/**
 * Comet技术服务端基类
 *
 * Filename: CometBaseAction.class.php
 *
 * @author liyan
 * @since 2015 8 26
 */
abstract class CometBaseAction extends XBaseAction {

    private $tickPerSecond = 10;
    private $running = true;

    final public function execute() {
        while ($this->running) {
            $this->tick();
            if (!$this->running) {
                break;
            }
            usleep($this->tickCycle());
        }
        $this->output();
    }

    final protected function flush() {
        $this->running = false;
    }

    protected function setTickPerSecond($tickPerSecond) {
        DAssert::assert($tickPerSecond > 0, 'illegal tick per second, should be number');
        $this->tickPerSecond = $tickPerSecond;
    }

    protected function tickCycle() {
        return 1000000 / $this->tickPerSecond;
    }

    abstract protected function tick();

    abstract protected function output();
}
