<div class="col-xs-12 col-sm-2 col-md-2 dashboard-nav">
	<ul class="nav nav-tabs nav-stacked text-center">
		<li class="account-management">
			<a href="{{route('profile.profileUser')}}">
				<span>
					<i class="fa fa-user"></i>
				</span>{{trans('allclient.Accountmanagement')}}
			</a>
		</li>

		<li class="change-password">
			<a href="{{route('profile.changePassword')}}">
				<span>
					<i class="fa fa-lock"></i>
				</span>{{trans('allclient.ChangePassword')}}
			</a>
		</li>

		<li class="manage-booking">
			<a href="{{route('profile.history')}}">
				<span>
					<i class="fa fa-briefcase"></i>
				</span>{{trans('allclient.Managebooking')}}
			</a>
		</li>
	</ul>
</div><!-- end columns -->