@extends('layouts.app')
@section('content')
    <h1>Clients</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Sent Date</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->sent_date }}</td>
                <td>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $clients->links() }}
@endsection
