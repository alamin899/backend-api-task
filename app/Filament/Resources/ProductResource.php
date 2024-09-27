<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->afterStateUpdated(fn($state, callable $set, callable $get, Page $livewire) => $livewire instanceof CreateRecord ? $set('slug', Str::slug($state, '-', 'bn', ['@' => 'a'])) : $set('slug', $get('slug') ? $get('slug') : Str::slug($state, '-', 'bn', ['@' => 'a'])))
                                    ->live(true),
                                Forms\Components\TextInput::make(name: 'slug')
                                    ->required()
                                    ->unique(Product::class, 'slug', fn($record) => $record),
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                                Forms\Components\TextInput::make('stock')
                                    ->required()
                                    ->numeric()
                                    ->minValue(1),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('slug')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('stock'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
