<?php

namespace Result;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use PhpInsights\Result\InsightsResult;

/**
 * This class tests the getResponseCode method in InsightsResult class.
 * The getResponseCode method returns the http response code.
 */
class InsightsResultTest extends TestCase
{
    private int $responseCodeFixtures = 200;

    private ?InsightsResult $insightsResult;

    protected function setUp(): void
    {
        parent::setUp();
        $this->insightsResult = new InsightsResult($this->responseCodeFixtures);
    }


    #[Test]
    public function getResponseCodeShouldReturnExpectedValue(): void
    {
        $actual = $this->insightsResult->getResponseCode();
        $this->assertEquals($this->responseCodeFixtures, $actual);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->insightsResult);
    }
}
