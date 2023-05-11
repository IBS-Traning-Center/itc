function _initGrid() {
	if (window.location.search.indexOf("columns") == -1) {
        return;
    }
    document.write('<style type="text/css"> .row_ { position: fixed; '+
            'z-index: 999; left: 0; display: block; width: 100%;' +
            'border-top: 1px dashed; }' +
            '* html .row_ {position: absolute; }');
    document.write('.column_ { position: fixed; '+
            'z-index: 999; top: 0; display: block; height: 100%;' +
            'border-right: 1px dashed; }' +
            '* html .column_ {position: absolute; } </style>');
}

function _columns(a, unit, color) {
    for (var i = 0, l = a.length; i < l; i++) {
    	if (a[i][1] == null)
    	{
    		a[i][1] = 0;
    	}
    	if (unit == null)
    	{
    		unit = '%';
    	}
    	if (color == null)
    	{
    		color = '#4affff';
    	}
        document.write('<span class="column_" style="left: ' + a[i][0] + unit + '; margin-left: ' + a[i][1]+ 'px; border-color: ' + color + ';"></span>');
    }
}

function _rows(a, unit, color) {
    for (var i = 0, l = a.length; i < l; i++) {
    	if (a[i][1] == null)
    	{
    		a[i][1] = 0;
    	}
    	if (unit == null)
    	{
    		unit = '%';
    	}
    	if (color == null)
    	{
    		color = '#4affff';
    	}
        document.write('<span class="row_" style="top: ' + a[i][0] + unit + '; margin-top: ' + a[i][1]+ 'px; border-color: ' + color + ';"></span>');
    }
}

_initGrid();

_columns([[51], [178], [225], [491]], 'px', 'red');
_columns([[440]], 'px', '#f2a997');
_rows([[43], [109], [149]], 'px', 'red')
_rows([[55], [72], [82], [106]], 'px', '#f2a997');

_columns([[10], [90]], '%', 'blue');
_rows([[160], [663]], 'px', 'blue');

_rows([[192], [211], [246], [266], [301]], 'px', '#b5b5fa');