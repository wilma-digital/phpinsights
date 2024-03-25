<?php

namespace PhpInsights;

use JsonMapper;
use JsonMapper_Exception;
use PhpInsights\Result\InsightsResult;
use Psr\Http\Message\ResponseInterface;
use stdClass;

readonly class InsightsResponse
{

    private stdClass $decodedResponse;

    /**
     * Not callable directly, use InsightsResponse::fromResponse or
     * Insightsresponse::fromJson instead.
     *
     * @throws InvalidJsonException
     */
    private function __construct(private string $rawJsonResponse)
    {
        $this->decodedResponse = static::validateResponse($this->rawJsonResponse);
    }

    /**
     *
     *
     * @throws InvalidJsonException
     */
    public static function validateResponse(string $json): stdClass
    {
        $result = json_decode($json, false);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $result;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        throw new InvalidJsonException($error);
    }

    /**
     * @throws InvalidJsonException
     */
    public static function fromResponse(ResponseInterface $response): InsightsResponse
    {
        return new static($response->getBody()->getContents());
    }

    /**
     * @throws InvalidJsonException
     */
    public static function fromJson(string $json): InsightsResponse
    {
        return new static($json);
    }

    /**
     * @throws JsonMapper_Exception
     */
    public function getMappedResult(): InsightsResult
    {

        $mapper = new JsonMapper();

        /** @var InsightsResult $map */
        $map = $mapper->map($this->decodedResponse, new InsightsResult(null));

        return $map;
    }

    public function getRawResult(): string
    {
        return $this->rawJsonResponse;
    }

}
