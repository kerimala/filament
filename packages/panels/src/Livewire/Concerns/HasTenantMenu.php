<?php

namespace Filament\Livewire\Concerns;

use Filament\Actions\Action;
use Filament\Facades\Filament;

trait HasTenantMenu
{
    /**
     * @var array<Action>
     */
    protected ?array $tenantMenuItems = null;

    public function bootHasTenantMenu(): void
    {
        if (! Filament::hasTenancy()) {
            return;
        }

        if (! Filament::hasTenantMenu()) {
            return;
        }

        $this->tenantMenuItems = Filament::getTenantMenuItems();

        foreach ($this->tenantMenuItems as $action) {
            $action->defaultView($action::GROUPED_VIEW);

            $this->cacheAction($action);
        }
    }

    /**
     * @return array<Action>
     */
    protected function getTenantMenuItems(): array
    {
        if (! isset($this->tenantMenuItems)) {
            // If tenant menu items are not set, fetch them from Filament
            $this->tenantMenuItems = Filament::getTenantMenuItems();
        }

        return $this->tenantMenuItems;
    }
}
