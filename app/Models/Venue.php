<?php

namespace App\Models;

use App\Enums\Region;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/** @package App\Models */
class Venue extends Model
{
    use HasFactory;

    /** @return array  */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'region' => Region::class
        ];
    }

    public function conferences(): HasMany
    {
        return $this->hasMany(Conference::class);
    }

    public static function getForm(): array
    {
        return
        [
        TextInput::make('name')
          ->required()
          ->maxLength(255),
        TextInput::make('city')
          ->required()
          ->maxLength(255),
        TextInput::make('country')
          ->required()
          ->maxLength(255),
        TextInput::make('postal_code')
          ->required()
          ->maxLength(255),
        Select::make('region')
          ->enum(Region::class)   //validation rule for enums
          ->options(Region::class),
      ];
    }
}
