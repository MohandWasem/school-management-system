<div>
    <div id='calendar-container' wire:ignore>
        <div id='calendar'></div>
      </div>
</div>

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>
    
    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data = @this.events;
            
            var calendar = new Calendar(calendarEl, {
                events: JSON.parse(data),
                dateClick(info)  {
                   var title = prompt('Enter Event Title');
                   var date = new Date(info.dateStr + 'T00:00:00');
                   if(title != null && title != ''){
                     calendar.addEvent({
                        title: title,
                        start: date,
                        allDay: true
                      });
                     var eventAdd = {title: title,start: date};
                     @this.addevent(eventAdd);
                     alert('تم اضافه الحدث بنجاح..');
                   } else {
                    alert('عنوان الحدث مطلوب');
                   }
                },
                editable: true,
                selectable: true,
                displayEventTime: false,
                droppable: true,
                drop: function(info) {
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                },
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
    
                // إضافة خيار حذف الحدث
                eventClick: function(info) {
                    if (confirm('هل أنت متأكد من أنك تريد حذف هذا الحدث؟')) {
                        info.event.remove();  // يحذف الحدث من الواجهة
    
                        // استدعاء Livewire لحذف الحدث من قاعدة البيانات
                        @this.deleteEvent(info.event.id);
                        alert('تم حذف الحدث بنجاح');
                    }
                },
    
                loading: function(isLoading) {
                    if (!isLoading) {
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
    
            calendar.render();
    
            @this.on('refreshCalendar', () => {
                calendar.refetchEvents()
            });
        });
    </script>
    
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush
