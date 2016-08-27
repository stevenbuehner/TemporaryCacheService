# TemporaryCacheService
A small Service to temporarily cache data.

It offers the functions:

    /**
     * @param bool $key
     */
    public function hasCache($key;

    /**
     * @param mixed $key
     * @return mixed
     * @throws CacheKeyDoesNotExistException
     */
    public function getCache($key);

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function setCache($key, $value);

    /**
     * Clears the cache of the given key if it does exist
     * @param mixed $key
     */
    public function clearCache($key);