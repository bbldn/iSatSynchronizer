<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Front\Currency as CurrencyFront;
use App\Helper\Store;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Front\CurrencyRepository as CurrencyFrontRepository;

class CurrencySynchronizer extends BackToFrontSynchronizer
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
    public function load(): void
    {
        parent::load();
    }

    /**
     *
     */
    public function synchronizeAll(): void
    {
        $currenciesFront = $this->currencyFrontRepository->findAll();

        foreach ($currenciesFront as $currencyFront) {
            $this->synchronizeCurrency($currencyFront);
        }
    }

    /**
     * @param CurrencyFront $currencyFront
     * @return CurrencyFront|null
     */
    public function synchronizeCurrency(CurrencyFront $currencyFront): ?CurrencyFront
    {
        $backCurrency = Store::convertFrontToBackCurrency($currencyFront->getCode());
        $currencyBack = $this->currencyBackRepository->findOneByNameAndShopId($backCurrency, 0);
        if (null === $currencyBack) {
            return null;
        }
        $currencyFront->setValue($currencyBack->getValue());
        $this->currencyFrontRepository->persistAndFlush($currencyFront);

        return $currencyFront;
    }
}