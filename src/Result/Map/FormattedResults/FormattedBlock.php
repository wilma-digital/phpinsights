<?php

namespace PhpInsights\Result\Map\FormattedResults;

use Closure;
use PhpInsights\Result\Map\FormattedResults\ArgTypeInterface as ArgTypes;
use Stringable;

class FormattedBlock implements Stringable
{

    private string $format;

    /** @var Arg[] */
    private array $args;

    /**
     * @throws ArgException
     * @throws FormatException
     */
    public function __toString(): string
    {
        return $this->toString(null);
    }

    protected static function getDefaultLinkFormatter(): Closure
    {
        return static fn(Arg $arg, $format): string => strtr($format, [
            '{{BEGIN_LINK}}' => sprintf('<a href="%s" target="_blank">', $arg->getValue()),
            '{{END_LINK}}'   => '</a>',
        ]);
    }

    protected static function getRemoveLinkFormatter(): Closure
    {
        return static fn(Arg $arg, $format): string => strtr($format, [
            '{{BEGIN_LINK}}' => '',
            '{{END_LINK}}'   => '',
        ]);
    }

    protected static function getPlaceholderFormatter(): Closure
    {
        return static function (Arg $arg, $format): string|array {
            $placeholder = sprintf("{{%s}}", $arg->getKey());
            return str_replace($placeholder, $arg->getValue(), $format);
        };
    }

    /**
     *
     *
     * @throws ArgException
     * @throws FormatException
     */
    public function toString(Closure $linkFormatterCallback = null): string
    {

        $format = $this->getFormat();

        $linkFormatter = ($linkFormatterCallback instanceof Closure) ? $linkFormatterCallback : self::getDefaultLinkFormatter();
        $placeholderFormatter = self::getPlaceholderFormatter();

        foreach ($this->getArgs() as $arg) {
            $format = match ($arg->getType()) {
                ArgTypes::ARG_TYPE_HYPERLINK => $linkFormatter($arg, $format),
                ArgTypes::ARG_TYPE_BYTES, ArgTypes::ARG_TYPE_DISTANCE, ArgTypes::ARG_TYPE_DURATION, ArgTypes::ARG_TYPE_INT_LITERAL, ArgTypes::ARG_TYPE_PERCENTAGE, ArgTypes::ARG_TYPE_SNAPSHOT_RECT, ArgTypes::ARG_TYPE_STRING_LITERAL, ArgTypes::ARG_TYPE_URL, ArgTypes::ARG_TYPE_VERBATIM_STRING => $placeholderFormatter($arg, $format),
                default => throw new ArgException(sprintf('Unknown argument type: "%s"!', $arg->getType())),
            };
        }

        return $format;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function setFormat(string $format): void
    {
        $this->format = $format;
    }

    /**
     * @return Arg[]
     */
    public function getArgs(): array
    {
        return is_array($this->args)
            ? $this->args
            : [];
    }

    /**
     * @param Arg[] $args
     */
    public function setArgs(array $args): void
    {
        $this->args = $args;
    }


}
