<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Candidate;

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
            'all' => Tab::make('الكل')
                ->badge(Candidate::count()),
            'pending' => Tab::make('قيد الانتظار')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(Candidate::where('status', 'pending')->count())
                ->badgeColor('warning'),
            'accepted' => Tab::make('مقبول')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'accepted'))
                ->badge(Candidate::where('status', 'accepted')->count())
                ->badgeColor('success'),
            'final_accepted' => Tab::make('قبول نهائي')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'final_accepted'))
                ->badge(Candidate::where('status', 'final_accepted')->count())
                ->badgeColor('success'),
            'waitlist' => Tab::make('قائمة الانتظار')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'waitlist'))
                ->badge(Candidate::where('status', 'waitlist')->count())
                ->badgeColor('info'),
            'rejected' => Tab::make('مرفوض')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(Candidate::where('status', 'rejected')->count())
                ->badgeColor('danger'),
        ];
    }
}
