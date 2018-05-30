$(function () {
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar-place').fullCalendar({
        lang: 'fr',
        monthNames: ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre" ],
        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aou','Sept','Oct','Nov','Dec'],
        dayNames: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],

        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: "Aujourd'hui",
            month: 'Moins',
            week: 'Semaine',
            day: 'jour'
        },
        events:
            {
                url:Routing.generate('fullcalendar_loadevents', { month: moment().format('MM'), year: moment().format('YYYY') }),
                color: 'blue',
                textColor:'white',
                error: function() {
                    alert('Error receving events');
                }
            },
        viewRender: function (view, element) {
            var month = view.calendar.getDate().format('MM');
            var year = view.calendar.getDate().format('YYYY');
        },
        eventDrop: function(event,delta,revertFunc) {
            var newStartData = event.start.format('YYYY-MM-DD');
            var newEndData = (event.end == null) ? newStartData : event.end.format('YYYY-MM-DD');

            $.ajax({
                url: Routing.generate('fullcalendar_changedate'),
                data: { id: event.id, newStartData: newStartData,newEndData:newEndData  },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    console.log('ok');
                },
                error: function(e){
                    revertFunc();
                    alert('Error processing your request: '+e.responseText);
                }
            });

        },
        eventResize: function(event, delta, revertFunc) {

            var newData = event.end.format('YYYY-MM-DD');
            $.ajax({
                url: Routing.generate('fullcalendar_resizedate'),
                data: { id: event.id, newDate: newData },
                type: 'POST',
                dataType: 'json',
                success: function(response){
                    console.log('ok');
                },
                error: function(e){
                    revertFunc();
                    alert('Error processing your request: '+e.responseText);
                }
            });

        },
        eventClick: function(calEvent, jsEvent, view) {
            $('#modalTitle').html("<b>Matricule :</b>"+calEvent.title);
            $('#modalBody').html("<b>Num de Vol :</b>"+calEvent.NumVol+"<br>"+
                                 "<b>Date de Départ :</b>"+calEvent.start.format('DD-MM-YYYY LT')+"<br>"+
                                 "<b>Date d'arrivé:</b>"+calEvent.end.format('DD-MM-YYYY LT')+"<br>"+
                                 "<b>Escale départ :</b>"+calEvent.escaleDep+"<br>"+
                                 "<b>Escale d'Arrivé :</b>"+calEvent.escaleArrive);
            $('#eventUrl').attr('href','demande');
            $('#fullCalModal').modal();
        },
        editable: true

    });
});