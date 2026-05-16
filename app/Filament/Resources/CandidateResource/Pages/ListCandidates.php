<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListCandidates extends ListRecords
{
    protected static string $resource = CandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('الكل'),
            'pending' => Tab::make('قيد الانتظار')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'accepted' => Tab::make('مقبول')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'accepted')),
            'final_accepted' => Tab::make('قبول نهائي')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'final_accepted')),
            'waitlist' => Tab::make('قائمة الانتظار')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'waitlist')),
            'rejected' => Tab::make('مرفوض')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
}
