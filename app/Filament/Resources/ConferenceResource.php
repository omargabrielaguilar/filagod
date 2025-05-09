<?php

namespace App\Filament\Resources;

use App\Enums\Region;
use App\Filament\Resources\ConferenceResource\Pages;
use App\Models\Conference;
use App\Models\Venue;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;

class ConferenceResource extends Resource
{
  protected static ?string $model = Conference::class;

  protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

  /**
   * @throws BindingResolutionException
   */
  public static function form(Form $form): Form
  {
    return $form
      ->schema([
        Forms\Components\TextInput::make('name')
          ->label('Conference')
          ->required()
          ->helperText('The name of the conference.')
          ->hint('Here is the hint')
          ->hintIcon('heroicon-o-rectangle-stack')
          ->maxLength(255),
        Forms\Components\MarkdownEditor::make('description')
          ->required(),
        Forms\Components\DatePicker::make('start_date')
          ->required()
          ->native(false),
        Forms\Components\DatePicker::make('end_date')
          ->required()
          ->native(false),
        Forms\Components\Checkbox::make('is_published')
          ->default(true),
        Forms\Components\Select::make('status')
          ->options([
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
          ])
          ->required(),
        Forms\Components\Select::make('region')
          ->live() // rerender the form component
          ->enum(Region::class)   // validation rule for enums
          ->options(Region::class),
        Forms\Components\Select::make('venue_id')
          ->searchable()
          ->preload()
          ->createOptionForm(Venue::getForm())
          ->editOptionForm(Venue::getForm())
          ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
            return $query->where('region', $get('region'));
          })
          ->default(null),
      ]);
  }

  public static function table(Table $table): Table
  {
    return $table
      ->columns([
        Tables\Columns\TextColumn::make('name')
          ->searchable(),
        Tables\Columns\TextColumn::make('description')
          ->searchable(),
        Tables\Columns\TextColumn::make('start_date')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('end_date')
          ->dateTime()
          ->sortable(),
        Tables\Columns\TextColumn::make('status')
          ->searchable(),
        Tables\Columns\TextColumn::make('region')
          ->searchable(),
        Tables\Columns\TextColumn::make('venue.name')
          ->numeric()
          ->sortable(),
        Tables\Columns\TextColumn::make('created_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
        Tables\Columns\TextColumn::make('updated_at')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
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

  // ROUTES
  public static function getPages(): array
  {
    return [
      'index' => Pages\ListConferences::route('/'),
      'create' => Pages\CreateConference::route('/create'),
      'edit' => Pages\EditConference::route('/{record}/edit'),
    ];
  }
}
