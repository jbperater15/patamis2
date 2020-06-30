<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Calendar Display</title>
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap-4.4.1-dist/css/bootstrap.min.css">

        <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/bootstrap/main.css' rel='stylesheet' />
        <link href='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/core/main.css' rel='stylesheet' />
        <link href='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/daygrid/main.css' rel='stylesheet' />
        <link href='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/timeGrid/main.css' rel='stylesheet' />
        <link href='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/list/main.css' rel='stylesheet' />
        
        <link href='<?php echo base_url() ?>/assets/modal_style.css' rel='stylesheet' />
        
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/bootstrap/main.js'></script>
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/core/main.js'></script>
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/daygrid/main.js'></script>
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/timeGrid/main.js'></script>
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/list/main.js'></script>
        <script src='<?php echo base_url() ?>/assets/fullcalendar-4.4.0/packages/interaction/main.js'></script>

        <script src='<?php echo base_url() ?>/assets/jQuery-3.4.1/jquery-3.4.1.slim.min.js'></script>
        <script src='<?php echo base_url() ?>/assets/Moment/moment-2.24.0.min.js'></script>
        <script src='<?php echo base_url() ?>/assets/bootstrap-4.4.1-dist/js/bootstrap.min.js'></script>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
             plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction', 'momentTimezone' ], // an array of strings!
             header: {
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek,agendaWeek custom1,',
              center: 'title',
              left: 'today,custom2 prev,next',
              selectable: true
            },

            eventSources: [

                // your event source
                {
                  url: '<?php echo base_url() ?>main_controller/load_event', // use the `url` property
                  textColor: 'white'  // an option!
                }

                // any other sources...

              ],        
             
             eventRender: function(info) {
                if (info.event.extendedProps.status === 'done') {

                  // Change background color of row
                  info.el.style.backgroundColor = 'red';

                  // Change color of dot marker
                  var dotEl = info.el.getElementsByClassName('fc-event-dot')[0];
                  if (dotEl) {
                    dotEl.style.backgroundColor = 'white';
                  }
                }
              },

               dateClick: function(info) {
                //alert('Date: ' + info.dateStr);
                console.log("gana"+ info.dateStr);
                $('#exampleModalCenter').modal();
                $('#evaluation_title').val(null);
                $('#sched_date').val(info.dateStr);
                 $('#time_start').val(null);
                $('#time_end').val(null);
                
              },

              eventClick: function(info) {
                //alert('Event: ' + info.event.title);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('View: ' + info.view.type);

                //  change the border color just for fun
                // info.el.style.borderColor = 'red';

                var dayDate = info.event.start.getDate().toString();
                var monthDate = info.event.start.getMonth() + 1;
                var yearDate = info.event.start.getFullYear().toString();
                if (dayDate < 10 ){
                    dayDate = "0" + dayDate;
                }
                if (monthDate < 10) {
                    var fullDate = yearDate +'-0'+ monthDate+'-'+ dayDate;
                }else{
                    var fullDate = yearDate +'-'+ monthDate+'-'+ dayDate;
                }
                
                console.log('Event: ' + info.event.title);
                console.log(info.event.id);
                console.log('Event: ' + info.event.start.currentStart);
                console.log('Event: ' + info.event.endTime);
                $('#eventModal').modal();
                $('#evaluation_id1').val(info.event.id);
                $('#evaluation_title1').val(info.event.title);
                $('#sched_date1').val(fullDate);
                $('#time_start1').val(new Date(info.event.start).toLocaleTimeString('en-GB'));
                $('#time_end1').val(new Date(info.event.end).toLocaleTimeString('en-GB'));
                document.getElementById("deleteLink").href="<?php echo base_url() ?>main_controller/delete_event?id="+info.event.id; 
                
              }

            });

            calendar.render();
          });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Calendar</h1>
                    <div id="calendar"></div>
                </div>
            </div>
            <div class="row">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                  Launch demo modal
                </button>
                <a href="<?php echo base_url() ?>main_controller/update_event"><button type="button" class="btn btn-primary" data-toggle="modal">
                  Launch demo link
                </button></a>
                  <a href="<?php echo base_url() ?>main_controller/gdrive"><button type="button" class="btn btn-primary" data-toggle="modal">
                  Gdrive
                </button></a>
                <a href="<?php echo base_url() ?>Gdrive"><button type="button" class="btn btn-primary" data-toggle="modal">
                  Google Drive v2
                </button></a>
                <a href="<?php echo base_url() ?>Gdrive/try"><button type="button" class="btn btn-primary" data-toggle="modal">
                  Google Drive v2
                </button></a>
            </div>
        </div>

        <!--Insert Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url() ?>main_controller/evaluation_schedule_insert" method="post" role='form'>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Title</label>
                        <div class="col-md-12 ui-front">
                            <input type="hidden" name="evaluation_id" id="evaluation_id" value="" required="">
                            <input type="text" class="form-control" name="evaluation_title" id="evaluation_title" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Date</label>
                        <div class="col-md-12 ui-front">
                            <input type="date" class="form-control" name="date" id="sched_date" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Time Start</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="time_start" id="time_start" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Time End</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="time_end" id="time_end" required="">
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Update Modal -->
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url() ?>main_controller/update_event" method="post" role='form'>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Title</label>
                        <div class="col-md-12 ui-front">
                            <input type="hidden" name="evaluation_id" id="evaluation_id1" value="" required="">
                            <input type="text" class="form-control" name="evaluation_title" id="evaluation_title1" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Date</label>
                        <div class="col-md-12 ui-front">
                            <input type="date" class="form-control" name="date" id="sched_date1" value="" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Time Start</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="time_start" id="time_start1" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="p-in" class="col-md-4 label-heading">Time End</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="time_end" id="time_end1" required="">
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteButton" data-toggle="modal" data-target="#myModal">Delete</button>
                <button type="submit" class="btn btn-info" id="updateButton">Update changes</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url() ?>main_controller/delete_event?id=" id="deleteLink"><button type="submit" class="btn btn-danger">Delete</button></a>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>              
                        <h4 class="modal-title">Are you sure?</h4>  
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>   
    </body>
    <script type="text/javascript">
        
    </script>
</html>