{{-- Load SVG Sprite --}}
<div style="display: none;">
    @if (file_exists(public_path('icons/icons-sprite.svg')))
        {!! file_get_contents(public_path('icons/icons-sprite.svg')) !!}
    @else
        {{-- Fallback jika file belum ada --}}
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="icon-home" viewBox="0 0 24 24">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" fill="currentColor" />
            </symbol>
            <symbol id="icon-scale" viewBox="0 0 24 24">
                <path
                    d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-4h2v2h-2zm0-8h2v6h-2z"
                    fill="currentColor" />
            </symbol>
            <!-- Tambahkan symbol lainnya sesuai kebutuhan -->
        </svg>
    @endif
</div>
