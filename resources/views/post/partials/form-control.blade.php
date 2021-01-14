<input type="file" id="thumbnail" name="thumbnail">
@error('thumbnail')
    <div class="text-danger mb-2">
        {{$message}}
    </div>
@enderror
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title}}">
    @error('title')
        <div class="text-danger mb-2">
            {{ $message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="category">Category</label>
    <select name="category" id="category" class="form-control">
        <option disabled selected value="">Pilih satu</option>
        @foreach ($categories as $category)
            <option {{$category->id == $post->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    @error('category')
        <div class="text-danger mb-2">
            {{ $message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="tags">tag</label>
    <select name="tags[]" id="tags" class="form-control js-multiple" multiple>
        @foreach ($post->tags as $tag)
            <option selected value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
        @foreach ($tags as $tag)
        
            <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>
    @error('tags')
        <div class="text-danger mb-2">
            {{ $message}}
        </div>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea  name="body" id="body" class="form-control">{{ old('body') ?? $post->body}}</textarea>
        @error('body')
        <div class="text-danger mb-2">
            {{ $message}}
        </div>
    @enderror
</div>
<button type="submit" class="btn btn-secondary rounded-0 mt-3">{{$button ?? 'Update'}}</button>