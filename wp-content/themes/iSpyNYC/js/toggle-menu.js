jQuery(document).ready(function ($){
    var leftSidebarBtn = $('#left-sidebar-btn');
    var sidebar = $('#sidebar');
    var menuBtn = $('#menu-btn');
    var menuUl = $('#menu ul');

    function showSidebar() {
        leftSidebarBtn.css({
            'left':'172px',
            'background':'#d9dcdd'
        });
        leftSidebarBtn.attr('class', 'fa fa-times fa-2x');
        sidebar.removeClass("display-sidebar");
    }
    function hideSidebar() {
        leftSidebarBtn.css({
            'left':'0',
            'background':'#fff'
        });
        leftSidebarBtn.attr('class', 'fa fa-bars fa-2x');
        sidebar.addClass("display-sidebar");
    }

    leftSidebarBtn.on('click', function(event) {
        event.preventDefault();

        if( leftSidebarBtn.hasClass('fa fa-times fa-2x') ){
            hideSidebar();
        } else {
            showSidebar();
        }
    });

    function showMenu() {
        menuBtn.attr('class', 'fa fa-times');
        menuUl.removeClass('display-menu');

        leftSidebarBtn.css('top','233px');
        sidebar.css('top','228px');
    }

    function hideMenu() {
        menuBtn.attr('class', 'fa fa-bars');
        menuUl.addClass('display-menu');

        leftSidebarBtn.css('top','95px');
        sidebar.css('top','90px');
    }

    menuBtn.on('click', function(event) {
        event.preventDefault();

        if( menuBtn.hasClass('fa fa-times') ) {
            hideMenu();
        } else {
            showMenu();
        }

        if ( $(window).width > 480 ) {
            menuUl.show();

            leftSidebarBtn.css('top','95px');
            sidebar.css('top','90px');
        }
    });
});