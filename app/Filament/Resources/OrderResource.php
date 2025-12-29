<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')->required(),
                Forms\Components\TextInput::make('customer_phone')->required(),
                Forms\Components\Select::make('order_type')
                    ->options([
                        'pickup' => 'Pickup',
                        'delivery' => 'Delivery',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('total_price')->numeric()->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Selesai',
                        'cancelled' => 'Batal',
                    ])
                    ->required(),
                Textarea::make('address')
                    ->label('Alamat Pengiriman')
                    ->columnSpanFull()
                    ->rows(3)
                    ->visible(fn ($record) => $record?->order_type === 'delivery'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Order ID'),
                TextColumn::make('customer_name')->searchable(),
                TextColumn::make('order_type')->badge()->color(fn (string $state): string => match ($state) {
                    'pickup' => 'info',
                    'delivery' => 'warning',
                }),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30)
                    ->tooltip(fn (Order $record): string => $record->address ?? '')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_price')->money('IDR'),
                SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Selesai',
                        'cancelled' => 'Batal',
                ]),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
