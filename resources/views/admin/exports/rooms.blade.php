<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Description</th>
        <th>Room Code</th>
        <th>Room type</th>
        <th>Price (VND)</th>
        <th>Location</th>
        <th>Adult (people)</th>
        <th>Kid (people)</th>
        <th>Acreage (m2)</th>
        <th>Status</th>
        <th>Views</th>
        <th>Tags</th>
        <th>Services</th>
        <th>Created by</th>
        <th>Is Deleted</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rooms as $room)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <td>{{ $room->name }}</td>
            <td>{{ $room->description }}</td>
            <td>{{ $room->room_code }}</td>
            <td>{{ $room->roomtypes->name }}</td>
            <td>{{ number_format($room->price) }}</td>
            <td>{{ $room->location }}</td>
            <td>{{ $room->adult }}</td>
            <td>{{ $room->kid }}</td>
            <td>{{ $room->acreage }}</td>
            <td>{{ ($room->status==0) ? 'Display' : 'Not Display'}}</td>
            <td>{{ $room->views }}</td>
            <td>
                @foreach($room->tag as $key => $data)
                 {{ $data->tag_name }},
                @endforeach
            </td>
            <td>
                @foreach($room->service as $key => $data)
                {{ $data->name }},  
                @endforeach
            </td>
            <td>{{ $room->createByAdmin->name}}</td>
            <td>{{ ($room->isdeleted==0) ? 'Active' : 'Deleted' }}</td>
            <td>{{ $room->created_at }}</td>
            <td>{{ $room->updated_at }}</td>

        </tr>
    @endforeach
    </tbody>
</table>