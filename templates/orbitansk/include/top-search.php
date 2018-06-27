<form name="arrFilter_form" action="/catalog/?arrFilter_ff%5BNAME%5D=475-084&amp;arrFilter_pf%5BCML2_ARTICLE%5D=475-084&amp;set_filter=Y" method="get">
	
    <div class="input-group catalog-nav__search">
        <input id="filter_inputtop" type="text" class="form-control" aria-label="..." value="" name="arrFilter_pf[CML2_ARTICLE]">
        <div class="input-group-btn">
            <div class="btn-group bootstrap-select" style="width: 100%;">

			<div class="dropdown-menu open" role="combobox">
					</div>
			<select id="filter_select2" class="selectpicker" tabindex="-98" onchange="$('#filter_inputtop').attr('name',$(this).val())">
                <option value="arrFilter_pf[CML2_ARTICLE]">Поиск по артикулу</option>
                <option value="arrFilter_ff[NAME]">Поиск по названию</option>
			</select>
			</div>
		</div><!-- /btn-group -->
        <span class="input-group-btn">
			<button name="set_filter" class="btn btn-input" type="submit">
				<svg class="catalog-nav__btn icons icon-search">
					<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/bitrix/templates/orbitansk/images/sprite.svg#search"></use>
				</svg>
			</button>
		</span>
	</div><!-- /input-group -->
    <input type="hidden" name="set_filter" value="Y">&nbsp;&nbsp;
</form>