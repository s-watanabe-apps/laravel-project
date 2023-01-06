<!-- Full Calendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            dayCellContent: function(e) {
                e.dayNumberText = e.dayNumberText.replace('日', '');
            },
            themeSystem: 'bootstrap',
            timeZone: 'UTC',
            initialView: 'dayGridMonth',
            businessHours: true,
            footerToolbar: {
                left: "dayGridMonth,listMonth",
                //center: "title",
                //right: "today prev,next"
            },
            buttonText: {
                today: '@lang('strings.fullcalendar.today')',
                month: '@lang('strings.fullcalendar.month')',
                list: '@lang('strings.fullcalendar.list')'
            },
            locale: '{{\App::getLocale()}}',
            height: "auto",
            contentHeight: 10,
            //events: '/api/events',
            editable: true,
            selectable: true
        });
        calendar.render();

        calendar.on('dateClick', function(info) {
            console.log('clicked on ' + info.dateStr);
        });

        $('.fc-next-button').on('click', function(){
            console.log('next');
        });

        $('.fc-prev-button').on('click', function(){
            console.log('prev');
        });
    });
</script>
