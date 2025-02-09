<?php

namespace App\Filament\Admin\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('total Admin', User::where('role', User::ROLE_ADMIN)->count()),
            Stat::make('total Editor', User::where('role', User::ROLE_EDITOR)->count()),
            Stat::make('total User', User::count()),
        ];
    }
}
