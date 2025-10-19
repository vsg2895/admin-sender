@extends('layouts.app')
@section('content')
    <h1>{{ isset($template) ? 'Edit Email Template' : 'Create Email Template' }}</h1>
    <form action="{{ isset($template) ? route('templates.update', $template) : route('templates.store') }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($template))
            @method('PUT')
        @endif
        <div class="mb-3">
            <label for="name" class="form-label">Template Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $template->name ?? '') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" required>{{ old('content', $template->content ?? '') }}</textarea>
            @error('content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            @if(isset($template->image))
                <div class="mt-2">
                    <p>Current Image: </p><br>
                    <img style="width:100%; height: auto" src="{{ asset('storage/images/' . $template->image) }}">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="include_sent" class="form-label">Include Sent Clients</label>
            <select name="include_sent" id="include_sent" class="form-control" required>
                <option value="1" {{ old('include_sent', $template->include_sent ?? false) ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('include_sent', $template->include_sent ?? false) ? '' : 'selected' }}>No</option>
            </select>
            @error('include_sent')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="count" class="form-label">Client Count</label>
            <input type="text" name="count" id="count" class="form-control" value="{{ old('count', $template->count ?? 1) }}" min="1" required>
            @error('count')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($template) ? 'Update' : 'Create' }}</button>
    </form>

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('content', {
                height: 300,
                toolbar: [
                    { name: 'basic', items: ['Bold', 'Italic', 'Underline', 'Link', 'Unlink', 'NumberedList', 'BulletedList'] },
                    { name: 'paragraph', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
                    { name: 'styles', items: ['Font', 'FontSize', 'TextColor', 'BGColor'] }
                ]
            });

            $('form').on('submit', function() {
                for (var instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            });
        });
    </script>
@endsection
