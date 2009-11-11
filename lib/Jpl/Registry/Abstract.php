<?php

abstract class Jpl_Registry_Abstract {
	abstract protected function _get($name);
	abstract protected function _set($name, $value);
}

?>