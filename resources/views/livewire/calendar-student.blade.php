<div>
    {{-- <div>
        <div>
            <div id='calendar-container' wire:ignore>
                <div id='calendar'></div>
            </div>
        </div>
        @push('scripts')
            <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

            <script>
                document.addEventListener('livewire:load', function () {
                    var Calendar = FullCalendar.Calendar;
                    var Draggable = FullCalendar.Draggable;
                    var calendarEl = document.getElementById('calendar');
                    var checkbox = document.getElementById('drop-remove');
                    var data = @this.events;
                    var calendar = new Calendar(calendarEl, {
                        events: JSON.parse(data),
                    });
                    calendar.render();
                @this.on(`refreshCalendar`, () => {
                    calendar.refetchEvents()
                });
                });
            </script>
            <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet'/>
        @endpush
    </div> --}}
    <div>
        <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
            <thead>
                <tr class="table-info text-danger">
                    <th>#</th>
                    <th>{{ __('messages.teacher') }}</th>
                    <th>{{ __('messages.specialization') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teachers as $teacher)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $teacher->Name }}</td>
                        <td>{{ $teacher->specializations ? $teacher->specializations->Name : 'لا يوجد تخصص' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="alert-danger" colspan="3">لاتوجد بيانات</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <br><br><br>
    





    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="schedule-table">
                    <table class="table bg-white">
                        <thead class="bg-dark">
                            <tr>
                                <th>Routine</th>
                                <th>9 to 10 am</th>
                                <th>10 to 11 am</th>
                                <th>11 to 12 am</th>
                                <th>12 to 1 pm</th>
                                <th>07 pm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="day">Satarday</td>
                                <td></td>
                                <td></td>
                                <td class="active">
                                    <h4>Aerobics</h4>
                                    <p>03 pm - 04 pm</p>
                                    <div class="hover">
                                        <h4>Aerobics</h4>
                                        <p>03 pm - 04 pm</p>
                                        <span>Andre Walls</span>
                                    </div>
                                </td>
                                <td class="active">
                                    <h4>Cycling</h4>
                                    <p>05 pm - 06 pm</p>
                                    <div class="hover">
                                        <h4>Cycling</h4>
                                        <p>05 pm - 06 pm</p>
                                        <span>Margaret Thomas</span>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="day">Sunday</td>
                                <td class="active">
                                    <h4>Weight Loss</h4>
                                    <p>10 am - 11 am</p>
                                    <div class="hover">
                                        <h4>Weight Loss</h4>
                                        <p>10 am - 11 am</p>
                                        <span>Wayne Ponce</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Yoga</h4>
                                    <p>03 pm - 04 pm</p>
                                    <div class="hover">
                                        <h4>Yoga</h4>
                                        <p>03 pm - 04 pm</p>
                                        <span>Francisco Watt</span>
                                    </div>
                                </td>
                                <td class="active">
                                    <h4>Boxing</h4>
                                    <p>05 pm - 06 pm</p>
                                    <div class="hover">
                                        <h4>Boxing</h4>
                                        <p>05 pm - 046am</p>
                                        <span>Charles King</span>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="day">Monday</td>
                                <td></td>
                                <td class="active">
                                    <h4>Cycling</h4>
                                    <p>11 am - 12 pm</p>
                                    <div class="hover">
                                        <h4>Cycling</h4>
                                        <p>11 am - 12 pm</p>
                                        <span>Tabitha Potter</span>
                                    </div>
                                </td>
                                <td class="active">
                                    <h4>Karate</h4>
                                    <p>03 pm - 05 pm</p>
                                    <div class="hover">
                                        <h4>Karate</h4>
                                        <p>03 pm - 05 pm</p>
                                        <span>Lester Gray</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Crossfit</h4>
                                    <p>07 pm - 08 pm</p>
                                    <div class="hover">
                                        <h4>Crossfit</h4>
                                        <p>07 pm - 08 pm</p>
                                        <span>Candi Yip</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="day">Tuesday</td>
                                <td class="active">
                                    <h4>Spinning</h4>
                                    <p>10 am - 11 am</p>
                                    <div class="hover">
                                        <h4>Spinning</h4>
                                        <p>10 am - 11 am</p>
                                        <span>Mary Cass</span>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td class="active">
                                    <h4>Bootcamp</h4>
                                    <p>05 pm - 06 pm</p>
                                    <div class="hover">
                                        <h4>Bootcamp</h4>
                                        <p>05 pm - 06 pm</p>
                                        <span>Brenda Mastropietro</span>
                                    </div>
                                </td>
                                <td class="active">
                                    <h4>Boxercise</h4>
                                    <p>07 pm - 08 pm</p>
                                    <div class="hover">
                                        <h4>Boxercise</h4>
                                        <p>07 pm - 08 pm</p>
                                        <span>Marlene Bruce</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="day">Wednesday</td>
                                <td class="active">
                                    <h4>Body Building</h4>
                                    <p>10 am - 12 pm</p>
                                    <div class="hover">
                                        <h4>Body Building</h4>
                                        <p>10 am - 12 pm</p>
                                        <span>Brenda Hester</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Dance</h4>
                                    <p>03 pm - 05 pm</p>
                                    <div class="hover">
                                        <h4>Dance</h4>
                                        <p>03 pm - 05 pm</p>
                                        <span>Brian Ashworth</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Health</h4>
                                    <p>07 pm - 08 pm</p>
                                    <div class="hover">
                                        <h4>Health</h4>
                                        <p>07 pm - 08 pm</p>
                                        <span>Mark Croteau</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="day">Thursday</td>
                                <td></td>
                                <td class="active">
                                    <h4>Bootcamp</h4>
                                    <p>11 am - 12 pm</p>
                                    <div class="hover">
                                        <h4>Bootcamp</h4>
                                        <p>1 am - 12 pm</p>
                                        <span>Elisabeth Schreck</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Boday Building</h4>
                                    <p>05 pm - 06 pm</p>
                                    <div class="hover">
                                        <h4>Boday Building</h4>
                                        <p>05 pm - 06 pm</p>
                                        <span>Edward Garcia</span>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="day">Friday</td>
                                <td class="active">
                                    <h4>Racing</h4>
                                    <p>10 am - 11 am</p>
                                    <div class="hover">
                                        <h4>Racing</h4>
                                        <p>10 am - 11 am</p>
                                        <span>Jackie Potts</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Energy Blast</h4>
                                    <p>03 pm - 05 pm</p>
                                    <div class="hover">
                                        <h4>Energy Blast</h4>
                                        <p>03 pm - 05 pm</p>
                                        <span>Travis Brown</span>
                                    </div>
                                </td>
                                <td></td>
                                <td class="active">
                                    <h4>Jumping</h4>
                                    <p>07 pm - 08 pm</p>
                                    <div class="hover">
                                        <h4>Jumping</h4>
                                        <p>07 pm - 08 pm</p>
                                        <span>Benjamin Barnett</span>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
