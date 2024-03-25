<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\CompleteDynamicPropertiesRector;
use Rector\CodingStyle\Rector\Stmt\RemoveUselessAliasInUseStatementRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\Class_\MergeDateTimePropertyTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Class_\PropertyTypeFromStrictSetterGetterRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddReturnTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeForFunctionLikeWithinCallLikeArgDeclarationRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddParamTypeSplFixedArrayRector;
use Rector\TypeDeclaration\Rector\FunctionLike\AddReturnTypeDeclarationFromYieldsRector;
use Rector\TypeDeclaration\Rector\Property\AddPropertyTypeDeclarationRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests'
    ])
    ->withSets([
        SetList::DEAD_CODE,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        LevelSetList::UP_TO_PHP_83
    ])
    ->withRules([
        AddVoidReturnTypeWhereNoReturnRector::class,
        AddParamTypeForFunctionLikeWithinCallLikeArgDeclarationRector::class,
        AddParamTypeFromPropertyTypeRector::class,
        AddParamTypeSplFixedArrayRector::class,
        AddPropertyTypeDeclarationRector::class,
        AddReturnTypeDeclarationFromYieldsRector::class,
        AddReturnTypeDeclarationRector::class,
        PropertyTypeFromStrictSetterGetterRector::class,
        MergeDateTimePropertyTypeDeclarationRector::class,
        RemoveUselessAliasInUseStatementRector::class,
        CompleteDynamicPropertiesRector::class
    ]);
