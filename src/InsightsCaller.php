<?php

namespace PhpInsights;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Promise;
use GuzzleHttp\Exception\TransferException;

class InsightsCaller
{

    public const STRATEGY_MOBILE = 'mobile';

    public const STRATEGY_DESKTOP = 'desktop';

    public const GI_API_ENDPOINT = 'https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=%s&strategy=%s&key=%s&locale=%s&screenshot=%s';

    private bool $captureScreenshot = true;

    private readonly Client $client;

    /**
     * InsightsCaller constructor.
     */
    public function __construct(private readonly string $apiKey, private readonly string $locale = 'en', array $config = [])
    {
        $this->client = new Client($config);

    }

    /**
     *
     * @throws ApiRequestException|InvalidJsonException
     */
    public function __invoke(string $url, string $strategy = self::STRATEGY_MOBILE): InsightsResponse
    {
        return $this->getResponse($url, $strategy);
    }

    /**
     *
     *
     * @throws ApiRequestException
     * @throws InvalidJsonException
     */
    public function getResponse(string $url, string $strategy = 'mobile'): InsightsResponse
    {
        $apiEndpoint = $this->createApiEndpointUrl($url, $strategy);

        try {
            $response = $this->client->request('GET', $apiEndpoint);
        } catch (TransferException|GuzzleException $e) {
            throw new ApiRequestException($e->getMessage());
        }

        return InsightsResponse::fromResponse($response);

    }

    /**
     * @throws ApiRequestException
     * @throws InvalidJsonException
     */
    public function getResponses(array $urls, string $strategy = 'mobile'): InsightsResponse|array
    {
        try {
            $promises = [];

            foreach ($urls as $k => $url) {
                $apiEndpoint = $this->createApiEndpointUrl($url, $strategy);
                $promises[$k] = $this->client->getAsync($apiEndpoint);
            }

            $results = Promise\unwrap($promises);
            $results = Promise\settle($promises)->wait();

            $responses = [];

            foreach ($urls as $k => $url) {
                $response = $results[$k]['value'];
                $responses[$url] = InsightsResponse::fromResponse($response);
            }


        } catch (TransferException $transferException) {
            throw new ApiRequestException($transferException->getMessage());
        }

        return $responses;

    }

    public function isCaptureScreenshot(): bool
    {
        return $this->captureScreenshot;
    }

    public function setCaptureScreenshot(bool $captureScreenshot): void
    {
        $this->captureScreenshot = $captureScreenshot;
    }

    protected function createApiEndpointUrl(string $url, string $strategy = 'mobile'): string
    {
        $screenshot = ($this->isCaptureScreenshot()) ? 'true' : 'false';

        return sprintf(self::GI_API_ENDPOINT, $url, $strategy, $this->apiKey, $this->locale, $screenshot);
    }
}
