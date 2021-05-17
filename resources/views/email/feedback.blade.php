
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
										<font color="#FFFFFF">{{trans('email.hot_line')}} : 0868 486 885</font>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:20px;" bgcolor="ECECEC" height="60">
							<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td>
										<img src="{{$message->embed(asset('logo.png'))}}">
									</td>
									<td align="right">{{trans('email.ela')}}<br> {{trans('email.service')}}
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td style="padding:20px; padding-bottom: 0px" bgcolor="#ECECEC">
							<h2><strong>{{trans('email.feedback')}}</strong></h2>
							<hr>

							<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
								<tr>
									<td>
										<div>
											<p>{{trans('email.hello')}} {{ $name }}! {{trans('email.ph')}}</p><hr>
											<h4>{{trans('email.service')}}:</h4>
											<p>{{ $reply }}</p>
											<p>{{trans('email.tks')}}</p>
										</div>
									</td>
								</tr>
							</table>

						</td>
					</tr>
					<tr>
						<td style="padding:20px;" bgcolor="ECECEC" height="60">
							{{trans('email.ela')}}
							<br>
							{{trans('email.hot_line')}} : 0899 777 247 - 0868 486 885
						</td>
					</tr>
					<tr>
						<td style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;" height="40" bgcolor="3B88C8" align="center">
							<font color="#FFFFFF">{{trans('email.copy')}}
							</font>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
