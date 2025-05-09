<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseMentorResource\Pages;
use App\Filament\Resources\CourseMentorResource\RelationManagers;
use App\Models\CourseMentor;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CourseMentorResource extends Resource
{
    protected static ?string $model = CourseMentor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_id')
                    ->relationship('course', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('user_id')
                    ->label('Mentor')
                    ->options(function(){
                        return User::role('mentor')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
                Textarea::make('about')
                    ->required(),
                Select::make('is_active')
                    ->options([
                        true => 'Active',
                        false => 'Banned'
                    ])
                    ->required()
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('mentor.photo'),
                TextColumn::make('mentor.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('course.name')
                    ->searchable()
                    ->sortable()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListCourseMentors::route('/'),
            'create' => Pages\CreateCourseMentor::route('/create'),
            'edit' => Pages\EditCourseMentor::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
