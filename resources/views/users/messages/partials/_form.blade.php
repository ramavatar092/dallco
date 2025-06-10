<div class="row">
    @php
        $formattedDate = '';
        if (!empty($message->date)) {
            try {
                $formattedDate = \Carbon\Carbon::parse($message->date)->format('Y-m-d');
            } catch (\Exception $e) {
                $formattedDate = '';
            }
        }
    @endphp

    <div class="mb-3 col-md-6">
        <label for="date" class="form-label">{{ __('Message Date') }}</label>
        <input type="date" id="date" name="date" placeholder="{{ __('Select date') }}"
            class="form-control @error('date') is-invalid @enderror"
            value="{{ old('date', $formattedDate) }}" required>
        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-6">
        <label for="title" class="form-label">{{ __('Title') }}</label>
        <input type="text" id="title" name="title" placeholder="{{ __('Title') }}"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $message->title ?? '') }}" required>
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-12">
        <label for="description" class="form-label">{{ __('Description') }}</label>
        <textarea id="description" name="description" placeholder="{{ __('Enter description') }}"
            class="form-control @error('description') is-invalid @enderror"
            required>{{ old('description', $message->description ?? '') }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3 col-md-12">
        <button type="submit" class="btn btn-success">{{ isset($message) && $message->exists ? __('Update') : __('Save') }}</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </div>
</div>