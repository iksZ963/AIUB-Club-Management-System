/**
 * Bootstrap based calendar full view.
 *
 * https://github.com/Serhioromano/bootstrap-calendar
 *
 * User: Sergey Romanov <serg4172@mail.ru>
 */
"use strict";

Date.prototype.getWeek = function(iso8601) {
	if (iso8601) {
		var target = new Date(this.valueOf());
		var dayNr  = (this.getDay() + 6) % 7;
		target.setDate(target.getDate() - dayNr + 3);
		var firstThursday = target.valueOf();
		target.setMonth(0, 1);
		if (target.getDay() != 4) {
			target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7);
		}
		return 1 + Math.ceil((firstThursday - target) / 604800000); // 604800000 = 7 * 24 * 3600 * 1000
	} else {
		var onejan = new Date(this.getFullYear(), 0, 1);
		return Math.ceil((((this.getTime() - onejan.getTime()) / 86400000) + onejan.getDay() + 1) / 7);
	}
};
Date.prototype.getMonthFormatted = function() {
	var month = this.getMonth() + 1;
	return month < 10 ? '0' + month : month;
};
Date.prototype.getDateFormatted = function() {
	var date = this.getDate();
	return date < 10 ? '0' + date : date;
};

if(!String.prototype.format) {
	String.prototype.format = function() {
		var args = arguments;
		return this.replace(/{(\d+)}/g, function(match, number) {
			return typeof args[number] != 'undefined' ? args[number] : match;
		});
	};
}
if(!String.prototype.formatNum) {
	String.prototype.formatNum = function(decimal) {
		var r = "" + this;
		while(r.length < decimal)
			r = "0" + r;
		return r;
	};
}

(function($) {
	"use strict";
	var options = {
		events_source: 'event.php',
		view: 'month',
		tmpl_path: 'tmpls/',
		tmpl_cache: false,
		day: '2018-02-28',
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');
			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('' + val.title + '')
					.appendTo(list);
			});
		},
		onAfterViewLoad: function(view) {
			$('.page-header h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};
	var calendar = $('#showEventCalendar').calendar(options);
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});
	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});
	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});
	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});
	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#format-12-hours').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({format12: val});
		calendar.view();
	});
	$('#show_wbn').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({display_week_numbers: val});
		calendar.view();
	});
	$('#show_wb').change(function(){
		var val = $(this).is(':checked') ? true : false;
		calendar.setOptions({weekbox: val});
		calendar.view();
	});
}(jQuery));


