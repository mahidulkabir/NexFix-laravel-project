@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2>All Users</h2>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Role</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->phone }}</td>
          <td><span class="badge bg-info text-dark">{{ ucfirst($user->role) }}</span></td>
          <td>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this user?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center">No users found.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
