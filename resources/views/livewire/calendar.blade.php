<div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var calendarEl = document.getElementById('calendar');
                var calendar = new Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    events: JSON.parse(@this.events),
                    dateClick(info) {
                        var title = prompt('Enter Event Title');
                        var date = new Date(info.dateStr + 'T00:00:00');
                        if (title) {
                            calendar.addEvent({
                                title: title,
                                start: date,
                                allDay: true
                            });
                            var eventAdd = {title: title, start: date};
                            @this.call('addevent', eventAdd);
                        }
                    }
                });
                calendar.render();
                
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    @endpush
</div>







