<?php

if (! function_exists('normalize_upload_path')) {
    /**
     * Normalize Filament FileUpload state into a single storage-relative path.
     */
    function normalize_upload_path(mixed $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        if (is_array($value)) {
            $value = collect($value)
                ->flatten()
                ->filter(fn ($item) => filled($item) && is_string($item))
                ->first();
        }

        if (! is_string($value) || blank($value)) {
            return null;
        }

        return ltrim($value, '/');
    }
}

if (! function_exists('media_url')) {
    function media_url(mixed $path): ?string
    {
        $path = normalize_upload_path($path);

        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, '//')) {
            return $path;
        }

        // Prefer root-relative URLs so assets work on localhost and 127.0.0.1.
        if (str_starts_with($path, 'storage/')) {
            return '/'.$path;
        }

        if (str_starts_with($path, '/')) {
            return $path;
        }

        if (str_starts_with($path, 'images/')) {
            return '/'.$path;
        }

        return '/storage/'.$path;
    }
}

if (! function_exists('normalize_content_style_value')) {
    /**
     * Normalize admin style values so bare numbers become valid CSS.
     */
    function normalize_content_style_value(string $key, mixed $value): ?string
    {
        if (blank($value) || (! is_string($value) && ! is_numeric($value))) {
            return null;
        }

        $value = trim((string) $value);

        if ($value === '') {
            return null;
        }

        // Font size: "32" => "32px"
        if ($key === 'size' && preg_match('/^-?\d+(\.\d+)?$/', $value) === 1) {
            return $value.'px';
        }

        // Line height: large numbers are treated as px; small decimals stay unitless (e.g. 1.4)
        if ($key === 'line_height' && preg_match('/^-?\d+(\.\d+)?$/', $value) === 1) {
            return ((float) $value) >= 10 ? $value.'px' : $value;
        }

        // Letter spacing: "0.02" => "0.02em"
        if ($key === 'letter_spacing' && preg_match('/^-?\d+(\.\d+)?$/', $value) === 1) {
            return $value.'em';
        }

        return $value;
    }
}

if (! function_exists('content_style_attrs')) {
    /**
     * Inline style attribute for optional admin-managed content styles.
     * Uses !important so values win over global typography utility CSS.
     *
     * @param  array<string, mixed>|null  $style
     */
    function content_style_attrs(?array $style): string
    {
        if (! is_array($style)) {
            return '';
        }

        $map = [
            'size' => 'font-size',
            'weight' => 'font-weight',
            'color' => 'color',
            'line_height' => 'line-height',
            'letter_spacing' => 'letter-spacing',
            'background' => 'background-color',
        ];

        $parts = [];

        foreach ($map as $key => $cssProp) {
            $value = normalize_content_style_value($key, $style[$key] ?? null);

            if ($value === null) {
                continue;
            }

            $parts[] = $cssProp.': '.$value.' !important';
        }

        if ($parts === []) {
            return '';
        }

        return ' style="'.htmlspecialchars(implode('; ', $parts).';', ENT_COMPAT, 'UTF-8').'"';
    }
}
