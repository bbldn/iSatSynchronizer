<?php

namespace App\Other;


class Store
{
    protected static $instance = null;

    protected $availableStatusId = 7;
    protected $notAvailableStatusId = 5;
    protected $defaultLanguageId = 1;
    protected $defaultStoreId = 0;
    protected $defaultLayoutId = 0;
    protected $defaultCategoryFrontId = 0;
    protected $rootCategories = [0, 1];

    public static function getAvailableStatusId()
    {
        return static::getInstance()->availableStatusId;
    }

    public static function getNotAvailableStatusId(): int
    {
        return static::getInstance()->notAvailableStatusId;
    }

    public static function getDefaultLanguageId(): int
    {
        return static::getInstance()->defaultLanguageId;
    }

    public static function getDefaultStoreId(): int
    {
        return static::getInstance()->defaultStoreId;
    }

    public static function getDefaultLayoutId(): int
    {
        return static::getInstance()->defaultLayoutId;
    }

    public static function getDefaultCategoryFrontId(): int
    {
        return static::getInstance()->defaultCategoryFrontId;
    }

    public static function getRootCategories(): array
    {
        return static::getInstance()->rootCategories;
    }

    protected function __construct()
    {
        $this->availableStatusId = 7;
        $this->notAvailableStatusId = 5;
        $this->defaultLanguageId = 1;
        $this->defaultStoreId = 0;
        $this->defaultLayoutId = 0;
        $this->defaultCategoryFrontId = 0;
        $this->rootCategories = [0, 1];
    }

    public static function getInstance(): Store
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

}