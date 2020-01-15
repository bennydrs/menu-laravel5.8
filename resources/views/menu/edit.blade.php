@extends('layout.main')

@section('title', 'Edit Menu')
    
@section('container')

    <h3>Edit Menu</h3>

    <div class="row mt-3">
        <div class="col-lg-8">

            <form method="post" action="/menus/{{ $menu->id }}">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $menu->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent ID</label>
                    <select id="parent_id" name="parent_id" class="form-control">
                        <option selected value="0">#</option>
                        @php
                            $menus = DB::table('menus')->where('parent_id', '=', 0)->get();
                        @endphp

                        @foreach ($menus as $mn)
                            @if ($mn->id == $menu->parent_id)
                                <option value="{{ $mn->id }}" selected>{{ $mn->title }}</option>
                            @else
                                <option value="{{ $mn->id }}">{{ $mn->title }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ $menu->url }}">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="icon">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ $menu->icon }}">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" @if($menu->is_active == 1) checked @endif>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>     

                <div class="form-group justify-content-end">
                    <a href="/menus" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>     
            </form>
        </div>
    </div>


@endsection