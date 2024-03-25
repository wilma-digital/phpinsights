<?php

namespace PhpInsights\Result\Map;

class PageStats
{
    private int $numberResources;

    private int $numberHosts;

    private int $totalRequestBytes;

    private int $numberStaticResources;

    private int $htmlResponseBytes;

    private int $cssResponseBytes;

    private int $imageResponseBytes;

    private int $javascriptResponseBytes;

    private int $otherResponseBytes;

    private int $numberJsResources;

    private int $numberCssResources;

    public function getNumberResources(): int
    {
        return $this->numberResources;
    }

    public function setNumberResources(int $numberResources): void
    {
        $this->numberResources = $numberResources;
    }

    public function getNumberHosts(): int
    {
        return $this->numberHosts;
    }

    public function setNumberHosts(int $numberHosts): void
    {
        $this->numberHosts = $numberHosts;
    }

    public function getTotalRequestBytes(): int
    {
        return $this->totalRequestBytes;
    }

    public function setTotalRequestBytes(int $totalRequestBytes): void
    {
        $this->totalRequestBytes = $totalRequestBytes;
    }

    public function getNumberStaticResources(): int
    {
        return $this->numberStaticResources;
    }

    public function setNumberStaticResources(int $numberStaticResources): void
    {
        $this->numberStaticResources = $numberStaticResources;
    }

    public function getHtmlResponseBytes(): int
    {
        return $this->htmlResponseBytes;
    }

    public function setHtmlResponseBytes(int $htmlResponseBytes): void
    {
        $this->htmlResponseBytes = $htmlResponseBytes;
    }

    public function getCssResponseBytes(): int
    {
        return $this->cssResponseBytes;
    }

    public function setCssResponseBytes(int $cssResponseBytes): void
    {
        $this->cssResponseBytes = $cssResponseBytes;
    }

    public function getImageResponseBytes(): int
    {
        return $this->imageResponseBytes;
    }

    public function setImageResponseBytes(int $imageResponseBytes): void
    {
        $this->imageResponseBytes = $imageResponseBytes;
    }

    public function getJavascriptResponseBytes(): int
    {
        return $this->javascriptResponseBytes;
    }

    public function setJavascriptResponseBytes(int $javascriptResponseBytes): void
    {
        $this->javascriptResponseBytes = $javascriptResponseBytes;
    }

    public function getOtherResponseBytes(): int
    {
        return $this->otherResponseBytes;
    }

    public function setOtherResponseBytes(int $otherResponseBytes): void
    {
        $this->otherResponseBytes = $otherResponseBytes;
    }

    public function getNumberJsResources(): int
    {
        return $this->numberJsResources;
    }

    public function setNumberJsResources(int $numberJsResources): void
    {
        $this->numberJsResources = $numberJsResources;
    }

    public function getNumberCssResources(): int
    {
        return $this->numberCssResources;
    }

    public function setNumberCssResources(int $numberCssResources): void
    {
        $this->numberCssResources = $numberCssResources;
    }
}
