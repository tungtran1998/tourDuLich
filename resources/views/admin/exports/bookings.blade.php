<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Booking Code</th>
        <th>Transaction Date</th>
        <th>Check in date</th>
        <th>Check out date</th>
        <th>Adult (people)</th>
        <th>Kid (people)</th>
        <th>Payment</th>
        <th>Fullname</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Note</th>
        <th>User Name</th>
        <th>Updated at</th>
        <th>Status</th>
        <th>Is deleted</th>
        <th>Total Amount (VND)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bookings as $bookings)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <td>{{ $bookings->booking_code }}</td>
            <td>{{ $bookings->transaction_date }}</td>
            <td>{{ $bookings->check_in_date }}</td>
            <td>{{ $bookings->check_out_date }}</td>
            <td>{{ $bookings->adult }}</td>
            <td>{{ $bookings->kid }}</td>
            <td>
                @if($bookings->payment == 0)
                Pay at the hotel
                @elseif($bookings->payment == 1)
                Online payment(VNPay)
                @endif
            </td>
            <td>{{ $bookings->fullname }}</td>
            <td>{{ $bookings->phone }}</td>
            <td>{{ $bookings->email }}</td>
            <td>{{ $bookings->message }}</td>
            <td>{{ $bookings->users->username }}</td>
            <td>{{ $bookings->updated_at }}</td>
            <td>
                @if($bookings->status == 0)
                    Unconfirm
                @elseif($bookings->status == 1)
                    Cofirmed
                @elseif($bookings->status == 2)
                    Check-in
                @elseif($bookings->status == 3)
                    Check-out
                @endif
            </td>
            <td>{{ ($bookings->isdeleted==0) ? 'Active' : 'Deleted' }}</td>
            <td>{{number_format($bookings->total_amount) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>