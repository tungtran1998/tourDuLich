
<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse" bgcolor="4C4E4E">
	<tr>
		<td style="padding:30px;">
			<div align="center">
				<table border="0" width="600" cellpadding="0" style="border-collapse: collapse" bgcolor="4C4E4E">
					<tr>
						<td style="border-top-left-radius: 8px; border-top-right-radius: 8px;" height="40" bgcolor="3B88C8">
							<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td style="padding-left: 10px;">
										<font color="#FFFFFF">{{Carbon\Carbon::now()->format('H:i:s | d/m/Y')}}</font>
									</td>
									<td style="padding-right: 20px;" align="right">
										<font color="#FFFFFF">{{trans('allclient.25qaz')}}: 0868 486 885</font>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:20px;" bgcolor="ECECEC" height="60">
							<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td> <img src="{{$message->embed(asset('logo.png'))}}"></td>
									<td align="right">Đặt tour trực tuyến<br> {{trans('email.service')}}</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:20px; padding-bottom: 0px;" bgcolor="#ECECEC">
							<h2><strong>Thông tin đơn đặt Tour</strong></h2>
									<hr>
							<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td>
										<div>
											<h4>Mã tour : {{ $book_code }}</h4>
											<h4>Ngày đặt tour : {{date('H:i | d/m/Y',strtotime($transaction_date))}}</h4>
											<h4>{{ $tour_name }}</h4>
											<h4>Điểm xuất phát : {{ $departure_location }}</h4>
											<h4>Điểm đến : {{ $destination }}</h4>
											<h4>Số ngày: {{$number_of_day}}</h4>
											<h4>Giờ xuất phát: {{$departure_time}}</h4>
											<h4>Ngày xuất phát: {{$departure_date}}</h4>
											<h4>Ngày về: {{$return_date}}</h4>
											<h4>Phương tiện di chuyển: {{$vehicle}}</h4>
											<hr>
											<h3 style="color: red">Tổng tiền: {{ $total_amount }} VNĐ </h3>
										</div>
									</td>
									<td>
										<img style="display: block;margin-left: auto; margin-right: auto;" download src="{!!$message->embedData($png, 'QrCode.png', 'image/png')!!}">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:20px;" bgcolor="ECECEC" height="60">
							Đặt tour trực tuyến
							<br>
							{{trans('email.hot_line')}} : 0899 777 247 - 0868 486 886
						</td>
					</tr>
					<tr>
						<td style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;" height="40" bgcolor="3B88C8" align="center">
							<font color="#FFFFFF">Copyright ® 2010 – 2020 TMC. All Rights Tour.
							</font>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
