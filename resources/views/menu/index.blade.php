@extends('layout.main')

@section('title', 'Menu Management')
    
@section('container')

<h3>Menu Management</h3>
    
<!-- Button trigger modal -->
<a href="/menus/create" class="btn btn-primary my-3">Tambah Data Menu</a>
<a href="/menus/sort-menu" class="btn btn-success my-3">Atur</a>

{{-- validasi --}}
@if (session('status'))
    <div class="flash-data" data-flashdata="{{ session('status') }}">
      
    </div>
@endif

<div class="card shadow mb-4">
   <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" cellspacing="0">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Title</th>
                  <th scope="col">Id parent</th>
                  <th scope="col">Url</th>
                  <th scope="col">Icon</th>
                  <th scope="col">Active</th>
                  <th scope="col">Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($menus as $m)
                  <tr>
                     <td scope="row">{{ $loop->iteration }}</td>
                     <td>{{ $m->title }}</td>

                     @php
                        $sub = DB::table('menus')->where('id', '=', $m->parent_id)->get();
                     @endphp

                     <td>
                        @if ($m->parent_id == null)
                           #
                        @else
                           @foreach ($sub as $s)
                              {{ $s->title }}
                           @endforeach
                        @endif
                     </td>    
                     <td>
                        @if ($m->url == null) # @endif
                     </td>
                     <td>{{ $m->icon }}</td>
                     <td>{{ $m->is_active }}</td>
                     <td>
                        @if ($m->title != 'Menu Management') 
                           <a href="/menus/{{ $m->id }}/edit" class="badge badge-primary">Edit</a>
                           
                           <form action="/menus/{{ $m->id }}" method="post" class="d-inline">
                              @method('delete')
                              @csrf
                              <button type="button" class="badge badge-danger delete" data-id="{{ $m->id }}" data-name="{{ $m->title }}">Hapus</button>
                           </form>
                        @endif
                     </td>  
                  </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection


