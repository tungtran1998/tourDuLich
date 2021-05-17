<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Gender</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Street</th>
        <th>State</th>
        <th>City</th>
        <th>Nationality</th>
        <th>Date of birth</th>
        <th>Isdeleted</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ ($user->gender==0) ? 'Male' : 'Female' }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->street }}</td>
            <td>{{ $user->state }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->nationality }}</td>
            <td>{{ $user->dateofbirth }}</td>
            <td>{{ ($user->isdeleted==0) ? 'Active' : 'Deleted'}}</td>
            <td>{{ ($user->status == 0) ? 'Active' : 'Paused'}}</td>
            <td>{{ $user->created_at }}</td>
            <td>{{ $user->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>