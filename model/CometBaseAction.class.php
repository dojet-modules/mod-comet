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
    private $run = true;

    final public function execute() {
        $count = 0;
        while ($this->run) {
            $this->tick($count++);
            if (!$this->run) {
                break;
            }
            usleep($this->tickCycle());
        }
    }

    final protected function flush() {
        $this->run = false;
        $this->output();
    }

    protected function setTickPerSecond($tickPerSecond) {
        DAssert::assert($tickPerSecond > 0, 'illegal tick per second, should be number');
        $this->tickPerSecond = $tickPerSecond;
    }

    protected function tickPerSecond() {
        return $this->tickPerSecond;
    }

    protected function tickCycle() {
        return 1000000 / $this->tickPerSecond;
    }

    abstract protected function tick($count);

    abstract protected function output();
}
