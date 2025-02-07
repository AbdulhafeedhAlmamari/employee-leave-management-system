<?php

namespace App\Repositories\Contracts;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface LeaveRequestRepositoryInterface extends BaseRepositoryInterface
{
    public function getLeaveSummaryReport();
}
