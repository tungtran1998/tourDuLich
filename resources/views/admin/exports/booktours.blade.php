<table>
    <thead>
    <tr>
        <th>STT</th>
        <th>Book code</th>
        <th>Transaction date</th>
        <th>Status</th>
        <th>Adult</th>
        <th>Kid</th>
        <th>Total amount</th>
        <th>Payment</th>
        <th>Fullname</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Note</th>
        <th>Single room</th>
        <th>Single room price</th>
        <th>Price kid</th>
        <th>Price adult</th>
        <th>Discount</th>
        <th>Tour id</th>
        <th>User Name</th>
        <th>Updated at</th>

        <th>Is deleted</th>
    </tr>
    </thead>
    <tbody>
    @foreach($booktours as $booktour)
        <tr>
            <th>{{ $loop->index+1 }}</th>
            <td>{{ $booktour->booking_code }}</td>
            <td>{{ $booktour->transaction_date }}</td>
            <td>
                @if($booktour->status == 0)
                    Unconfirm
                @elseif($booktour->status == 1)
                    Cofirmed
                @elseif($booktour->status == 2)
                    Check-in
                @elseif($booktour->status == 3)
                    Check-out
                @endif
            </td>
            <td>{{ $booktour->adult }}</td>
            <td>{{ $booktour->kid }}</td>
            <td>{{number_format($booktour->total_amount) }}</td>
            <td>
                @if($booktour->payment == 0)
                Pay at the hotel
                @elseif($booktour->payment == 1)
                Online payment(VNPay)
                @endif
            </td>
            <td>{{ $booktour->fullname }}</td>
            <td>{{ $booktour->phone }}</td>
            <td>{{ $booktour->email }}</td>
            <td>{{ $booktour->message }}</td>
            <td>{{ $booktour->single_room }}</td>
            <td>{{number_format($booktour->single_room_price) }}</td>
            <td>{{number_format($booktour->price_kid) }}</td>
            
            <td>{{number_format($booktour->price_adult) }}</td>

            <td>{{ $booktour->discount }}</td>
            <td>{{ $booktour->tour_book->tour_name }}</td>
            <td>{{ $booktour->users->username }}</td>
            <td>{{ $booktour->updated_at }}</td>

            
            <td>{{ ($booktour->isdeleted==0) ? 'Active' : 'Deleted' }}</td>

        </tr>
    @endforeach
    </tbody>
</table>