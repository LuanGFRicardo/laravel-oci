<?php

namespace App\Filament\Resources\UserManagementResource\Pages;

use App\Filament\Resources\UserManagementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUserManagement extends CreateRecord
{
    protected static string $resource = UserManagementResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl();
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $role = $data['role'];
        unset($data['role']);

        $data['aprovacao'] = \App\Models\User::APROVACAO_PENDENTE;

        $record = $this->getModel()::create($data);

        $record->assignRole($role);

        return $record;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['aprovacao'] = \App\Models\User::APROVACAO_PENDENTE;

        return $data;
    }
}
