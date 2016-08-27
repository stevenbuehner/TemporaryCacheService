<?php
/*******************************************************************************
 * Copyright (c) 2016. by Steven Bühner
 ******************************************************************************/

namespace StevenBuehner\Ergebnisberechnung\Service;

use StevenBuehner\Ergebnisberechnung\Exceptions\CacheKeyDoesNotExistException;

class TempCacheService {

    protected $confCache;

    public function __construct() {
    }

    /**
     * @param bool $key
     */
    public function hasCache($key) {
        return $this->_hasCache($this->makeHash($key));
    }

    /**
     * @param mixed $key RealKey
     * @return bool
     */
    protected function _hasCache($key) {
        return isset($this->confCache[$key]);
    }

    protected function makeHash($mixed) {
        return md5(serialize($mixed));
    }

    /**
     * @param mixed $key
     * @return mixed
     * @throws CacheKeyDoesNotExistException
     */
    public function getCache($key) {
        $key = $this->makeHash($key);

        if ($this->_hasCache($key))
            return $this->confCache[$key];

        throw new CacheKeyDoesNotExistException();
    }

    /**
     * Clears the cache of the given key if it does exist
     * @param mixed $key
     */
    public function clearCache($key) {
        $key = $this->makeHash($key);

        if ($this->_hasCache($key)) {
            unset($this->confCache[$key]);
        }
    }

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function setCache($key, $value) {
        $key                   = $this->makeHash($key);
        $this->confCache[$key] = $value;
    }


}