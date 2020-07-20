<?php

namespace App\Service\Synchronizer\BackToFront\Implementation;

use App\Entity\Front\Currency as CurrencyFront;
use App\Helper\Store;
use App\Repository\Back\CurrencyRepository as CurrencyBackRepository;
use App\Repository\Front\CurrencyRepository as CurrencyFrontRepository;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class CurrencySynchronizer extends BackToFrontSynchronizer
{
    /** @var EventDispatcherInterface $eventDispatcher */
    protected $eventDispatcher;

    /** @var CurrencyBackRepository $currencyBackRepository */
    protected $currencyBackRepository;

    /** @var CurrencyFrontRepository $currencyFrontRepository */
    protected $currencyFrontRepository;

    /**
     * CurrencySynchronizer constructor.
     * @param EventDispatcherInterface $eventDispatcher
     * @param CurrencyBackRepository $currencyBackRepository
     * @param CurrencyFrontRepository $currencyFrontRepository
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        CurrencyBackRepository $currencyBackRepository,
        CurrencyFrontRepository $currencyFrontRepository
    )
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->currencyBackRepository = $currencyBackRepository;
        $this->currencyFrontRepository = $currencyFrontRepository;
    }

    /**
     * @param CurrencyFront $currencyFront
     * @return CurrencyFront|null
     */
    protected function synchronizeCurrency(CurrencyFront $currencyFront): ?CurrencyFront
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