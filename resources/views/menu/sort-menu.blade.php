@extends('layout.main')

@section('title', 'Menu Management')
 
@section('container')

    <h3 class="mb-4">Mengatur Urutan Menu</h3>

    {{-- validasi --}}
    @if (session('status'))
        <div class="flash-data" data-flashdata="{{ session('status') }}"></div>
    @endif
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    {{-- <th>Icon</th> --}}
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                @foreach($menus as $task)
                                    <tr class="row1" data-id="{{ $task->id }}">
                                        <td>
                                            <div style="color:rgb(124,77,255); text-align:center; font-size: 20px; cursor: pointer;" title="change display order">
                                                <i class="fa fa-fw fa-grip-lines"></i>
                                                {{-- <i class="fa fa-ellipsis-v"></i> --}}
                                            </div>
                                        </td>
                                        <td>{{ $task->title }}</td>
                                        {{-- <td>{{ $task->icon }}</td> --}}
                                        {{-- <td>{{ ($task->status == 1)? "Completed" : "Not Completed" }}</td> --}}
                                        <td>{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>                  
                        </table>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    
    <hr>
    <span>Drag and Drop the table rows and <button class="btn btn-warning btn-sm" onclick="window.location.reload()">REFRESH</button></span>

@endsection

 
