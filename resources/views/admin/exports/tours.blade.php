<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Tour code</th>
        <th>Count people</th>
        <th>Tour name</th>
        <th>Departure location</th>
        <th>Destination</th>
        <th>Province </th>
        <th>Price adult</th>
        <th>Price kid</th>
        <th>Single room price</th>
        <th>Tour detail</th>
        <th>Tour program</th>
        <th>Tour note</th>
        <th>Number of day</th>
        <th>Departure time</th>
        <th>Departure date</th>
        <th>Departure date</th>
        <th>Vehicle</th>
        <th>Discount</th>
        <th>Status</th>
        <th>Is Deleted</th>
        <th>Created by</th>
        <th>Updated by</th>
        <th>Created at</th>
        <th>Updated at</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tours as $tour)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <td>{{ $tour->tour_code }}</td>
            <td>{{ $tour->count_people }}</td>
            <td>{{ $tour->tour_name }}</td>
            <td>{{ $tour->departure_location }}</td>
            <td>{{ $tour->destination }}</td>
            <td>{{ $tour->provences->name }}</td>
            <td>{{number_format($tour->price_adult) }}</td>
            <td>{{number_format($tour->price_kid) }}</td>
            <td>{{number_format($tour->single_room_price) }}</td>
            <td>{{ $tour->tour_detail }}</td>
            <td>{{ $tour->tour_program }}</td>
            <td>{{ $tour->tour_note }}</td>
            <td>{{ $tour->number_of_day }}</td>
            <td>{{ $tour->departure_time }}</td>
            <td>{{ $tour->departure_date }}</td>
            <td>{{ $tour->return_date }}</td>
            <td>{{ $tour->vehicle }}</td>
            <td>{{ $tour->discount }}</td>
            <td>{{ ($tour->status == 0) ? 'Display' : 'Not display'}}</td>
            <td>{{ ($tour->isdeleted==0) ? 'Active' : 'Deleted'}}</td>
            <td>{{ $tour->createByAdmin->name }}</td>
            <td>{{ $tour->updateByAdmin->name }}</td>
            <td>{{ $tour->created_at }}</td>
            <td>{{ $tour->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>