<?php

namespace App\Filament\Forms;

use App\Support\Typography;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class ContentStyles
{
    /**
     * Collapsed style controls for named content elements.
     *
     * @param  array<string, string>  $elements  key => label (dot keys under $statePath)
     */
    public static function section(string $statePath, array $elements, string $title = 'Content styles'): Section
    {
        $fields = [];

        foreach ($elements as $key => $label) {
            $base = "{$statePath}.{$key}";

            $fields[] = Section::make($label)
                ->collapsed()
                ->columns(4)
                ->schema([
                    TextInput::make("{$base}.size")
                        ->label('Size')
                        ->placeholder('e.g. 32px')
                        ->helperText('Use units: 18px, 1.25rem. A plain number becomes px.'),
                    Select::make("{$base}.weight")
                        ->label('Weight')
                        ->options(Typography::weightOptions())
                        ->placeholder('Inherit'),
                    ColorPicker::make("{$base}.color")
                        ->label('Text color'),
                    TextInput::make("{$base}.line_height")
                        ->label('Line height')
                        ->placeholder('e.g. 40px or 1.4'),
                    TextInput::make("{$base}.letter_spacing")
                        ->label('Letter spacing')
                        ->placeholder('e.g. -0.02em'),
                    ColorPicker::make("{$base}.background")
                        ->label('Background'),
                ]);
        }

        return Section::make($title)
            ->description('Optional. Leave blank to keep the default site design. These styles apply only to this service page section.')
            ->collapsed()
            ->schema($fields);
    }
}
