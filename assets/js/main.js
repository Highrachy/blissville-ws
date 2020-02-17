// For Yamm
// $(document).on('click', '.yamm .dropdown-menu', function(e) {
//   e.stopPropagation()
// });
if ($.isFunction($.fn.fancybox)){
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect  : 'none',
            closeEffect : 'none'
        });
    });
}
// For the Navigation
$(document).ready(function(){
    //Get the navigation class
    var nav = $('.navbar-fixed-top');
    // Distance when website is refreshed at other places
    var distance = nav.offset();

    if (distance.top >= 300){
        // Hide the topbar
        $('.topBar').slideUp('slow');
    }

    $(window).scroll(function(){ // event fired when the website is scrolled

        // get the top most position of window when scrolled
        var scroll = $(window).scrollTop();

        // console.log(scroll);
        if (scroll >= 300) {
            // Hide topbar
            $('.topBar').slideUp('slow');
        } else {
            // Show topbar
            $('.topBar').slideDown('fast');
        }
    });
});

// Accordion
$('.collapse').on('show.bs.collapse', function () {
    var id = $(this).attr('id');
    $('a[href="#' + id + '"]').closest('.panel-heading').addClass('active-accordion');
    $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-minus"></i>');
});
$('.collapse').on('hide.bs.collapse', function () {
    var id = $(this).attr('id');
    $('a[href="#' + id + '"]').closest('.panel-heading').removeClass('active-accordion');
    $('a[href="#' + id + '"] .panel-title span').html('<i class="fa fa-plus"></i>');
});
$('.nav.navbar-nav a.inner-link').click(function () {
    $(this).parents('ul.navbar-nav').find('a.inner-link').removeClass('active');
    $(this).addClass('active');
    if ($('.navbar-header .navbar-toggle').is(':visible'))
        $(this).parents('.navbar-collapse').collapse('hide');
});

// Tooltip
$("a[title]").tooltip();

//FILE INPUT
$('.fileinput').fileinput();


$('.imageselect').imagepicker({show_label:true});




    
/********************************
Form Wizard
********************************/ 
if ($.isFunction($.fn.bootstrapWizard)){

    // Form wizard
    $(document).ready(function() {
        $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard .progress-bar').css({width:$percent+'%'});
        }});
    });
  
}

/********************************
DateTime Picker
********************************/
if( $.isFunction($.fn.datetimepicker) ){
    // $.fn.datepicker.defaults.format = "mm/dd/yyyy"; //create defaults
    $('#datetimepicker_date').datetimepicker({
         icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right"
         },
         format: 'MMMM DD, YYYY'
    });    
    $('#datetimepicker_time').datetimepicker({
         icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right"
         },
         format: 'LT'
    });

    $(function () {
        $('#datetimepicker12').datetimepicker({
                     icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            previous: "fa fa-chevron-left",
            next: "fa fa-chevron-right"
         }
        });
    });
}

// $(function(){

    $('.wow').css('opacity', '0');

//     // Animation of Promo under Slideshow
//     // $('.content h3').waypoint(function(){
//     //     $('.content h3,.content span').addClass('animated fadeInUp');
//     //     $('.promo a').addClass('animated fadeInRight');
//     // },{ offset: '95%'});

//     // $('.rent-property li').addClass('animation2');

//     // $('.rent-property li').waypoint(function(){
//     //     $(this.element).addClass('animated fadeInUp');
//     // },{ offset: '95%'});


// });
// 
jQuery(document).ready(function($){
    var $columns_number = $('#cd-table .cd-table-container').find('.cd-table-column').length;
    
    $('.cd-table-container').on('scroll', function(){ 
        $this = $(this);
        //hide the arrow on scrolling
        if( $this.scrollLeft() > 0 ) {
            $('.cd-scroll-right').hide();
        }
        //remove color gradient when table has scrolled to the end
        var total_table_width = parseInt($('.cd-table-wrapper').css('width').replace('px', '')),
            table_viewport = parseInt($('#cd-table').css('width').replace('px', ''));
            
        if( $this.scrollLeft() >= total_table_width - table_viewport - $columns_number) {
            $('#cd-table').addClass('table-end');
        } else {
            $('#cd-table').removeClass('table-end');
        }
    });

    //scroll the table (scroll value equal to column width) when clicking on the .cd-scroll-right arrow
    $('.cd-scroll-right').on('click', function(){
        $this= $(this);
        var column_width = $(this).siblings('.cd-table-container').find('.cd-table-column').eq(0).css('width').replace('px', ''),
            new_left_scroll = parseInt($('.cd-table-container').scrollLeft()) + parseInt(column_width);
        
        $('.cd-table-container').animate( {scrollLeft: new_left_scroll}, 200 );
        $this.hide();
    });
});