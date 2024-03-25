<?php

use PhpInsights\InsightsCaller;
use PhpInsights\InvalidJsonException;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
class InsightsCallerTest extends TestCase
{
    #[Test]
    public function testCanConstructed()
    {
        $caller = new InsightsCaller('foo');
        return $this->assertInstanceOf(InsightsCaller::class, $caller);

    }

    /**
     * @throws InvalidJsonException
     */
    #[Test]
    public function testInvalidApiKey(): void
    {
        $this->expectException(\PhpInsights\ApiRequestException::class);
        $caller = new InsightsCaller('foo');
        $caller->
        getResponse('foo');
    }

}
