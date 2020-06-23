<?php

namespace App\Service\Synchronizer\BackToFront;

use App\Helper\Store;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Front\CurrencyRepository as CurrencyFrontRepository;

class CurrencySynchronizer
{
    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var CurrencyFrontRepository $currencyFrontRepository */
    protected $currencyFrontRepository;

    /**
     * CurrencySynchronizer constructor.
     * @param CurrencyBackRepository $currencyBackRepository
     * @param CurrencyFrontRepository $currencyFrontRepository
     */
    public function __construct(
        CurrencyBackRepository $currencyBackRepository,
        CurrencyFrontRepository $currencyFrontRepository
    )
    {
        $this->currencyBackRepository = $currencyBackRepository;
        $this->currencyFrontRepository = $currencyFrontRepository;
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $currenciesFront = $this->currencyFrontRepository->findAll();

        foreach ($currenciesFront as $currencyFront) {
            $backCurrency = Store::convertFrontToBackCurrency($currencyFront->getCode());
            $currencyBack = $this->currencyBackRepository->findOneByNameAndShopId($backCurrency, 0);
            if (null === $currencyBack) {
                continue;
            }
            $currencyFront->setValue($currencyBack->getValue());
            $this->currencyFrontRepository->persistAndFlush($currencyFront);
        }
    }
}