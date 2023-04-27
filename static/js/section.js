
    $(document).ready(function(){
        var currentHash;
        currentHash = window.location.hash.slice(1);

        if (currentHash === 'methodology') {
            $("#tr_catalog ul li#cat_522").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_522 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_522 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_522', 800);
        }

        if (currentHash === 'test') {
            $("#tr_catalog ul li#cat_461").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_461 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_461 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_461', 800);
        }
        if (currentHash === 'pm') {
            $("#tr_catalog ul li#cat_530").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_530 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_530 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_530', 800);
        }
        if (currentHash === 'developer') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_482', 800);
        }
        if (currentHash === 'itservice') {
            $("#tr_catalog ul li#cat_520").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_520 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_520 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_520', 800);
        }
        if (currentHash === 'analytics') {
            $("#tr_catalog ul li#cat_448").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_448 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_448 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_448', 800);
        }
        if (currentHash === 'developer-java') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482").find('ul:first').show();
            $("#tr_catalog ul li#cat_526").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_526").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_526").find('ul:first').show();
            $.scrollTo('#tr_catalog ul li#cat_526', 800);
        }

        if (currentHash === 'developer-net') {
            $("#tr_catalog ul li#cat_482").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_482").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_482").find('ul:first').show();
            $("#tr_catalog ul li#cat_524").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_524").find('div.hitarea:first').removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_524").find('ul:first').show();
            $.scrollTo('#tr_catalog ul li#cat_524', 800);
        }

        if (currentHash === 'arch') {
            $("#tr_catalog ul li#cat_529").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_529 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_529 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_529', 800);
        }
        if (currentHash === 'admin') {
            $("#tr_catalog ul li#cat_509").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_509 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_509 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_509', 800);
        }
        if (currentHash === 'business') {
            $("#tr_catalog ul li#cat_584").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_584 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_584 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_584', 800);
        }
        if (currentHash === 'soft') {
            $("#tr_catalog ul li#cat_521").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_512 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_521 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_521', 800);
        }
        if (currentHash === 'exp') {
            $("#tr_catalog ul li#cat_533").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_533 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_533 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_533', 800);
        }
        if (currentHash === 'recrut') {
            $("#tr_catalog ul li#cat_590").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_590 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_590 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_590', 800);
        }
        if (currentHash === 'sec') {
            $("#tr_catalog ul li#cat_609").removeClass('expandable').addClass('collapsable');
            $("#tr_catalog ul li#cat_609 div.hitarea").removeClass('expandable-hitarea').addClass('collapsable-hitarea');
            $("#tr_catalog ul li#cat_609 ul").show();
            $.scrollTo('#tr_catalog ul li#cat_609', 800);
        }

        $(document).on('click', '.section-click', function() {
            var $this = $(this),
                $parent = $this.closest('.section-item');
            if ($parent.hasClass('open')) {
                $this.addClass('uncover');
                $parent.removeClass('open');
            } else {
                $this.removeClass('uncover');
                $parent.addClass('open');
            }
            var nextSectionNode = $(this).siblings('.section-items-list');
            if(nextSectionNode != null ) {
                if (nextSectionNode.hasClass('hidden')) {
                    nextSectionNode.removeClass('hidden');
                } else {
                    nextSectionNode.addClass('hidden');
                }
            }
            var nextCourseListNode = $(this).siblings('.courses-list');
            if(nextCourseListNode != null ) {
                if (nextCourseListNode.hasClass('hidden')) {
                    nextCourseListNode.removeClass('hidden');
                } else {
                    nextCourseListNode.addClass('hidden');
                }
            }
            return false;
        });
    });
