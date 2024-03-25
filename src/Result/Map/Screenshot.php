<?php

namespace PhpInsights\Result\Map;

class Screenshot
{

    public string $mime_type;

    public string $data;

    public int $width;

    public int $height;

    // TODO set "page_rect"
    public function getData(): string
    {
        // https://developers.google.com/speed/docs/insights/v2/reference/pagespeedapi/runpagespeed#screenshot.data
        return strtr($this->data, [
            '-' => '+',
            '_' => '/',
        ]);
    }

    public function getMimeType(): string
    {
        return $this->mime_type;
    }

    public function getImageHtml(string $alt = ''): string
    {
        return sprintf('<img src="data:%s;base64,%s" alt="%s">', $this->getMimeType(), $this->getData(), $alt);
    }
}
