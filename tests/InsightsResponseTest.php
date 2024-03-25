<?php

use PhpInsights\InsightsResponse;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PhpInsights\InvalidJsonException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class InsightsResponseTest extends TestCase
{
    /**
     * @var MockObject|ResponseInterface
     */
    private MockObject|ResponseInterface $responseMock;

    /**
     * @var MockObject|StreamInterface
     */
    private MockObject|StreamInterface $streamMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->responseMock = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $this->streamMock = $this->getMockBuilder(StreamInterface::class)->getMock();
    }

    /**
     * Test `fromResponse` method of `InsightsResponse` class.
     * It should return an instance of `InsightsResponse` class.
     */
    #[Test]
    public function testFromResponse(): void
    {
        $json = '{"foo": "bar"}';

        $this->streamMock
            ->method('getContents')
            ->willReturn($json);

        $this->responseMock
            ->method('getBody')
            ->willReturn($this->streamMock);

        $insightsResponse = InsightsResponse::fromResponse($this->responseMock);

        $this->assertInstanceOf(InsightsResponse::class, $insightsResponse);
    }

    /**
     * Test `fromResponse` method of `InsightsResponse` class when JSON is invalid.
     * It should throw an InvalidJsonException.
     *
     * @throws InvalidJsonException
     */
    #[Test]
    public function testInvalidJsonFromResponse(): void
    {
        $this->expectException(InvalidJsonException::class);

        $invalidJson = "{foo: bar}";

        $this->streamMock
            ->method('getContents')
            ->willReturn($invalidJson);

        $this->responseMock
            ->method('getBody')
            ->willReturn($this->streamMock);

        InsightsResponse::fromResponse($this->responseMock);
    }
}
