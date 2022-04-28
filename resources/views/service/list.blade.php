<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Lists</h2><br>
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <div class="box-header with-border">
                        <a href="{{ route('service.create') }}"><button class="btn btn-success">Add New &nbsp;<i class="fa fa-plus"></i></button></a>
                    </div>

                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->title}}</td>
                                <td>@if($result->service_img)
                                    <img src="{{ asset('uploads/services/' . $result->service_img) }}" alt="{{ $result->name }}" width="200">
                                    @endif
                                </td>

                                <td>
                                    @if($result->is_active == 1)
                                    <small class="label bg-green">Active</small>
                                    @else
                                    <small class="label bg-red">Inactive</small>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('service.edit', $result->id) }}" title="Edit message"><button class="btn btn-primary btn-flat"><i class="fa fa-edit"></i></button></a>&nbsp;
                                    <a href="javascript:;" title="Delete service" class="delete-service" id="{{ $result->id }}"><button class="btn btn-danger btn-flat"><i class="fa fa-trash"></i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>