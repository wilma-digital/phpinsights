<?php

namespace PhpInsights\Result\Map\FormattedResults;

class UrlBlock extends FormattedBlock
{
    public Header $header;

    /** @var Url[] */
    public array $urls;

    /**
     * @return Url[]
     */
    public function getUrls(): array
    {
        return ($this->urls !== [] && is_array($this->urls))
            ? $this->urls
            : [];
    }
}
