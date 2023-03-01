<div class="mt-3 pt-3 first:mt-0 first:pt-0">
    @if ($label)
    <div class="form-label xl:w-64 xl:!mr-10 mb-2">
        <div class="flex items-center">
            <div class="font-medium">{{ $label }}</div>
            <span class="ml-2 text-red-700">*</span>
        </div>
    </div>
    @endif
    <textarea class="editor-instance" name="description">{{ $slot }}</textarea>
</div>

{{ register_assets_js('js/tinymce/tinymce.min.js') }}
{{ register_assets_js('js/tinymce.js') }}
