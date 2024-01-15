@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>


    <div class="card-body flex flex-col p-6">
        <div class="flex-1">
            @php
                $selectedAnio = $year;
            @endphp

            <select id="anio" class="form-select" onchange="get_anio(this.value)">
                @for ($i = date('Y'); $i >= 2022; $i--)
                    <option value="{{ $i }}" {{ $selectedAnio == $i ? 'selected' : '' }}>{{ $i }}
                    </option>
                @endfor
            </select>
        </div>
    </div>

    <div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>
        <div class="container mx-auto px-4 py-2 md:py-24">

            <!-- <div class="font-bold text-gray-800 text-xl mb-4">
                                                                                                                                Schedule Tasks

                                                                                                                            </div> -->

            <div class="bg-white rounded-lg shadow overflow-hidden">

                <div class="flex items-center justify-between py-2 px-6">
                    <div>
                        <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                        <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                    </div>
                    <div class="border rounded-lg px-1" style="padding-top: 2px;">
                        <button type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 items-center"
                            :class="{ 'cursor-not-allowed opacity-25': month == 0 }" :disabled="month == 0 ? true : false"
                            @click="month--; getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div class="border-r inline-flex h-6"></div>
                        <button type="button"
                            class="leading-none rounded-lg transition ease-in-out duration-100 inline-flex items-center cursor-pointer hover:bg-gray-200 p-1"
                            :class="{ 'cursor-not-allowed opacity-25': month == 11 }" :disabled="month == 11 ? true : false"
                            @click="month++; getNoOfDays()">
                            <svg class="h-6 w-6 text-gray-500 inline-flex leading-none" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="-mx-1 -mb-1">
                    <div class="flex flex-wrap" style="margin-bottom: -40px;">
                        <template x-for="(day, index) in DAYS" :key="index">
                            <div style="width: 14.26%" class="px-2 py-2">
                                <div x-text="day"
                                    class="text-gray-600 text-sm uppercase tracking-wide font-bold text-center">
                                </div>
                            </div>
                        </template>
                    </div>

                    <div class="flex flex-wrap border-t border-l">
                        <template x-for="blankday in blankdays">
                            <div style="width: 14.28%; height: 120px" class="text-center border-r border-b px-4 pt-2">
                            </div>
                        </template>
                        <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                            <div style="width: 14.28%; height: 120px" class="px-4 pt-2 border-r border-b relative">
                                {{-- <div @click="showEventModal(date)" x-text="date" --}}

                                <div @click="showEventModal(date)" x-text="date"
                                    class="inline-flex w-6 h-6 items-center justify-center cursor-pointer text-center leading-none rounded-full transition ease-in-out duration-100"
                                    :class="{
                                        'bg-blue-500 text-white': isToday(date) ==
                                            true,
                                        'text-gray-700 hover:bg-blue-200': isToday(
                                            date) == false
                                    }">
                                </div>
                                </a>
                                <div style="height: 80px;" class="overflow-y-auto mt-1">
                                    <!-- <div
                                                                                                                                                        class="absolute top-0 right-0 mt-2 mr-2 inline-flex items-center justify-center rounded-full text-sm w-6 h-6 bg-gray-700 text-white leading-none"
                                                                                                                                                        x-show="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"
                                                                                                                                                        x-text="events.filter(e => e.event_date === new Date(year, month, date).toDateString()).length"></div> -->

                                    <template
                                        x-for="event in events.filter(e => new Date(e.event_date).toDateString() ===  new Date(year, month, date).toDateString() )">
                                        <div @click="showEventModal(date)"
                                            class="px-2 py-1 rounded-lg mt-1 overflow-hidden border cursor-pointer"
                                            :class="{
                                                'border-blue-200 text-blue-800 bg-blue-100': event
                                                    .event_theme === 'blue',
                                                'border-red-200 text-red-800 bg-red-100': event
                                                    .event_theme === 'red',
                                                'border-yellow-200 text-yellow-800 bg-yellow-100': event
                                                    .event_theme === 'yellow',
                                                'border-green-200 text-green-800 bg-green-100': event
                                                    .event_theme === 'green',
                                                'border-purple-200 text-purple-800 bg-purple-100': event
                                                    .event_theme === 'purple'
                                            }">
                                            <p x-text="event.event_title" class="text-sm truncate leading-tight">
                                            </p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <script src="{{ asset('assets/jquery.min.js') }}"></script>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>



    <script type="text/javascript">
        $(document).ready(function() {


        });

        function get_anio(anio) {
            window.location.href = '{{ url('calendarizacion') }}/' + anio;
        }
    </script>

    <script type="text/javascript">
        record = [];
        const MONTH_NAMES = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        ];
        const DAYS = ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"];

        function app() {


            return {
                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado"],

                events: [
                    <?php foreach ($pending as $obj): ?> {
                        event_date: new Date(<?php echo $obj->axo; ?>, <?php echo $obj->mes; ?>, <?php echo $obj->dia; ?>),
                        event_title: '<?php echo $obj->label; ?>: <?php echo $obj->count; ?>',
                        event_theme: '<?php echo $obj->color; ?>'
                    },
                    <?php endforeach; ?>

                    <?php foreach ($done as $obj): ?> {
                        event_date: new Date(<?php echo $obj->axo; ?>, <?php echo $obj->mes; ?>, <?php echo $obj->dia; ?>),
                        event_title: '<?php echo $obj->label; ?>: <?php echo $obj->count; ?>',
                        event_theme: '<?php echo $obj->color; ?>'
                    },
                    <?php endforeach; ?>
                ],

                themes: record,


                openEventModal: false,

                initDate() {

                    let today = new Date();

                    // Verifica si existe el parámetro "anio" en la URL
                    let anioParam = {{ $year}};

                    // Asigna el año basado en la URL o en la fecha actual
                    this.year = anioParam !== null ? parseInt(anioParam) : today.getFullYear();



                    this.month = today.getMonth();
                    //this.year = today.getFullYear();
                    this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    //this.month = (today.getMonth() + 1).toString().padStart(2, '0');
                    const d = new Date(this.year, this.month, date);
                    return today.toDateString() === d.toDateString() ? true : false;
                },

                showEventModal(date) {
                    this.event_date = new Date(this.year, this.month, date).toDateString();
                    let date_actual = this.year + '-' + (this.month + 1).toString().padStart(2, '0') + '-' +
                        date.toString()
                        .padStart(2, '0');

                    //Livewire.emit('load_data', date_actual);


                    window.location.href = '{{ url('calendarizacion/get_data') }}/' + date_actual;

                },


                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }

        }
    </script>

@endsection
