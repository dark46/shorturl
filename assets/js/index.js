$(document).ready(function() {

    year = new Date().getFullYear();

    for (var i = year; i <= year+2; i++) {
        $("#year").append(new Option(i, i));
    }
    
    var monthNames = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь",
      "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"
    ];

    d = new Date();

    $("#month").html(''); 
    for (var i = d.getMonth(); i <= 11; i++) {
        $("#month").append(new Option(monthNames[i], i+1));
    }
        

    var daysInMonth = new Date(year, d.getMonth(), 0).getDate();
            
    $("#day").html(''); 
    for (var i = d.getDate(); i <= daysInMonth; i++) {
        $("#day").append(new Option(i, i));
    }

    $(document).on('change', '#month',function() {

        var month = this.value;
        var daysInMonth = new Date($("#year").val(), this.value, 0).getDate();

        $("#day").html(''); 

        var selectedYear = $("#year").val(); 

        if(year==selectedYear && this.value==d.getMonth()+1) {
            var dayFrom = d.getDate();
        } else {
            var dayFrom = 1;
        }
        for (var i = dayFrom; i <= daysInMonth; i++) {
            $("#day").append(new Option(i, i));
        }

    });


    $(document).on('change', '#year',function() {       

        if(this.value==year) {
            var monthFrom = d.getMonth();
            var dayFrom = d.getDate();
        } else {
            var monthFrom = 0;
            var dayFrom = 1;
        }

        $("#month").html(''); 
        for (var i = monthFrom; i <= 11; i++) {
            $("#month").append(new Option(monthNames[i], i+1));
        }
                
        var daysInMonth = new Date(this.value, 0, 0).getDate();

        $("#day").html(''); 
        for (var i = dayFrom; i <= daysInMonth; i++) {
            $("#day").append(new Option(i, i));
        }
     
    });

    $(document).on('click', '#showExpiredDate',function() {
        $("#expiredDate").fadeIn();
        $("#useExpiredDate").val(1);
    });

    $(document).on('click', '#showCustomShortUrl',function() {
        $("#customShortUrl").fadeIn();
    });



    $("#shortUrlForm").submit(function(e) {

        var params = $(this).serializeArray();

        $.ajax({
            url : '/createShortUrl?' + '&noCache=' + (new Date().getTime()) + Math.random() ,
            dataType: "json",
            data : params,
        }).done(function (data) {
            if(data.success==true) {
                $("#short_url").css('visibility','visible');
                $("#shortUrlForm").remove();                
                $("#short_url_link").html(data.short_url);
                $("#stat_link").html(data.stat_url);
                $("#short_url_link").attr('href',data.short_url);
                $("#stat_link").attr('href',data.stat_url);
                $("#copy_to_clipboard").css('height','30px');
                $("#short_url div").css('height','50px');
                $("#error").html('');              
            } else {
                $("#short_url").fadeIn();
                $("#error").html(data.error);
            }
        }).fail(function () {
            alert('Unknown error.');
        });

        e.preventDefault(); //STOP default action
        e.unbind(); //unbind. to stop multiple form submit.
    });

    $("#copy_to_clipboard").on("click", clip);
});

function clip( e ) {
    e.preventDefault();
    var cont = $('#short_url_link').text(), // Or use a custom source Element
        $txa = $("<textarea />",{val:cont,css:{position:"fixed"}}).appendTo("body").select(),
        $msg = $("#clip-popup");
    if (document.execCommand('copy')) $msg.show().delay(1500).fadeOut(); // CH, FF, Edge, IE
    else prompt("Copy to clipboard:\nSelect, Cmd+C, Enter", cont); // Saf, Other
    $txa.remove();
}

