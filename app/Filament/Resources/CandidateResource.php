<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Filament\Resources\CandidateResource\RelationManagers;
use App\Models\Candidate;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    
    protected static ?string $modelLabel = 'مترشح';
    protected static ?string $pluralModelLabel = 'المترشحين';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('المعلومات الأساسية')
                    ->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->label('الاسم')
                            ->required(),
                        Forms\Components\TextInput::make('last_name')
                            ->label('اللقب')
                            ->required(),
                        Forms\Components\TextInput::make('email')
                            ->label('البريد الإلكتروني')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->tel()
                            ->required(),
                        Forms\Components\DatePicker::make('birth_date')
                            ->label('تاريخ الميلاد')
                            ->required(),
                        Forms\Components\TextInput::make('address')
                            ->label('العنوان')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('الانتماء والخبرة')
                    ->schema([
                        Forms\Components\Select::make('membership')
                            ->label('منخرط في')
                            ->options([
                                'مؤسسة شبانية' => 'مؤسسة شبانية',
                                'جمعية' => 'جمعية',
                                'حر' => 'حر',
                            ])
                            ->required()
                            ->live(),
                        Forms\Components\TextInput::make('membership_name')
                            ->label('اسم المؤسسة/الجمعية')
                            ->hidden(fn (Forms\Get $get) => $get('membership') === 'حر'),
                        
                        Forms\Components\Toggle::make('has_experience')
                            ->label('هل لديه خبرة؟')
                            ->required()
                            ->live(),
                        Forms\Components\Textarea::make('experience_list')
                            ->label('قائمة المشاركات')
                            ->visible(fn (Forms\Get $get) => $get('has_experience'))
                            ->columnSpanFull(),
                        
                        Forms\Components\Toggle::make('has_awards')
                            ->label('هل لديه جوائز؟')
                            ->required()
                            ->live(),
                        Forms\Components\Textarea::make('awards_list')
                            ->label('قائمة الجوائز')
                            ->visible(fn (Forms\Get $get) => $get('has_awards'))
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('الوسائط والحالة')
                    ->schema([
                        Forms\Components\FileUpload::make('profile_pic')
                            ->label('الصورة الشخصية')
                            ->image()
                            ->avatar()
                            ->directory('profiles'),
                        Forms\Components\FileUpload::make('gallery')
                            ->label('أعمال سابقة')
                            ->image()
                            ->multiple()
                            ->maxFiles(3)
                            ->directory('galleries'),
                        Forms\Components\Select::make('status')
                            ->label('الحالة')
                            ->options([
                                'pending' => 'قيد الانتظار',
                                'accepted' => 'مقبول',
                                'final_accepted' => 'قبول نهائي',
                                'rejected' => 'مرفوض',
                                'waitlist' => 'قائمة الانتظار',
                            ])
                            ->required()
                            ->default('pending'),
                    ])->columns(2),

                Forms\Components\Section::make('المسابقة والمشاركات (تعبأ من طرف المترشح)')
                    ->schema([
                        Forms\Components\TextInput::make('competition_status')
                            ->label('حالة المسابقة')
                            ->disabled(),
                        Forms\Components\TextInput::make('camera_brand')
                            ->label('نوع الكاميرا')
                            ->disabled(),
                        Forms\Components\TextInput::make('camera_model')
                            ->label('موديل الكاميرا')
                            ->disabled(),
                        Forms\Components\TextInput::make('camera_lenses')
                            ->label('العدسات المستخدمة')
                            ->disabled(),
                        Forms\Components\FileUpload::make('competition_submissions')
                            ->label('الصور النهائية المشارك بها')
                            ->image()
                            ->multiple()
                            ->disabled(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_pic')
                    ->label('الصورة')
                    ->circular(),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('الاسم')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->label('اللقب')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->label('تاريخ الميلاد')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('membership')
                    ->label('الانتساب')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'حر' => 'gray',
                        'جمعية' => 'info',
                        'مؤسسة شبانية' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'accepted' => 'success',
                        'final_accepted' => 'success',
                        'rejected' => 'danger',
                        'waitlist' => 'info',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاريخ التسجيل')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('تصفية حسب الحالة')
                    ->options([
                        'pending' => 'قيد الانتظار',
                        'accepted' => 'مقبول',
                        'final_accepted' => 'قبول نهائي',
                        'rejected' => 'مرفوض',
                        'waitlist' => 'قائمة الانتظار',
                    ]),
            ])
            ->actions([
                Tables\Actions\Action::make('accept')
                    ->label('قبول')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(fn (Candidate $record) => $record->update(['status' => 'accepted']))
                    ->visible(fn (Candidate $record) => $record->status !== 'accepted'),
                Tables\Actions\Action::make('final_accept')
                    ->label('قبول نهائي')
                    ->icon('heroicon-o-star')
                    ->color('success')
                    ->action(fn (Candidate $record) => $record->update(['status' => 'final_accepted']))
                    ->visible(fn (Candidate $record) => $record->status !== 'final_accepted'),
                Tables\Actions\Action::make('send_invitation')
                    ->label('إرسال الدعوة')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->action(function (Candidate $record) {
                        \Illuminate\Support\Facades\Mail::to($record->email)->send(new \App\Mail\CandidateInvitationMail($record));
                        \Filament\Notifications\Notification::make()
                            ->title('تم إرسال الدعوة بنجاح')
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Candidate $record) => in_array($record->status, ['accepted', 'final_accepted']))
                    ->requiresConfirmation()
                    ->modalHeading('إرسال دعوة للمترشح')
                    ->modalDescription('هل أنت متأكد أنك تريد إرسال بريد إلكتروني يحتوي على دعوة الحضور و QR Code لهذا المترشح؟'),
                Tables\Actions\Action::make('reject')
                    ->label('رفض')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->action(fn (Candidate $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn (Candidate $record) => $record->status !== 'rejected'),
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('send_invitations')
                        ->label('إرسال الدعوات')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if (in_array($record->status, ['accepted', 'final_accepted'])) {
                                    \Illuminate\Support\Facades\Mail::to($record->email)->send(new \App\Mail\CandidateInvitationMail($record));
                                    $count++;
                                }
                            }
                            \Filament\Notifications\Notification::make()
                                ->title("تم إرسال {$count} دعوة بنجاح")
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion()
                        ->modalHeading('إرسال دعوات للمترشحين المحددين')
                        ->modalDescription('هل أنت متأكد أنك تريد إرسال الدعوات؟ (سيتم الإرسال فقط للمقبولين)'),
                    Tables\Actions\BulkAction::make('generate_poster')
                        ->label('إنشاء ملصق المترشحين')
                        ->icon('heroicon-o-photo')
                        ->color('success')
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => redirect()->route('candidates.poster', ['ids' => $records->pluck('id')->join(',')])),
                    Tables\Actions\BulkAction::make('download_badges')
                        ->label('طباعة شارات المترشحين')
                        ->icon('heroicon-o-printer')
                        ->color('warning')
                        ->action(fn (\Illuminate\Database\Eloquent\Collection $records) => redirect()->route('admin.badges.print', ['ids' => $records->pluck('id')->join(',')])),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
            'view' => Pages\ViewCandidate::route('/{record}/view'),
        ];
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
