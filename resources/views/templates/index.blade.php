@extends('layouts.app')
@section('content')
    <h1>Email Templates</h1>
    <a href="{{ route('templates.create') }}" class="btn btn-primary mb-3">Create Template</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Include Sent</th>
            <th>Count</th>
            <th>Actions</th>
            <th>Run</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($templates as $template)
            <tr>
                <td>{{ $template->id }}</td>
                <td>{{ $template->name }}</td>
                <td>{{ $template->include_sended ? 'Yes' : 'No' }}</td>
                <td>{{ $template->count }}</td>
                <td>
                    <a href="{{ route('templates.edit', $template) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('templates.destroy', $template) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('template.run', $template->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Run</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $templates->links() }}
@endsection
