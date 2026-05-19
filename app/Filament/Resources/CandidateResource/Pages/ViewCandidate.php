<?php

namespace App\Filament\Resources\CandidateResource\Pages;

use App\Filament\Resources\CandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCandidate extends ViewRecord
{
    protected static string $resource = CandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('check_in')
                ->label('تسجيل الحضور')
                ->icon('heroicon-o-check-badge')
                ->color('success')
                ->action(function () {
                    $this->record->update(['competition_status' => 'checked_in']);
                    \Filament\Notifications\Notification::make()->title('تم تسجيل الحضور بنجاح')->success()->send();
                })
                ->visible(fn () => $this->record->competition_status === 'pending_arrival'),

            Actions\Action::make('start_competition')
                ->label('بدء المسابقة')
                ->icon('heroicon-o-play')
                ->color('warning')
                ->requiresConfirmation()
                ->modalDescription('هل أنت متأكد من بدء المسابقة لهذا المترشح؟ سيتم فتح نموذج رفع الصور في بوابته الخاصة.')
                ->action(function () {
                    $this->record->update([
                        'competition_status' => 'started',
                        'competition_started_at' => now(),
                    ]);
                    \Filament\Notifications\Notification::make()->title('تم بدء المسابقة')->success()->send();
                })
                ->visible(fn () => $this->record->competition_status === 'checked_in'),

            Actions\EditAction::make(),
        ];
    }
    
}
