<nav class="mainnav mainnav-fix navbar navbar-inverse navbar-embossed navbar-fixed-top" role="navigation" id="mainNav">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
			<span class="sr-only">Toggle Navigation</span>
		</button>
		<a class="navbar-brand" href="">
			<b class='text-primary'>Logistics</b>System
		</a>
	</div>
	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		<ul class="nav navbar-nav">
			@if (isset($data['siteData']) || (isset($page) && $page == 'newPage'))
				@if (isset($data['siteData']))
				<li class="active">
					<a><span id="siteTitle">{{ $data['siteData']['site'][0]->site_name }}</span></a>
				</li>
				@endif
				@if (isset($page) && $page == 'newPage')
				<li class="active">
					<a><span id="siteTitle">My New Site</span> </a>
				</li>
				@endif
				@else
					<li class="{{ Request::path() ==  'dashboard' ? 'active' : ''  }}"><a href="{{ route('dashboard') }}"><span class="fui-windows"></span> Sites</a></li>
					<li class="{{ Request::path() ==  'assets' ? 'active' : ''  }}"><a href="{{ route('assets') }}"><span class="fui-image"></span> Image Library</a></li>
				@if (Auth::user()->type == 'admin')
					<li class="{{ Request::path() ==  'users' ? 'active' : ''  }}"><a href="{{ route('users') }}"><span class="fui-user"></span> Users</a></li>
					<li class="{{ Request::path() ==  'settings' ? 'active' : ''  }}"><a href="{{ route('settings') }}"><span class="fui-gear"></span> Settings</a></li>
				@endif
			@endif
		</ul>
		<ul class="nav navbar-nav navbar-right" style="margin-right: 20px;">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }} <b class="caret"></b></a>
				<span class="dropdown-arrow"></span>
			</li>
		</ul>
	</div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->