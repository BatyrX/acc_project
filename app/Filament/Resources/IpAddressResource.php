<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IpAddressResource\Pages;
use App\Filament\Resources\IpAddressResource\RelationManagers;
use App\Models\IpAddress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IpAddressResource extends Resource
{
    protected static ?string $model = IpAddress::class;

    protected static ?string $navigationLabel = 'IP-адреса';
    protected static ?string $modelLabel = 'IP-адрес';
    protected static ?string $pluralModelLabel = 'IP-адресы';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ip_address')
                    ->required()
                    ->label('IP-адрес'),
                Forms\Components\TextInput::make('subnet')
                    ->required()
                    ->label('Подсеть'),
                Forms\Components\TextInput::make('mac_address')
                    ->label('MAC-адрес'),
                Forms\Components\Select::make('status')
                    ->options(IpAddress::getStatuses())
                    ->required()
                    ->label('Статус'),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('Пользователь'),
                Forms\Components\Select::make('campus_id')
                    ->relationship('campus', 'classroom')
                    ->label('Аудитория')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip_address')
                    ->label('IP-адрес')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('subnet')
                    ->label('Подсеть')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('mac_address')
                    ->label('MAC-адрес'),
                TextColumn::make('status')
                    ->label('Статус')
                    ->formatStateUsing(fn($state) => IpAddress::getStatus($state)),
                TextColumn::make('user.name')
                    ->label('Пользователь'),
                TextColumn::make('campus.classroom')
                    ->label('Аудитория'),
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
            'index' => Pages\ListIpAddresses::route('/'),
            'create' => Pages\CreateIpAddress::route('/create'),
            'edit' => Pages\EditIpAddress::route('/{record}/edit'),
        ];
    }
}
