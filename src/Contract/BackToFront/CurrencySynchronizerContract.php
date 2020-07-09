<?php

namespace App\Contract\BackToFront;

use App\Contract\CanLoadInterface;
use App\Contract\CanSynchronizeAll;

interface CurrencySynchronizerContract extends CanLoadInterface, CanSynchronizeAll
{
}