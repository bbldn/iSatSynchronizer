<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanSynchronizeAll;

interface CurrencySynchronizerInterface extends CanLoadInterface, CanSynchronizeAll
{
}