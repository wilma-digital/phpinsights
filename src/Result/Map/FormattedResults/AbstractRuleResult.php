<?php
namespace PhpInsights\Result\Map\FormattedResults;


use Stringable;

class AbstractRuleResult implements Stringable
{
    private string $localizedRuleName;

    private float $ruleImpact;

    private array $groups;

    private Summary $summary;

    /** @var UrlBlock[] */
    public array $urlBlocks;

    public function setLocalizedRuleName(string $localizedRuleName): void
    {
        $this->localizedRuleName = $localizedRuleName;
    }

    public function getLocalizedRuleName(): string
    {
        return $this->localizedRuleName;
    }

    public function getRuleImpact(): float
    {
        return $this->ruleImpact;
    }

    public function setRuleImpact(float $ruleImpact): void
    {
        $this->ruleImpact = $ruleImpact;
    }

    public function getSummary(): Summary
    {
        return $this->summary;
    }

    public function setSummary(Summary $summary): void
    {
        $this->summary = $summary;
    }

    public function hasSummary(): bool
    {
        return $this->summary instanceof \PhpInsights\Result\Map\FormattedResults\Summary;
    }

    /**
     * @return UrlBlock[]
     */
    public function getUrlBlocks(): array
    {
        return $this->urlBlocks;
    }

    public function hasUrlBlocks(): bool
    {
        return $this->urlBlocks !== [];
    }

    /**
     * @return FormattedBlock[]
     */
    public function getDetails(): array
    {

        $details = [];

        if($this->hasUrlBlocks()) {
            foreach($this->getUrlBlocks() as $urlBlock) {
                $details[] = $urlBlock->header;
                foreach($urlBlock->getUrls() as $url) {
                    $details[] = $url->result;
                }
            }
        }

        if($this->hasSummary()) {
            $details[] = $this->getSummary();
        }

        return $details;

    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function setGroups(array $groups): void
    {
        $this->groups = $groups;
    }

    public function toString(): string
    {

        return sprintf('%s (Impact %s)', $this->getLocalizedRuleName(), $this->getRuleImpact());
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
