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
