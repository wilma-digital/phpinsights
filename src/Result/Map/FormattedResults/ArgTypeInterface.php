<?php

namespace PhpInsights\Result\Map\FormattedResults;


interface ArgTypeInterface
{

    public const ARG_TYPE_BYTES = 'BYTES';

    public const ARG_TYPE_DISTANCE = 'DISTANCE';

     // Not in use
    public const ARG_TYPE_DURATION = 'DURATION';

    public const ARG_TYPE_HYPERLINK = 'HYPERLINK';

    public const ARG_TYPE_INT_LITERAL = 'INT_LITERAL';

    public const ARG_TYPE_PERCENTAGE = 'PERCENTAGE';

    public const ARG_TYPE_SNAPSHOT_RECT = 'SNAPSHOT_RECT';

     // Not in use
    public const ARG_TYPE_STRING_LITERAL = 'STRING_LITERAL';

     // Not in use
    public const ARG_TYPE_URL = 'URL';

    public const ARG_TYPE_VERBATIM_STRING = 'VERBATIM_STRING'; // Not in use

}