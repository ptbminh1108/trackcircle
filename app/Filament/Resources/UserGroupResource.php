<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserGroupResource\Pages;
use App\Filament\Resources\UserGroupResource\RelationManagers;
use App\Models\UserGroup;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserGroupResource extends Resource
{
    protected static ?string $model = UserGroup::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('permission_type')->options(['all' => 'all','custom' => 'custom'])->required(),
                CheckboxList::make("permissions")->options([
                    'admin/invoices/create' => 'admin/invoices/create',
                    'admin/invoices/list' => 'admin/invoices/list',
                    'admin/invoices/edit' => 'admin/invoices/edit',
                    'admin/invoices/delete' => 'admin/invoices/delete',
                    
                    'admin/user_groups/create' => 'admin/user_groups/create',
                    'admin/user_groups/list' => 'admin/user_groups/list',
                    'admin/user_groups/edit' => 'admin/user_groups/edit',
                    'admin/user_groups/delete' => 'admin/user_groups/delete',

                    'admin/users/create' => 'admin/users/create',
                    'admin/users/list' => 'admin/users/list',
                    'admin/users/edit' => 'admin/users/edit',
                    'admin/users/delete' => 'admin/users/delete',

                ])->columns(2)->searchable()->bulkToggleable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('name'),
                TextColumn::make('permission_type'),
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
            'index' => Pages\ListUserGroups::route('/'),
            'create' => Pages\CreateUserGroup::route('/create'),
            'edit' => Pages\EditUserGroup::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('name','!=',"Admin");
    }
}
