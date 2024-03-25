<?php

namespace PhpInsights\Result\Map;

class RuleGroup
{

    public const GROUP_SPEED = 'SPEED';

    public const GROUP_USABILITY = 'USABILITY';

    protected int $score;

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        $this->score = $score;
    }
}
