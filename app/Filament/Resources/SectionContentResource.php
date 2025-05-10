<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionContentResource\Pages;
use App\Filament\Resources\SectionContentResource\RelationManagers;
use App\Models\CourseSection;
use App\Models\SectionContent;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionContentResource extends Resource
{
    protected static ?string $model = SectionContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('course_section_id')
                    ->label('Course Section')
                    ->options(function(){
                        return CourseSection::with('course')
                            ->get()
                            ->mapWithKeys(function ($section){
                                return [
                                    $section->id => $section->course
                                    ? "{$section->course->name} - {$section->name}"
                                    : $section->name
                                ];
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->required(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('courseSection.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('courseSection.course.name')
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
            'index' => Pages\ListSectionContents::route('/'),
            'create' => Pages\CreateSectionContent::route('/create'),
            'edit' => Pages\EditSectionContent::route('/{record}/edit'),
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
