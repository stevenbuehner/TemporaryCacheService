<?php

namespace StevenBuehner\Test\Service;

use StevenBuehner\Ergebnisberechnung\Service\TempCacheService;

class TempCacheServiceTest extends \PHPUnit_Framework_TestCase {

    /** @var  TempCacheService */
    protected $cacheService;

    public function setUp() {
        parent::setUp();
        $this->cacheService = new TempCacheService();
    }

    public function testSetAndGetCacheString() {
        $key1   = 'test1'; // String
        $key2   = 'test2'; // String
        $key3   = 'test3'; // String
        $value1 = 'blub';
        $value2 = array( 'array', 1 );
        $value3 = 20;

        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));

        $set = $this->cacheService->setCache($key1, $value1);
        $this->assertEquals($value1, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);

        $set = $this->cacheService->setCache($key2, $value2);
        $this->assertEquals($value2, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);

        $set = $this->cacheService->setCache($key3, $value3);
        $this->assertEquals($value3, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);
    }


    /**
     * @expectedException StevenBuehner\Ergebnisberechnung\Exceptions\CacheKeyDoesNotExistException
     */
    public function testSetAndGetCacheStringFail() {
        $key = 'test'; // String

        $this->cacheService->getCache($key);
    }

    public function testClearCacheString() {
        $key1   = 'test1'; // String
        $key2   = 'test2'; // String
        $key3   = 'test3'; // String
        $value1 = 'blub';
        $value2 = array( 'array', 1 );
        $value3 = 20;

        $this->cacheService->setCache($key1, $value1);
        $this->cacheService->setCache($key2, $value2);
        $this->cacheService->setCache($key3, $value3);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key1);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key2);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key3);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
    }

    public function testSetAndGetCacheArray() {
        $key1   = array( __FUNCTION__, 'test1' ); // Array-Key
        $key2   = array( __FUNCTION__, 'test2' ); // Array-Key
        $key3   = array( __FUNCTION__, 'test3' ); // Array-Key
        $value1 = 'blub';
        $value2 = array( 'array', 1 );
        $value3 = 20;

        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));

        $set = $this->cacheService->setCache($key1, $value1);
        $this->assertEquals($value1, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);

        $set = $this->cacheService->setCache($key2, $value2);
        $this->assertEquals($value2, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);

        $set = $this->cacheService->setCache($key3, $value3);
        $this->assertEquals($value3, $set);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);
    }


    public function testClearCacheArray() {
        $key1   = array( __FUNCTION__, 'test1' ); // Array-Key
        $key2   = array( __FUNCTION__, 'test2' ); // Array-Key
        $key3   = array( __FUNCTION__, 'test3' ); // Array-Key
        $value1 = 'blub';
        $value2 = array( 'array', 1 );
        $value3 = 20;

        $this->cacheService->setCache($key1, $value1);
        $this->cacheService->setCache($key2, $value2);
        $this->cacheService->setCache($key3, $value3);

        $this->assertTrue($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key1), $value1);
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key1);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertTrue($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key2), $value2);
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key2);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertTrue($this->cacheService->hasCache($key3));
        $this->assertEquals($this->cacheService->getCache($key3), $value3);

        $this->cacheService->clearCache($key3);
        $this->assertFalse($this->cacheService->hasCache($key1));
        $this->assertFalse($this->cacheService->hasCache($key2));
        $this->assertFalse($this->cacheService->hasCache($key3));
    }

    /**
     * @expectedException StevenBuehner\Ergebnisberechnung\Exceptions\CacheKeyDoesNotExistException
     */
    public function testSetAndGetCacheArrayFail() {
        $key1 = array( __FUNCTION__, 'test1' ); // Array-Key

        $this->cacheService->getCache($key1);
    }


}