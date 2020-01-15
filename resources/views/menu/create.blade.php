@extends('layout.main')

@section('title', 'Tambah Menu')
    
@section('container')

    <h3>Tambah Menu</h3>

    <div class="row mt-3">
        <div class="col-lg-8">

            <form method="post" action="/menus">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Masukkan Title">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent ID</label>
                    <select id="parent_id" name="parent_id" class="custom-select @error('parent_id') is-invalid @enderror">
                        <option value="" selected>Pilih...</option>
                        <option value="0"># (Tidak ada)</option>
                        @php
                            $menu = DB::table('menus')->where('parent_id', '=', 0)->get();
                        @endphp
                        @foreach ($menu as $m)
                            <option {{ old('parent_id') == $m->id ? "selected" : "" }} value="{{ $m->id }}">{{ $m->title }}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Masukkan URL">
                    @error('url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group" id="icon-input">
                    <label for="icon">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" placeholder="Masukkan Icon">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>   

                @php
                   $menu_row = $menu->count();
                @endphp   
                <input type="hidden" name="order" value="{{ $menu_row+1 }}">
                
                <div class="form-group justify-content-end">
                    <a href="/menus" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>     
            </form>
        </div>
    </div>


@endsection