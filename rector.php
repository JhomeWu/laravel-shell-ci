<?php

use Rector\CodeQuality\Rector\Class_\StaticToSelfStaticMethodCallOnFinalClassRector;
use Rector\CodeQuality\Rector\ClassConstFetch\ConvertStaticPrivateConstantToSelfRector;
use Rector\CodeQuality\Rector\Empty_\SimplifyEmptyCheckOnEmptyArrayRector;
use Rector\CodeQuality\Rector\If_\CombineIfRector;
use Rector\CodeQuality\Rector\If_\SimplifyIfElseToTernaryRector;
use Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector;
use Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\PropertyProperty\RemoveNullPropertyInitializationRector;
use Rector\Php70\Rector\FuncCall\RandomFunctionRector;
use Rector\Php70\Rector\FunctionLike\ExceptionHandlerTypehintRector;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector;
use Rector\Set\ValueObject\SetList;
use Rector\Strict\Rector\Empty_\DisallowedEmptyRuleFixerRector;

return RectorConfig::configure()
    ->withSets([
        SetList::PHP_53,
        SetList::PHP_54,
        SetList::PHP_55,
        SetList::PHP_70,
        SetList::PHP_71,
        SetList::PHP_72,
        SetList::PHP_73,
        SetList::PHP_74,
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        SetList::PHP_83,
        SetList::PHP_POLYFILLS,
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        naming: false, // 這個改的不好
        strictBooleans: false, // 這個改的不好
        privatization: true,
        // codingStyle: true, // 這個還沒有驗證過
    )
    ->withRules([])
    ->withSkip([
        // deadCode: true,
        RemoveNullPropertyInitializationRector::class, // deadCode: true, from my point of view default null is good

        // codeQuality
        DisallowedEmptyRuleFixerRector::class, // codeQuality: true, I like empty more than === []
        SimplifyEmptyCheckOnEmptyArrayRector::class, // codeQuality: true, I like empty more than === []
        IssetOnPropertyObjectToPropertyExistsRector::class, // codeQuality: true, isset is more readable
        CombineIfRector::class, // codeQuality: true, the line will be more than 80, but i don't think it fits in every case
        ConvertStaticPrivateConstantToSelfRector::class, // codeQuality: true, this is not important
        NewStaticToNewSelfRector::class, // codeQuality: true, this is not important like ConvertStaticPrivateConstantToSelfRector
        StaticToSelfStaticMethodCallOnFinalClassRector::class, // codeQuality: true, this is not important like ConvertStaticPrivateConstantToSelfRector
        SimplifyIfElseToTernaryRector::class, // codeQuality: true, I dont think this is good, because it will make line long, it is not easy to read

        // PHP 70
        ExceptionHandlerTypehintRector::class, // php70: true, because of Exception is more specific than Throwable
        RandomFunctionRector::class, // php70: true, because this is not important

        // PHP 74
        ClosureToArrowFunctionRector::class, // php74: true, I don't like this

        // PHP 80
        ChangeSwitchToMatchRector::class, // php80: true, I don't like this
        ClassPropertyAssignToConstructorPromotionRector::class, // php80: true, promotion is good but sometimes not
    ]);
