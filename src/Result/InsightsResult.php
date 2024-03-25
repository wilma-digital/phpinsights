<?php

namespace PhpInsights\Result;

use PhpInsights\Result\Map\FormattedResults;
use PhpInsights\Result\Map\PageStats;
use PhpInsights\Result\Map\RuleGroup;
use PhpInsights\Result\Map\Screenshot;
use stdClass;

class InsightsResult
{

    private string $kind;

    private string $id;

    public string $title;

    /** @var RuleGroup[] */
    public array $ruleGroups;

    public PageStats $pageStats;

    public FormattedResults $formattedResults;

    public stdClass $version;

    public Screenshot $screenshot;

    public function __construct(public ?int $responseCode)
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): void
    {
        $this->kind = $kind;
    }

    public function getResponseCode(): int
    {
        return $this->responseCode;
    }

    public function setResponseCode(int $responseCode): void
    {
        $this->responseCode = $responseCode;
    }

    public function setFormattedResults(FormattedResults $formattedResults): void
    {
        $this->formattedResults = $formattedResults;
    }

    /**
     * @return Map\RuleGroup[]
     */
    public function getRuleGroups(): array
    {
        return [];
    }

    public function getPageStats(): PageStats
    {
        return $this->pageStats;
    }

    public function getFormattedResults(): FormattedResults
    {
        return $this->formattedResults;
    }

    public function getVersion(): stdClass
    {
        return $this->version;
    }

    /**
     * @throws UsabilityScoreNotAvailableException
     */
    public function getUsabilityScore(): int
    {
        $ruleGroups = $this->getRuleGroups();

        if (!array_key_exists(RuleGroup::GROUP_USABILITY, $ruleGroups)) {
            throw new UsabilityScoreNotAvailableException('Usability score is only available with mobile strategy API call.');
        }

        return $ruleGroups[RuleGroup::GROUP_USABILITY]->getScore();
    }

    public function getSpeedScore(): int
    {
        $ruleGroups = $this->getRuleGroups();

        return $ruleGroups[RuleGroup::GROUP_SPEED]->getScore();

    }

    public function hasScreenshot(): bool
    {
        return $this->screenshot instanceof Screenshot;
    }

    /**
     * @throws ScreenshotNotAvailableException
     */
    public function getScreenshot(): Screenshot
    {

        if (!$this->hasScreenshot()) {
            ScreenshotNotAvailableException::raise();
        }

        return $this->screenshot;
    }
}
