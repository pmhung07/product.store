<form class="form-horizontal" role="form" id="siteSettingsForm">
	<input type="hidden" name="siteID" id="siteID" value="{{ $data[0]['id'] }}">
	<div id="siteSettingsWrapper" class="siteSettingsWrapper">
		<div class="optionPane">
			<!-- {{ print_r($data) }} -->
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Sản phẩm</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="siteSettings_siteName" name="siteSettings_siteName" placeholder="Site name" value="{{ $data[0]['site_name'] }}">
				</div>
			</div>
			<div class="form-group">
				<label for="name" class="col-sm-3 control-label">Global CSS</label>
				<div class="col-sm-9">
					<textarea readonly class="form-control" id="siteSettings_siteCSS" name="siteSettings_siteCSS" placeholder="Global CSS" rows="">{{ $data[0]['global_css'] }}</textarea>
				</div>
			</div>
		</div><!-- /.optionPane -->
	</div><!-- /.siteSettingsWrapper -->
</form>