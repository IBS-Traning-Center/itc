$(document).ready(function () {
  $(".js-tracking-every").click(function () {
    ga(
      "send",
      "event",
      $(this).attr("data-type"),
      $(this).attr("data-action"),
      $(this).attr("data-name")
    );
    yaCounter23056159.reachGoal($(this).attr("data-action"));
    //pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
    return true;
  });
  hljs.initHighlightingOnLoad();
  $(
    '.js-tracking button, input[type="submit"].js-tracking, a.js-tracking, div.js-tracking'
  ).one("click", function () {
    ga(
      "send",
      "event",
      $(this).attr("data-type"),
      $(this).attr("data-action"),
      $(this).attr("data-name")
    );
    yaCounter23056159.reachGoal($(this).attr("data-action"));
    //pageTracker._trackEvent($(this).attr('data-type'), $(this).attr('data-action'), $(this).attr('data-name'));
    console.log(
      $(this).attr("data-type") +
        $(this).attr("data-action") +
        $(this).attr("data-name")
    );
    return true;
  });
  setInterval(checkRequest, 30100);
  function checkRequest() {
    /*$.getJSON( "/ajax/check-new-course.php", function( data ) {
			console.info(data);
			if (data.success=="Y") {
				$('.course-name-req-modal').text(data.course);
				$('.message-with-new-req').fadeIn();
				setTimeout("$('.message-with-new-req').fadeOut()", 5000);
			}
		})*/
  }
  if (location.pathname != "/orders-sap/") {
    $("table").each(function () {
      if ($(this).parent().hasClass("table-responsive")) {
      } else {
        $(this).wrap("<div class='table-responsive'></div>");
      }
    });
  }
  $(".close-menu").click(function () {
    $(".hidden-menu").hide();
  });
  $(".menu-item-svg").click(function () {
    $(".hidden-menu").show();
  });
  $("#subscribe-form").submit(function () {
    $.post("/ajax/subscribe.php", $("#subscribe-form").serialize()).done(
      function (data) {
        var obj = jQuery.parseJSON(data);
        if (obj.success == "Y") {
          $(".visible-form").css("display", "none");
          $(".hidden-form").css("display", "block");
        } else {
          alert("Этот email уже подписан на рассылку");
        }
      }
    );
    return false;
  });

  $('input[type="checkbox"]:not(".no_redraw")').styler();
  $('select:not(".no_redraw")').styler();

  $(".scroll").click(function () {
    var body = $("html, body");
    var target = $($(this).attr("href"));
    var top = target.offset().top;
    body.stop().animate({ scrollTop: top }, 300, "swing");
    return false;
  });
  $(".plus-round").click(function () {
    $(".sign-in.small.scroll").trigger("click");
    $('select[name="PROPERTY[313][0]"]')
      .val("0")
      .trigger("refresh")
      .trigger("change");
    return false;
  });
  $(".icon-click").click(function () {
    if ($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
    } else {
      $(this).parent().addClass("open");
    }
    return false;
  });

  $(".fancy").fancybox();
  $(".contact-header .city-select ul a").click(function () {
    if ($(".map_" + $(this).data("id")).length > 0) {
      $(".location-tab").removeClass("active");
      $(".map_" + $(this).data("id")).addClass("active");
    }
    //var map=BX("BX_GMAP_gm_"+$(this).data("id"));
    //google.maps.event.trigger(map, 'resize');
    $(".contact-header .city-select .title").html(
      $(this).text() + ' <i class="fa fa-caret-down" aria-hidden="true"></i>'
    );
  });
  $(".main-filter-container .main-filter ul a").click(function () {
    $(".main-filter-container .main-filter .title").html(
      $(this).text() + ' <i class="fa fa-caret-down" aria-hidden="true"></i>'
    );
  });
  $(".timetable-inn-header .city-select ul a").click(function () {
    if ($("#city_" + $(this).data("id")).length > 0) {
      $(".timetable-inn-list").removeClass("active");
      $(".timetable-inn-list-1").removeClass("active");
      $("#city_" + $(this).data("id")).addClass("active");
      $(".timetable-inn-header .other-cities").removeClass("active");
    } else {
      $(".timetable-inn-list").removeClass("active");
      $(".timetable-inn-list-1").removeClass("active");
      $(".timetable-inn-list.empty-list").addClass("active");
      $(".timetable-inn-header .other-cities").removeClass("active");
    }
    $(".timetable-inn-header .city-select .title").html(
      $(this).text() + ' <i class="fa fa-caret-down" aria-hidden="true"></i>'
    );
  });
  $(".timetable-inn-header .other-cities").click(function () {
    $(".timetable-inn-list").removeClass("active");
    $(".timetable-inn-list-1.all-city-list").addClass("active");
    $(this).addClass("active");
    return false;
  });
  $("a.collipse-link").click(function () {
    if ($(this).hasClass("open")) {
      $(this).parent().find(".hidden-by-link").removeClass("show");
      $(this).removeClass("open");
    } else {
      $(this).parent().find(".hidden-by-link").addClass("show");
      $(this).addClass("open");
    }
    return false;
  });
  $(".category-picker ul a").click(function () {
    var id = $(this).data("id");
    if ($('#filter input[value="' + id + '"]').prop("checked")) {
      $('#filter input[value="' + id + '"]').prop("checked", false);
    } else {
      $('#filter input[value="' + id + '"]').prop("checked", true);
    }
    if ($(window).width() > "1023") {
      $("#filter").submit();
    }
  });
  $(".timetable-filter-type-submit").click(function () {
    $("#filter").submit();
  });

  $(".timetable-filter-type-btn").click(function () {
    $(".timetable-filter-type-wrap").show();
    $(".timetable-filter-type-shadow").show();
  });
  $(".timetable-filter-type-submit, .timetable-filter-type-shadow").click(
    function () {
      $(".timetable-filter-type-wrap").hide();
      $(".timetable-filter-type-shadow").hide();
    }
  );
  $(".languages-picker ul a").click(function () {
    var id = $(this).data("id");
    $('#filter input[value="' + id + '"]').prop("checked", true);
    $("#filter").submit();
  });
  $(".cities-picker ul a").click(function () {
    var id = $(this).data("id");
    $('#filter input[value="' + id + '"]').prop("checked", true);
    $("#filter").submit();
  });
  $(".selected-items a.delete-cat").click(function () {
    var id = $(this).data("id");
    $('#filter input[value="' + id + '"]').prop("checked", false);
    $("#filter").submit();
  });
  $(".city-select .title, .simple-select .title").click(function () {
    if ($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
    } else {
      $(this).parent().addClass("open");
    }
    return false;
  });
  $(".main-filter .title").click(function () {
    if ($(this).parent().hasClass("open")) {
      $(this).parent().removeClass("open");
    } else {
      $(this).parent().addClass("open");
    }
    return false;
  });
  $(".trainer-changer.button").click(function () {
    $(".trainer-changer").removeClass("active");
    $(this).addClass("active");
    $(".training-slider-inner").removeClass("active");
    $(".trainer-list-" + $(this).data("open")).addClass("active");
    $(".training-slider-inner").slick("reinit");
    return false;
  });
  $("body").click(function () {
    $(".city-select, .main-filter, .simple-select").removeClass("open");
    $(".lang-selector").removeClass("show");
    $(".mask").fadeOut();
  });
  $(".menu-switcher").click(function () {
    parenting = $(this).parents(".menu-small-wrap");
    if (parenting.hasClass("shown")) {
      parenting.removeClass("shown");
    } else {
      parenting.addClass("shown");
    }
    return false;
  });
  if ($(".scroll-menu-shadow").length > 0) {
    stickyNavInit();
  }
  $(".open-link a").click(function () {
    $(this).parents(".trainer-content").addClass("open");
    return false;
  });
  $(".training-slider-inner").slick({ infinite: false });
  $(".client-slider .items").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1170,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 950,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 750,
        settings: {
          slidesToShow: 3,
          arrows: false,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          arrows: false,
        },
      },
    ],
  });
  $(".success-story-list").slick({
    autoplay: true,
    autoplaySpeed: 5000,
    slidesToShow: 6,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1170,
        settings: {
          slidesToShow: 4,
        },
      },
      {
        breakpoint: 950,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 750,
        settings: {
          slidesToShow: 3,
          arrows: false,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          arrows: false,
        },
      },
    ],
  });
  $(".timetable-inn-list").slick({
    variableWidth: true,
    infinite: false,
    arrows: false,
  });
  $(".photo-slider").slick({
    variableWidth: true,
    infinite: false,
    arrows: false,
  });
  $(function () {
    $(".masonry").masonry({
      // options
      itemSelector: ".testimonal-item",
    });
  });
  if ($(".scroll-menu-shadow").length > 0) {
    $(window).scroll(function () {
      scrollTop = $(window).scrollTop() + $(".header").height();
      scrollMenu = parseInt($(".height-inner").offset().top);
      if (scrollTop > scrollMenu) {
        $(".scroll-menu-shadow").addClass("fixed");
        $(".height-inner").height($(".scroll-menu-shadow").height());
      } else {
        $(".scroll-menu-shadow").removeClass("fixed");
        $(".height-inner").css("height", "auto");
      }
    });
  }
  $(".lang-selector .trigger-show").click(function () {
    if ($(this).parent().hasClass("show")) {
      $(this).parent().removeClass("show");
    } else {
      $(this).parent().addClass("show");
    }
    return false;
  });

  $(document).on("click", ".filter-item > a", function () {
    var courses = $(".course-item").show();
    var sections = $(".section-item").show();
    var sections = $(".section-item").addClass("open");
    var courses_lists = $(".courses-list").removeClass("hidden");
    var courses_lists = $(".section-items-list").removeClass("hidden");
    var courses_icons = $(".section-click").addClass("uncover");

    var filter_text = this.text.toLowerCase();

    if (filter_text != "все") {
      // filtered courses
      var filtered_items = courses
        .filter(function (index) {
          return !this.dataset.level.includes(filter_text);
        })
        .hide();

      // filtered sections
      var sections_filtered = sections
        .filter(function () {
          var c1 = $(this).find(".course-item");
          var c2 = $(c1).filter(":visible");
          var c3 = c2.length == 0;
          return c3;
        })
        .removeClass("open")
        .hide();
    }
  });

  $(".requisites__nav-item").click(function () {
    if (!$(this).hasClass("_active")) {
      $(this).addClass("_active").siblings().removeClass("_active");

      var index = $(this).index();

      $(".requisites__tab")
        .eq(index)
        .addClass("_active")
        .siblings()
        .removeClass("_active");
    }
  });

  setTimeout(function () {
    fn_bind_change();
  }, 300);
  $('[name="form-rassylka"] #search_field').autocomplete({
    source: function (request, response) {
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "search.php?type=" + $(".choose").val(),
        data: {
          maxRows: 12, // показать первые 12 результатов
          nameStartsWith: request.term, // поисковая фраза
        },
        success: function (data) {
          response(
            $.map(data, function (item) {
              return {
                id: item.id, // ссылка на страницу товара
                label: item.title_ru, // наименование товара
              };
            })
          );
        },
      });
    },
    select: function (event, ui) {
      // по выбору - перейти на страницу товара
      // Вы можете делать вывод результата на экран
      $(".email-list").val("");
      ID = ui.item.id;
      $(".selectedid").val(ID);
      $.getJSON("maills.php?id=" + ID, function (data) {
        $(".email-list").val(data.title);
      });
      //return false;
    },
    minLength: 3, // начинать поиск с трех символов
  });

  function fn_bind_change() {
    $(".type").change(function () {
      $.get("visual.php?id=" + $(".type").val(), function (data) {
        $(".change").html(data);
      });
      $("#search_field").val("");
    });
  }

  //$(".client-slider.vid").scrollable({next: '.next-client.vid', prev: '.prev-client.vid', circular: false});
  //$('.video-play').fancybox({'type': 'iframe', "allowfullscreen": "true", "width": 900, "height": 620});

  let mobileCookieShowBtn = document.querySelector(".show-mobile-full");
  let mobileCookieText = document.querySelector(".cookie-text");

  if (mobileCookieShowBtn && mobileCookieText) {
    mobileCookieShowBtn.addEventListener("click", () => {
      if (mobileCookieShowBtn.classList.contains("show")) {
        mobileCookieShowBtn.classList.remove("show");
        mobileCookieText.classList.remove("show");
      } else {
        mobileCookieShowBtn.classList.add("show");
        mobileCookieText.classList.add("show");
      }
    });
  }

  const headerInput = document.querySelector(".search-header-block input");
  const hiddenSearchBlock = document.querySelector(".search-hidden-block");
  const closeSearchBlock = document.querySelector(".close-search-block");
  const searchInput = document.getElementById("search-text");
  const resetInputSearchBtn = document.getElementById("search-reset");
  const searchCatalogInput = document.getElementById("search-catalog");

  if (headerInput && hiddenSearchBlock && closeSearchBlock) {
    closeSearchBlock.addEventListener("click", () => {
      hiddenSearchBlock.style.display = "none";
    });

    headerInput.addEventListener("focus", () => {
      hiddenSearchBlock.style.display = "block";

      if (searchInput) {
        searchInput.focus();
      }
    });
  }

  if (searchInput && resetInputSearchBtn) {
    searchInput.addEventListener("keypress", () => {
      if (searchInput.value === "") {
        resetInputSearchBtn.style.display = "none";
      } else {
        resetInputSearchBtn.style.display = "block";
      }
    });

    resetInputSearchBtn.addEventListener("click", () => {
      resetInputSearchBtn.style.display = "none";
    });
  }
});

function stickyNavInit() {
  var stickyOffset = $(".scroll-menu-shadow").outerHeight();
  $(
    ".sticky-nav li a[href^='#'], .sticky-nav a.sign-in,.sticky-nav .dropdown a"
  ).on("click", function (e) {
    var hash = this.hash;
    var that = $(this);
    $(".simple-select").removeClass("open");
    $("html, body").animate(
      {
        scrollTop: parseInt($(hash).offset().top) - stickyOffset - 40,
      },
      300,
      "linear",
      function () {
        setTimeout(function () {
          $(".sticky-nav li").removeClass("active");
          that.parent().addClass("active");
        }, 100);
      }
    );
    return false;
  });

  if (!$(".sticky-nav").hasClass("static-links")) {
    $(window).scroll(function () {
      setTimeout(function () {
        $(".sticky-nav li").removeClass("active");
      }, 20);
    });
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('subscriptionForm');
  const policyCheckbox = document.getElementById('policy_checkbox');
  const termsCheckbox = document.getElementById('terms_checkbox');
  const policySelect = document.getElementById('recipient_recipient_values_attributes_576784_value');
  const termsSelect = document.getElementById('recipient_recipient_values_attributes_576785_value');
  const emailInput = document.getElementById('recipient_email');
  const emailError = document.getElementById('email-error');
  const policyError = document.getElementById('policy-error');
  const termsError = document.getElementById('terms-error');
  
  // Обновление скрытых селектов при изменении чекбоксов
  policyCheckbox.addEventListener('change', function() {
    console.log(1);
      policySelect.value = this.checked ? 'true' : 'false';
      policyError.style.display = this.checked ? 'none' : 'block';
  });

  termsCheckbox.addEventListener('change', function() {
    console.log(2);
      termsSelect.value = this.checked ? 'true' : 'false';
      termsError.style.display = this.checked ? 'none' : 'block';
  });

  // Валидация email
  emailInput.addEventListener('input', function() {
      const email = this.value;
      const isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      
      if (email && !isValid) {
          emailError.style.display = 'block';
          this.style.borderColor = '#ff3366';
      } else {
          emailError.style.display = 'none';
          this.style.borderColor = '#333333';
      }
  });

  // Валидация формы перед отправкой
  form.addEventListener('submit', function(e) {
      let isValid = true;
      
      // Проверка email
      const email = emailInput.value;
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!email || !emailRegex.test(email)) {
          emailError.style.display = 'block';
          emailInput.style.borderColor = '#ff3366';
          isValid = false;
      } else {
          emailError.style.display = 'none';
          emailInput.style.borderColor = '#333333';
      }
      
      // Проверка чекбоксов
      if (!policyCheckbox.checked) {
          policyError.style.display = 'block';
          policyCheckbox.nextElementSibling.style.borderColor = '#ff3366';
          isValid = false;
      } else {
          policyError.style.display = 'none';
          policyCheckbox.nextElementSibling.style.borderColor = '#4F72B1';
      }
      
      if (!termsCheckbox.checked) {
          termsError.style.display = 'block';
          termsCheckbox.nextElementSibling.style.borderColor = '#ff3366';
          isValid = false;
      } else {
          termsError.style.display = 'none';
          termsCheckbox.nextElementSibling.style.borderColor = '#4F72B1';
      }
      
      if (!isValid) {
          e.preventDefault();
          // Прокрутка к первой ошибке
          const firstError = document.querySelector('.error-message[style*="display: block"]');
          if (firstError) {
              firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
          }
      } else {
          // Показать сообщение об успехе перед отправкой
          alert('Спасибо за подписку! Проверьте вашу почту для подтверждения.');
      }
  });
});