<?php

namespace PhpInsights\Result\Map;

use PhpInsights\Result\Map\FormattedResults\DefaultRuleResult;

class FormattedResults
{

    private string $locale;

    /** @var DefaultRuleResult[] */
    private array $ruleResults;

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    /**
     * @return DefaultRuleResult[]
     */
    public function getRuleResults(): array
    {
        return $this->ruleResults;
    }

    /**
     * @param DefaultRuleResult[] $ruleResults
     */
    public function setRuleResults(array $ruleResults): void
    {
        $this->ruleResults = $ruleResults;
    }

    /**
     * @return DefaultRuleResult[]
     */
    public function getRuleResultsByGroup(string $group): array
    {
        $results = [];
        foreach ($this->getRuleResults() as $rule => $ruleResult) {
            if (in_array($group, $ruleResult->getGroups())) {
                $results[$rule] = $ruleResult;
            }
        }

        return $results;
    }

}
